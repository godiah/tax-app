@extends('layouts.app')

@section('title', 'Analytics Board')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with background accent -->
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2 font-heading">Analytics Board</h1>
                        <p class="font-body text-white/80 font-tertiary">Track and understand how your articles perform</p>
                    </div>
                    <div class="flex space-x-2 font-body">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="py-2">
                <!-- Stats Overview Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Views -->
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-primary">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-dark font-secondary text-sm uppercase tracking-wider font-semibold">
                                    Total Views</h3>
                                <p class="text-primary text-3xl font-heading font-bold mt-2">{{ $totalViews }}</p>

                            </div>
                            <div class="p-3 bg-primary bg-opacity-10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Posts -->
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-secondary">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-dark font-secondary text-sm uppercase tracking-wider font-semibold">
                                    Total Posts</h3>
                                <p class="text-secondary text-3xl font-heading font-bold mt-2">{{ $totalPosts }}</p>
                            </div>
                            <div class="p-3 bg-secondary bg-opacity-10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Likes -->
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-accent">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-dark font-secondary text-sm uppercase tracking-wider font-semibold">
                                    Total Likes</h3>
                                <p class="text-accent text-3xl font-heading font-bold mt-2">{{ $totalLikes }}</p>
                            </div>
                            <div class="p-3 bg-accent bg-opacity-10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Engagement Rate -->
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow border-l-4 border-gray-400">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-dark font-secondary text-sm uppercase tracking-wider font-semibold">
                                    Engagement Rate</h3>
                                <p class="text-gray-700 text-3xl font-heading font-bold mt-2">
                                    {{ number_format($engagementRate, 1) }}%</p>
                            </div>
                            <div class="p-3 bg-gray-200 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column - Top Performing Posts & Views Chart -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Views Chart -->
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h3 class="font-heading text-lg text-primary font-bold mb-4">View Trends</h3>
                            <div class="h-80">
                                <canvas id="viewsChart"></canvas>
                            </div>
                        </div>

                        <!-- Top Performing Posts -->
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-heading text-lg text-primary font-bold">Top Performing Posts</h3>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b-2 border-default">
                                            <th class="px-4 py-3 text-left font-secondary text-sm font-semibold text-dark">
                                                Title</th>
                                            <th
                                                class="px-4 py-3 text-center font-secondary text-sm font-semibold text-dark">
                                                Views</th>
                                            <th
                                                class="px-4 py-3 text-center font-secondary text-sm font-semibold text-dark">
                                                Likes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topPosts as $post)
                                            <tr class="border-b border-default hover:bg-light">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center">
                                                        @if ($post->featured_image)
                                                            <div class="h-10 w-10 rounded bg-cover bg-center mr-3">
                                                                <img src="{{ Storage::url($post->featured_image) }}"
                                                                    alt="{{ $post->title }}"
                                                                    class="w-full h-full object-cover">
                                                            </div>
                                                        @else
                                                            <div
                                                                class="h-10 w-10 rounded bg-blog-paper-accent mr-3 flex items-center justify-center">
                                                                <span class="text-accent text-xs">Post</span>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <p class="font-body text-dark truncate text-sm">
                                                                {{ $post->title }}</p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ $post->published_at->format('M d, Y') }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-center font-body">
                                                    {{ number_format($post->view_count) }}</td>
                                                <td class="px-4 py-3 text-center font-body">
                                                    {{ number_format($post->like_count) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Categories, Most Popular Post Card-->
                    <div class="space-y-6">
                        <!-- Most Popular Post Card -->
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <div class="bg-primary p-4">
                                <h3 class="font-heading text-white font-bold">Most Popular Post</h3>
                            </div>
                            @if ($mostLikedPost)
                                <div class="p-5">
                                    @if ($mostLikedPost->featured_image)
                                        <div class="h-40 rounded-lg w-full mb-4 overflow-hidden">
                                            <img src="{{ Storage::url($mostLikedPost->featured_image) }}"
                                                alt="Featured Image" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div
                                            class="h-40 rounded-lg bg-blog-paper-accent w-full mb-4 flex items-center justify-center">
                                            <span class="text-accent font-heading text-xl">Featured Post</span>
                                        </div>
                                    @endif


                                    <h4 class="font-heading text-primary font-bold text-lg mb-2">
                                        {{ $mostLikedPost->title }}</h4>
                                    <p class="font-body text-dark text-sm mb-3 line-clamp-2">
                                        {{ $mostLikedPost->excerpt }}</p>

                                    <div class="flex justify-between items-center text-sm mb-4">
                                        <span class="font-secondary text-gray-500">Published:
                                            {{ $mostLikedPost->published_at->format('M d, Y') }}</span>
                                        <span
                                            class="font-secondary text-accent font-semibold">{{ $mostLikedPost->category->name }}</span>
                                    </div>

                                    <div class="flex justify-between items-center bg-light rounded-lg p-3">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span
                                                class="font-body text-dark">{{ number_format($mostLikedPost->view_count) }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent mr-1"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span
                                                class="font-body text-dark">{{ number_format($mostLikedPost->like_count) }}</span>
                                        </div>
                                        <a href="{{ route('posts.edit', $mostLikedPost) }}"
                                            class="text-primary font-body hover:underline font-medium">View Details</a>
                                    </div>
                                </div>
                            @else
                                <div class="p-5 text-center">
                                    <p class="text-gray-500">No posts found</p>
                                </div>
                            @endif
                        </div>

                        <!-- Categories Distribution -->
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h3 class="font-heading text-lg text-primary font-bold mb-4">Categories Distribution</h3>
                            <div class="h-64">
                                <canvas id="categoriesChart"></canvas>
                            </div>
                            <div class="mt-4 space-y-3">
                                @foreach ($categories as $category)
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full mr-2"
                                                style="background-color: {{ $categoryColors[$loop->index % count($categoryColors)] }}">
                                            </div>
                                            <span class="font-body text-dark">{{ $category->name }}</span>
                                        </div>
                                        <span class="font-body text-dark">{{ $category->posts_count }} posts</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x.admin-admin-wrapper>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Views Chart
            const viewsCtx = document.getElementById('viewsChart').getContext('2d');
            const viewsChart = new Chart(viewsCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($viewsChartData['labels']) !!},
                    datasets: [{
                        label: 'Views',
                        data: {!! json_encode($viewsChartData['views']) !!},
                        backgroundColor: 'rgba(31, 59, 115, 0.1)',
                        borderColor: 'rgba(31, 59, 115, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }, {
                        label: 'Likes',
                        data: {!! json_encode($viewsChartData['likes']) !!},
                        backgroundColor: 'rgba(226, 88, 34, 0.1)',
                        borderColor: 'rgba(226, 88, 34, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Categories Chart
            const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
            const categoriesChart = new Chart(categoriesCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($categoriesChartData['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($categoriesChartData['data']) !!},
                        backgroundColor: {!! json_encode($categoryColors) !!},
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
@endsection
