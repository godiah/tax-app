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
                        <input type="text" placeholder="Search posts..."
                            class="pl-10 pr-4 py-2 border border-gray-300 focus:ring-primary focus:border-primary block w-full rounded-md">
                    </div>
                    <div class="flex space-x-2">
                        <select
                            class="border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option>All Categories</option>
                            <!-- Add categories here -->
                        </select>
                        <select
                            class="border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option>All Status</option>
                            <option>Published</option>
                            <option>Draft</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Posts List -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
                    <h2 class="font-heading text-lg font-semibold text-gray-800 font-heading">All Posts</h2>
                </div>

                <ul class="divide-y divide-gray-200">
                    @forelse ($posts as $post)
                        <li class="hover:bg-gray-50 transition duration-150">
                            <div class="px-6 py-5">
                                <div class="flex flex-col md:flex-row md:items-start">
                                    <!-- Post Image and Title -->
                                    <div class="flex-1 flex items-center min-w-0">
                                        @if ($post->featured_image)
                                            <div class="flex-shrink-0 h-16 w-16 mr-4">
                                                <img class="h-16 w-16 rounded-md object-cover shadow"
                                                    src="{{ asset('storage/' . $post->featured_image) }}"
                                                    alt="{{ $post->title }}">
                                            </div>
                                        @else
                                            <div
                                                class="flex-shrink-0 h-16 w-16 mr-4 bg-gray-100 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <h3 class="font-heading text-lg font-semibold text-primary truncate">
                                                {{ $post->title }}</h3>
                                            <p class="text-sm text-gray-500 mt-1 truncate font-body">{{ $post->excerpt }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Post Metadata -->
                                    <div class="flex flex-wrap mt-3 md:mt-0 gap-2 font-tertiary">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $post->status === 'published'
                                            ? 'bg-secondary bg-opacity-10 text-white'
                                            : ($post->status === 'draft'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($post->status) }}
                                        </span>

                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ $post->category->name }}
                                        </span>

                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ $post->author->name }}
                                        </span>

                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
                                        </span>

                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ number_format($post->view_count) }} views
                                        </span>
                                    </div>
                                </div>

                                <!-- Tags & Actions -->
                                <div class="mt-3 flex flex-col sm:flex-row sm:justify-between">
                                    <div class="mb-2 sm:mb-0 font-tertiary">
                                        @if ($post->tags->count() > 0)
                                            @foreach ($post->tags as $tag)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-accent bg-opacity-10 text-white mr-1 mb-1">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="flex space-x-2 font-body">
                                        <a href="{{ route('posts.show', $post) }}"
                                            class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm rounded-md text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="inline-flex items-center px-3 py-1 border border-primary text-sm rounded-md text-primary hover:bg-primary hover:text-white transition duration-150">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 border border-red-300 text-sm rounded-md text-red-700 hover:bg-red-50 transition duration-150"
                                            onclick="showDeleteModal({{ $post->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0
                                                                            0116.138 21H7.862a2 2 0
                                                                            01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1
                                                                            0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-12">
                            <div class="flex flex-col items-center justify-center text-center px-6 font-body">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="font-heading text-xl font-medium text-gray-900 mb-1">No posts found</h3>
                                <p class="text-gray-500 mb-6 max-w-md">Start creating content by adding your first blog
                                    post</p>
                                <a href="{{ route('posts.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow transition duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create Your First Post
                                </a>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4">
                {{ $posts->links() }}
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
