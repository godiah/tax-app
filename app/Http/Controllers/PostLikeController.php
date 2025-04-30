<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostLikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostLikeController extends Controller
{
    protected $likeService;

    public function __construct(PostLikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle(Request $request, Post $post)
    {
        $result = $this->likeService->toggle($post, $request);

        return response()->json($result);
    }
}
