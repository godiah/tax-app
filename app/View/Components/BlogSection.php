<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class BlogSection extends Component
{
    public $posts;
    public $categories;
    public $featuredCategories;
    public $moreCategories;
    public $selectedCategory;
    public $searchQuery;

    public function __construct(Request $request)
    {
        $this->selectedCategory = $request->category_id;
        $this->searchQuery = $request->search;

        // Query builder for posts
        $postsQuery = Post::with(['category', 'tags', 'author'])
            ->where('status', 'published');

        // Apply category filter if selected
        if ($this->selectedCategory) {
            $postsQuery->where('category_id', $this->selectedCategory);
        }

        // Apply search filter if provided
        if ($this->searchQuery) {
            $searchTerm = '%' . $this->searchQuery . '%';

            $postsQuery->where(function ($query) use ($searchTerm) {
                // Search in post content fields
                $query->where('title', 'like', $searchTerm)
                    ->orWhere('excerpt', 'like', $searchTerm)
                    ->orWhere('content', 'like', $searchTerm)
                    // Search in category name
                    ->orWhereHas('category', function ($categoryQuery) use ($searchTerm) {
                        $categoryQuery->where('name', 'like', $searchTerm);
                    })
                    // Search in tag names
                    ->orWhereHas('tags', function ($tagQuery) use ($searchTerm) {
                        $tagQuery->where('name', 'like', $searchTerm);
                    });
            });
        }

        // Get posts with pagination (explicitly maintain page from request)
        $this->posts = $postsQuery->latest('published_at')->paginate(6)->withQueryString();

        // Get all categories ordered by post count
        $allCategories = Category::withCount('posts')
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->get();

        // Set the first 2 categories as featured (to be shown directly)
        $this->featuredCategories = $allCategories->take(2);

        // The rest go to "More" dropdown
        $this->moreCategories = $allCategories->slice(2);

        // All categories (for other uses if needed)
        $this->categories = $allCategories;
    }

    public function render()
    {
        return view('components.blog-section');
    }
}
