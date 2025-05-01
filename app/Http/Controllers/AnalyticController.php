<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticController extends Controller
{
    public function index(Request $request)
    {
        // Total views
        $totalViews = Post::sum('view_count');

        // Total posts
        $totalPosts = Post::count();

        // Total likes
        $totalLikes = Post::sum('like_count');

        // Engagement rate (likes / views * 100)
        $engagementRate = $totalViews > 0 ? ($totalLikes / $totalViews) * 100 : 0;

        // Get most liked post
        $mostLikedPost = Post::orderBy('like_count', 'desc')->first();

        // Get most viewed post
        $mostViewedPost = Post::orderBy('view_count', 'desc')->first();

        // Top performing posts
        $topPosts = Post::select('*')
            ->withCount(['likedBy as engagement_rate' => function ($query) {
                $query->selectRaw('IFNULL(COUNT(*) / NULLIF(posts.view_count, 0) * 100, 0)');
            }])
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        // Categories with post count
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();

        // Chart data for views over time (monthly)
        $viewsChartData = $this->generateViewsChartData();

        // Chart data for categories distribution
        $categoriesChartData = $this->generateCategoriesChartData($categories);

        // Category colors for chart
        $categoryColors = $this->generateCategoryColors($categories->count());

        // Posts per month
        $postsPerMonth = $this->getPostsPerMonth();

        return view('admin.analytics.index', compact(
            'totalViews',
            'totalPosts',
            'totalLikes',
            'engagementRate',
            'mostLikedPost',
            'mostViewedPost',
            'topPosts',
            'categories',
            'viewsChartData',
            'categoriesChartData',
            'categoryColors',
            'postsPerMonth'
        ));
    }

    private function generateCategoryColors($count)
    {
        $colors = [];

        // Define base colors 
        $baseColors = [
            'rgba(31, 59, 115, %s)',  // Primary blue
            'rgba(46, 125, 50, %s)',  // Green
            'rgba(226, 88, 34, %s)',  // Orange
            'rgba(156, 39, 176, %s)', // Purple
            'rgba(211, 47, 47, %s)',  // Red
            'rgba(0, 131, 143, %s)'   // Teal
        ];

        $variationsNeeded = ceil($count / count($baseColors));

        // Generate all needed colors
        for ($i = 0; $i < $count; $i++) {
            $baseColorIndex = $i % count($baseColors);
            $variation = floor($i / count($baseColors));

            // Adjust opacity based on variation 
            $opacity = 1 - ($variation * 0.1);
            $opacity = max(0.3, $opacity);

            $colors[] = sprintf($baseColors[$baseColorIndex], $opacity);
        }

        return $colors;
    }

    private function generateViewsChartData()
    {
        // Get data for the last 12 months
        $months = [];
        $views = [];
        $likes = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');

            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            // Get posts published in this month
            $monthlyPosts = Post::whereBetween('published_at', [$startOfMonth, $endOfMonth])->get();

            // Sum the views and likes
            $monthlyViews = $monthlyPosts->sum('view_count');
            $monthlyLikes = $monthlyPosts->sum('like_count');

            $views[] = $monthlyViews;
            $likes[] = $monthlyLikes;
        }

        return [
            'labels' => $months,
            'views' => $views,
            'likes' => $likes
        ];
    }

    private function generateCategoriesChartData($categories)
    {
        $labels = [];
        $data = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $data[] = $category->posts_count;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getPostsPerMonth()
    {
        $result = DB::table('posts')
            ->selectRaw('COUNT(*) as count, MONTH(published_at) as month, YEAR(published_at) as year')
            ->whereNotNull('published_at')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return $result;
    }
}
