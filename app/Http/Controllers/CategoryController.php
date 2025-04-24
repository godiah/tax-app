<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        // If you're using relationships, adjust this to match your model setup
        // $categories = Category::withCount('posts')->latest()->get();

        // $categories = Category::withCount('posts')->latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * This will just return the view with the modal JS trigger
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'nullable|max:255|unique:categories',
            'description' => 'nullable|max:1000',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Create the category
        $category = Category::create($validated);

        // Redirect with success message
        return redirect()->route('dashboard')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        // Check if this is an AJAX request
        if (request()->ajax()) {
            return response()->json([
                'category' => $category
            ]);
        }

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'nullable|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|max:1000',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Update the category
        $category->update($validated);

        // Redirect with success message
        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    // Check if category name exists
    public function checkTitle(Request $request)
    {
        $title = $request->input('name');
        $exists = Category::where('name', $title)->exists();

        return response()->json(['exists' => $exists]);
    }
}
