@extends('layouts.app')

@section('title', 'Manage Posts')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with background accent -->
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2 font-heading">Content Management</h1>
                        <p class="font-body text-white/80 font-tertiary">Manage and organize your blog posts</p>
                    </div>
                    <a href="{{ route('posts.create') }}"
                        class="font-body mt-4 md:mt-0 inline-flex items-center px-5 py-3 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow-lg transition-all duration-200 transform hover:translate-y-[-2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Post
                    </a>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-primary">
                    <div class="flex items-center">
                        <div class="rounded-full bg-primary bg-opacity-10 p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-dark/60 font-body">Total Posts</p>
                            <p class="text-2xl font-bold text-dark font-heading">{{ $posts->total() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-secondary">
                    <div class="flex items-center">
                        <div class="rounded-full bg-secondary bg-opacity-10 p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-dark/60 font-body">Total Views</p>
                            <p class="text-2xl font-bold text-dark font-heading">{{ $posts->sum('view_count') }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-accent">
                    <div class="flex items-center">
                        <div class="rounded-full bg-accent bg-opacity-10 p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-dark/60 font-body">Published</p>
                            <p class="text-2xl font-bold text-dark font-heading">
                                {{ $posts->where('status', 'published')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="bg-white rounded-lg shadow-sm mb-6 p-4 font-body">
                <div class="flex flex-wrap gap-4 items-center">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" placeholder="Search posts..."
                            class="pl-10 pr-4 py-2 border border-gray-300 focus:ring-primary focus:border-primary block w-full rounded-md">
                    </div>
                    <div class="flex space-x-2">
                        <select id="category-filter"
                            class="border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <select id="status-filter"
                            class="border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Posts List Container -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
                    <h2 class="font-heading text-lg font-semibold text-gray-800 font-heading">All Posts</h2>
                </div>

                <div id="posts-container">
                    <!-- This is where our posts list will be loaded -->
                    @include('admin.posts.partials.posts-list', ['posts' => $posts])
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteConfirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDeleteModal()">
                </div>

                <!-- Modal panel -->
                <div
                    class="inline-block bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856
                                                                   c1.54 0 2.502-1.667 1.732-3L13.732
                                                                   4c-.77-1.333-2.694-1.333-3.464
                                                                   0L3.34 16c-.77 1.333.192 3
                                                                   1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Delete Post
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this post? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="deletePostForm" action="" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                        </form>
                        <button type="button" onclick="closeDeleteModal()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </x.admin-admin-wrapper>

    <script>
        // search-filter.js

        (function() {
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search');
                const categoryFilter = document.getElementById('category-filter');
                const statusFilter = document.getElementById('status-filter');
                const postsContainer = document.getElementById('posts-container');
                const resetButton = document.getElementById('reset-filters');
                let searchTimeout;

                // Core function: fetch filtered posts and update DOM + URL
                function updatePosts(pushState = true) {
                    const params = new URLSearchParams();

                    if (searchInput.value.trim()) {
                        params.append('search', searchInput.value.trim());
                    }
                    if (categoryFilter.value) {
                        params.append('category', categoryFilter.value);
                    }
                    if (statusFilter.value) {
                        params.append('status', statusFilter.value);
                    }

                    const url = `${window.location.pathname}?${params.toString()}`;

                    // Optional: show a simple loading state
                    postsContainer.style.opacity = '0.6';

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.text();
                        })
                        .then(html => {
                            postsContainer.innerHTML = html;
                            postsContainer.style.opacity = '';
                            if (pushState) {
                                window.history.pushState({}, '', url);
                            }
                        })
                        .catch(err => {
                            console.error('Error loading posts:', err);
                            postsContainer.style.opacity = '';
                        });
                }

                // Debounced search listener
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => updatePosts(), 300);
                });

                // Instant filters
                [categoryFilter, statusFilter].forEach(el =>
                    el.addEventListener('change', () => updatePosts())
                );

                // Optional reset button
                if (resetButton) {
                    resetButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        searchInput.value = '';
                        categoryFilter.value = '';
                        statusFilter.value = '';
                        updatePosts();
                    });
                }

                // Handle browser back/forward
                window.addEventListener('popstate', function() {
                    const params = new URLSearchParams(window.location.search);
                    searchInput.value = params.get('search') || '';
                    categoryFilter.value = params.get('category') || '';
                    statusFilter.value = params.get('status') || '';
                    updatePosts(false);
                });
            });
        })();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Base URL for destroying posts
            const baseUrl = @json(url('posts'));

            window.showDeleteModal = postId => {
                const form = document.getElementById('deletePostForm');
                form.action = `${baseUrl}/${postId}`;
                document.getElementById('deleteConfirmModal')
                    .classList.remove('hidden');
            };

            window.closeDeleteModal = () => {
                document.getElementById('deleteConfirmModal')
                    .classList.add('hidden');
            };
        });
    </script>

@endsection
