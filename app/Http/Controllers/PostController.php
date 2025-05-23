<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author', 'tags']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%")
                    ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                    ->orWhereHas('tags', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('id', $request->category);
            });
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);

        // Ensure pagination links maintain the current query parameters
        $posts->appends($request->all());

        if ($request->ajax()) {
            return view('admin.posts.partials.posts-list', compact('posts'));
        }

        // Get all categories for filter dropdown
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $slug = Str::slug($request->title);
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . $count;
            $count++;
        }

        // Handle featured image upload
        $featured_image = null;
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('featured_images', 'public');
            $featured_image = $path;
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'author_id' => Auth::id(),
            'category_id' => $request->category_id,
            'status' => $request->status,
            'featured_image' => $featured_image,
            'published_at' => $request->status === 'published' ? now() : null,
            'meta_description' => $request->meta_description,
        ]);

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        if ($post->status === 'published') {
            // Send email notification to subscribers
            $subscribers = Subscriber::where('status', 'subscribed')->get();
            $blogUrl = route('blog.show', ['post' => $post->slug]);
            $post->url = $blogUrl;

            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)
                    ->queue(new NewsletterMail($post, $subscriber));
            }
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Services\MarkdownService $md, Post $post)
    {
        $html = $md->toHtml($post->content);
        return view('admin.posts.show', compact('post', 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle slug update if title changes
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = Str::slug($request->title) . '-' . $count;
                $count++;
            }
            $post->slug = $slug;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }

            // Upload new image to storage/app/public/featured_images
            $path = $request->file('featured_image')->store('featured_images', 'public');
            $post->featured_image = $path;
        }

        // Set published_at if status changes to published
        if ($post->status !== 'published' && $request->status === 'published') {
            $post->published_at = now();
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->meta_description = $request->meta_description;
        $post->save();

        // Sync tags
        $post->tags()->sync($request->tags ?? []);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete featured image if exists
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    /**
     * Mark the given post as published.
     */
    public function publish(Post $post)
    {
        // Only change if it's not already published
        if ($post->status !== 'published') {
            $post->update([
                'status'       => 'published',
                'published_at' => now(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Post has been published.');
    }
}
