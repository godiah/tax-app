<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Show the blog page (HTML) or return JSON for AJAX.
     */
    public function index(Request $request)
    {
        // 1) Always load all categories for the filter bar
        $categories = Category::orderBy('name')->get();

        // 2) Build the posts query
        $query = Post::with(['category', 'tags', 'author'])
            ->where('status', 'published');

        // 3) Apply category filter if one is provided
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        // 4) Paginate (3 per page, or whatever you prefer)
        $perPage = 3;
        $posts = $query->latest('published_at')
            ->paginate($perPage);

        // 5) If this is an AJAX fetch, return JSON instead of HTML
        if ($request->ajax()) {
            return response()->json([
                'data' => $posts->items(),
                'meta' => [
                    'current_page' => $posts->currentPage(),
                    'last_page'    => $posts->lastPage(),
                    'per_page'     => $posts->perPage(),
                    'total'        => $posts->total(),
                ],
            ]);
        }

        // 6) Non-AJAX: render the page with your Blade component
        //    The BlogSection component will grab its own initial $posts and $categories,
        //    so you don’t need to pass them here unless you want to override.
        return view('home', compact('categories'));
    }

    /**
     * Display the full post details.
     */
    public function show(Post $post)
    {
        $post->load(['category', 'tags', 'author']);

        // 1) Grab up to 3 posts in the same category (excluding current)
        $related = Post::with('category')
            ->where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        // 2) If fewer than 3, fill with the newest posts outside both the current + already-related
        if ($related->count() < 3) {
            $fill = Post::with('category')
                ->where('status', 'published')
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->latest('published_at')
                ->take(3 - $related->count())
                ->get();

            $related = $related->concat($fill);
        }

        return view('blog.show', compact('post', 'related'));
    }
}
