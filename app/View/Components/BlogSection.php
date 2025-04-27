<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogSection extends Component
{
    public $posts;
    public $categories;

    public function __construct()
    {
        // Fetch latest 3 published posts
        $this->posts = Post::with(['category', 'tags', 'author'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(3);

        // Fetch all categories, ordered by name
        $this->categories = Category::orderBy('name')->get();
    }

    public function render()
    {
        return view('components.blog-section');
    }
}
