<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PostViewService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function recordView(Post $post)
    {
        // Generate a unique key for this post and session
        $sessionKey = 'post_' . $post->id . '_viewed';

        // Check if user has viewed this post in current session
        if (!Session::has($sessionKey)) {
            // Increment view count
            $post->increment('view_count');

            // Mark as viewed in this session (lasts for 24 hours)
            Session::put($sessionKey, true);
            Session::save();

            return true;
        }

        return false;
    }
}
