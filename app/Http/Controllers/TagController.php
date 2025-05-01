<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * List all tags
     */
    public function index(Request $request)
    {
        $query = Tag::withCount('posts');

        // Search functionality
        if ($request->filled('search')) {
            $term = $request->search;
            $query->where('name', 'like', "%{$term}%");
        }

        // Sorting functionality
        $sort = $request->input('sort', 'name_asc');
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'count_desc':
                $query->orderBy('posts_count', 'desc');
                break;
            case 'count_asc':
                $query->orderBy('posts_count', 'asc');
                break;
            case 'created_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'created_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        $tags = $query->paginate(20)->appends($request->all());

        // Get most used tag
        $mostUsedTag = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first();

        // Calculate total tagged content
        $totalTaggedContent = DB::table('post_tag')->count();

        if ($request->ajax()) {
            return view('admin.tags.partials.tags-list', compact('tags'));
        }

        return view('admin.tags.index', compact('tags', 'mostUsedTag', 'totalTaggedContent'));
    }

    /**
     * Return view form to create a new tag
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store new tag
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'slug' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create($data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully!');
    }

    /**
     * Edit tag
     */
    public function edit(Tag $tag)
    {
        // Check if this is an AJAX request
        if (request()->ajax()) {
            return response()->json([
                'tag' => $tag
            ]);
        }

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update a tag
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
            'slug' => 'required|string|max:255|unique:tags,slug,' . $tag->id,
        ]);

        $tag->update($data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully!');
    }

    /**
     * Delete a tag
     */
    public function destroy(Tag $tag)
    {
        // Detach from posts first (optional, cascade handles it)
        // $tag->posts()->detach();
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully!');
    }

    // Public: show posts under a given tag
    // public function show(Tag $tag)
    // {
    //     $posts = $tag->posts()
    //         ->where('status', 'published')
    //         ->orderBy('publish_date', 'desc')
    //         ->paginate(10);

    //     return view('tags.show', compact('tag', 'posts'));
    // }
}
