<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostLikeService
{
    /**
     * Check if a post has been liked by the current user/visitor
     */
    public function hasLiked(Post $post, Request $request)
    {
        // Check if liked in session
        $sessionKey = 'post_' . $post->id . '_liked';
        if (Session::has($sessionKey)) {
            return true;
        }

        // Get identifier for current user/visitor
        $identifier = $this->getLikeIdentifier($request);

        // Check database
        $exists = DB::table('post_likes')
            ->where('post_id', $post->id)
            ->where(function ($query) use ($identifier) {
                foreach ($identifier as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->exists();

        // If found in database, set session
        if ($exists) {
            Session::put($sessionKey, true);
        }

        return $exists;
    }

    /**
     * Toggle the like status for a post
     */
    public function toggle(Post $post, Request $request)
    {
        $identifier = $this->getLikeIdentifier($request);
        $hasLiked = $this->hasLiked($post, $request);

        if ($hasLiked) {
            // Unlike if already liked
            $this->unlike($post, $identifier);
            $liked = false;
        } else {
            // Like if not already liked
            $this->like($post, $identifier);
            $liked = true;
        }

        return [
            'success' => true,
            'liked' => $liked,
            'likeCount' => $post->like_count
        ];
    }

    /**
     * Like a post
     */
    protected function like(Post $post, array $identifier)
    {
        // Store in pivot table
        DB::table('post_likes')->insert(array_merge($identifier, [
            'post_id' => $post->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        // Increment counter
        $post->increment('like_count');

        // Store in session
        Session::put('post_' . $post->id . '_liked', true);

        return true;
    }

    /**
     * Unlike a post
     */
    protected function unlike(Post $post, array $identifier)
    {
        // Remove from pivot table
        DB::table('post_likes')
            ->where('post_id', $post->id)
            ->where(function ($query) use ($identifier) {
                foreach ($identifier as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->delete();

        // Decrement counter (ensure not negative)
        if ($post->like_count > 0) {
            $post->decrement('like_count');
        }

        // Remove from session
        Session::forget('post_' . $post->id . '_liked');

        return true;
    }

    /**
     * Get identifier array for the current user/visitor
     */
    protected function getLikeIdentifier(Request $request)
    {
        $identifier = [];

        // If user is logged in, use user_id
        if (Auth::check()) {
            $identifier['user_id'] = Auth::id();
        } else {
            // Otherwise use a combination of IP and user agent
            $identifier['ip_address'] = $request->ip();
            $identifier['user_agent'] = substr($request->userAgent(), 0, 255);
            $identifier['session_id'] = Session::getId();
        }

        return $identifier;
    }
}
