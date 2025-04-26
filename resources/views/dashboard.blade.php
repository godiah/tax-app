@extends('layouts.app')

@section('title', 'Dashboard - Taxgen Consultants LLP')

@section('content')
    <div class="bg-white shadow-lg rounded-xl mx-auto  overflow-hidden">
        <!-- Dashboard Header -->
        <div class="bg-gradient-to-r from-primary to-primary-hover p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-white font-heading text-2xl font-bold">Dashboard</h2>
                    <p class="text-white opacity-80 font-body mt-1">Taxgen Consultants Admin Portal</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h3 class="font-heading text-xl font-semibold text-primary mb-2">Welcome to Your Dashboard</h3>
                        <p class="text-dark font-body">Manage and monitor your tax consulting content all in one place.</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-5 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-border font-body text-sm uppercase font-medium">Total Posts</p>
                                <h4 class="text-2xl font-heading font-bold text-primary mt-1">{{ $totalPosts }}</h4>
                                <p class="text-secondary flex items-center text-sm mt-2 font-body text-sm">
                                    @if ($changeType === 'increase')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Increased from last month
                                    @elseif ($changeType === 'decrease')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-red-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Decreased from last month
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @if ($changeType === 'no-change')
                                            No change from last month
                                        @else
                                            No data from last month
                                        @endif
                                    @endif
                                </p>
                            </div>
                            <div class="p-3 bg-light rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-border font-body text-sm uppercase font-medium">Categories</p>
                                <h4 class="text-2xl font-heading font-bold text-primary mt-1">{{ $totalCategories }}</h4>
                                <p class="text-secondary flex items-center text-sm mt-2 font-tertiary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    +{{ $newCategories }} new categories
                                </p>
                            </div>
                            <div class="p-3 bg-light rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-border font-body text-sm uppercase font-medium">Page Views</p>
                                <h4 class="text-2xl font-heading font-bold text-primary mt-1">1,248</h4>
                                <p class="text-secondary flex items-center text-sm mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    +18% from last week
                                </p>
                            </div>
                            <div class="p-3 bg-light rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-5 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-border font-body text-sm uppercase font-medium">Comments</p>
                                <h4 class="text-2xl font-heading font-bold text-primary mt-1">38</h4>
                                <p class="text-secondary flex items-center text-sm mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    +5 new comments
                                </p>
                            </div>
                            <div class="p-3 bg-light rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Content Management -->
                <div class="bg-white p-6 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-heading text-lg font-semibold text-primary">Content Management</h4>
                        <div class="p-2 bg-accent rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-dark mb-4 font-body">Create, edit, and manage your tax insight articles
                        with ease.</p>
                    <div class="flex flex-col space-y-2 font-body">
                        <a href="{{ route('posts.create') }}"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create New Post
                        </a>
                        <a href="{{ route('posts.index') }}"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            View All Posts
                        </a>
                        <a href="{{ route('posts.index', ['status' => 'draft']) }}"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Draft Posts
                        </a>
                    </div>
                </div>

                <!-- Category Management -->
                <div class="bg-white p-6 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-heading text-lg font-semibold text-primary">Category Management</h4>
                        <div class="p-2 bg-accent rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-dark mb-4 font-body">Organize your content with clear categories for better navigation.
                    </p>
                    <div class="flex flex-col space-y-2 font-body">
                        <a href="#" onclick="openCategoryModal(); return false;"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create New Category
                        </a>
                        <a href="{{ route('categories.index') }}"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            View All Categories
                        </a>
                        <a href="{{ route('tags.index') }}"
                            class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                            </svg>
                            Manage Tags
                        </a>
                    </div>
                </div>

                <!-- Analytics Dashboard -->
                <div class="bg-white p-6 rounded-xl border border-default shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-heading text-lg font-semibold text-primary">Analytics Dashboard</h4>
                        <div class="p-2 bg-accent rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-dark mb-4 font-body">Track engagement metrics and understand your audience better.</p>
                    <div class="flex flex-col space-y-2 font-body">
                        <a href="#" class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            View Performance
                        </a>
                        <a href="#" class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Traffic Analysis
                        </a>
                        <a href="#" class="flex items-center text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Generate Reports
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity & Quick Start -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activity -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-default shadow-sm">
                    <h4 class="font-heading text-lg font-semibold text-primary mb-4">Recent Activity</h4>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-light p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-dark">New Post Created</h5>
                                <p class="text-border text-sm">Tax Implications of Remote Work Arrangements</p>
                                <p class="text-xs text-border mt-1">Today at 10:45 AM</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-light p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-dark">Post Updated</h5>
                                <p class="text-border text-sm">2025 Tax Calendar for Small Businesses</p>
                                <p class="text-xs text-border mt-1">Yesterday at 3:22 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-light p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-dark">New Comment</h5>
                                <p class="text-border text-sm">On "Understanding Tax Credits vs. Deductions"</p>
                                <p class="text-xs text-border mt-1">Yesterday at 11:15 AM</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-light p-2 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-medium text-dark">New Category Created</h5>
                                <p class="text-border text-sm">International Taxation</p>
                                <p class="text-xs text-border mt-1">Apr 23, 2025 at 9:30 AM</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <a href="#" class="text-accent hover:underline font-medium">View All Activity</a>
                    </div>
                </div>

                <!-- Quick Start Guide -->
                <div class="bg-blog-paper-accent p-6 rounded-xl border border-default shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-heading text-lg font-semibold text-accent">Quick Start Guide</h4>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Create New Category -->
    @include('admin.partials.category-modal')
@endsection
