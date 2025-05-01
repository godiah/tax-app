<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        // Total categories
        $totalCategories = Category::count();
        $newCategories = Category::where('created_at', '>=', now()->subDays(7))->count();

        // Total posts
        $totalPosts = Post::count();

        // Calculate posts for the current month
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $currentMonthPosts = Post::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Calculate posts for the previous month
        $previousMonth = now()->subMonth()->month;
        $previousYear = now()->subMonth()->year;
        $previousMonthPosts = Post::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->count();

        // Determine the change type
        if ($previousMonthPosts === 0) {
            $changeType = 'no-data'; // First month or no previous posts
        } elseif ($currentMonthPosts > $previousMonthPosts) {
            $changeType = 'increase';
        } elseif ($currentMonthPosts < $previousMonthPosts) {
            $changeType = 'decrease';
        } else {
            $changeType = 'no-change';
        }

        // Total likes
        $totalLikes = Post::sum('like_count');
        $recentLikes = DB::table('post_likes')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        // Page Views
        $totalViews = Post::sum('view_count');
        $subscribers = DB::table('subscribers')->count();
        $popularCategory = Category::select(
            'categories.id',
            'categories.name',
            DB::raw('COALESCE(SUM(posts.view_count),0) as total_views')
        )
            ->leftJoin('posts', 'posts.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_views')
            ->first();

        $activities = Activity::with(['causer', 'subject'])
            ->latest()
            ->paginate(20);

        return view(
            'dashboard',
            compact(
                'totalCategories',
                'newCategories',
                'totalPosts',
                'changeType',
                'totalLikes',
                'recentLikes',
                'totalViews',
                'popularCategory',
                'activities',
                'subscribers'
            )
        );
    }
}
