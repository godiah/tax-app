<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\PostLikeService;
use App\Services\PostViewService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display the full post details.
     */
    public function show(Post $post, PostViewService $viewService, PostLikeService $likeService,  Request $request)
    {
        // Record the view
        $viewService->recordView($post);

        // Check if the current user/visitor has liked this post
        $hasLiked = $likeService->hasLiked($post, $request);

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

        return view('blog.show', compact('post', 'related', 'hasLiked'));
    }
}
