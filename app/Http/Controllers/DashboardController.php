<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total categories
        $totalCategories = Category::count();

        // “New” categories in the last 7 days
        $newCategories = Category::where('created_at', '>=', now()->subDays(7))->count();

        return view('dashboard', compact('totalCategories', 'newCategories'));
    }
}
