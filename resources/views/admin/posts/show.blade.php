@extends('layouts.app')

@section('title', 'Manage Post')

@section('content')
    <x.admin-admin-wrapper>
        <!-- Page Header with Texture Background -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-blog-paper-accent py-6 mb-6 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-white p-3 rounded-full shadow-md mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-accent font-tertiary">Blog Post Management</span>
                            <h1 class="text-xl font-bold text-primary font-heading">{{ $post->title }}</h1>
                        </div>
                    </div>
                    <div class="flex space-x-2 font-body">
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Posts
                        </a>
                        <a href="{{ route('posts.edit', $post) }}"
                            class="inline-flex items-center px-4 py-2 btn-primary rounded-lg shadow-sm text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Post
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <!-- Post Header Information -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-wrap justify-between items-center">
                        <div class="w-full">
                            <div class="flex items-center mb-3 font-body">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $post->status === 'published'
                                        ? 'status-published'
                                        : ($post->status === 'draft'
                                            ? 'status-draft'
                                            : 'status-archived') }}">
                                    <span
                                        class="w-2 h-2 mr-2 rounded-full 
                                        {{ $post->status === 'published'
                                            ? 'bg-green-500'
                                            : ($post->status === 'draft'
                                                ? 'bg-yellow-500'
                                                : 'bg-gray-500') }}"></span>
                                    {{ ucfirst($post->status) }}
                                </span>
                                <span
                                    class="ml-4 text-sm font-medium bg-primary bg-opacity-10 text-white px-3 py-1 rounded-full">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-600 space-y-1 font-body">
                                <div class="flex flex-wrap items-center">
                                    <div class="flex items-center mr-6 mb-2 md:mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>{{ $post->author->name }}</span>
                                    </div>
                                    <div class="flex items-center mr-6 mb-2 md:mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-primary"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Created: {{ $post->created_at->format('M d, Y H:i') }}</span>
                                    </div>
                                    @if ($post->published_at)
                                        <div class="flex items-center mr-6 mb-2 md:mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-secondary"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                            <span>Published: {{ $post->published_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    @endif
                                    @if ($post->view_count > 0)
                                        <div class="flex items-center mb-2 md:mb-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-accent"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span>{{ $post->view_count }} views</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions Button with Dropdown -->
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="px-6 pt-4 border-b border-gray-200 font-body">
                    <div class="flex space-x-8">
                        <!-- Content Tab -->
                        <button id="content-btn"
                            class="flex items-center gap-2 p-4 font-medium border-b-2 border-accent text-accent hover:text-secondary hover:border-secondary"
                            onclick="showTab('content')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Content
                        </button>

                        <!-- Comments Tab -->
                        <button id="comments-btn"
                            class="flex items-center gap-2 p-4 font-medium border-b-2 border-transparent text-neutral-600 hover:text-secondary hover:border-secondary"
                            onclick="showTab('comments')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            Comments
                        </button>
                    </div>
                </div>

                {{-- Content Pane --}}
                <div id="content-content" class="tab-content">
                    <!-- Tags Display -->
                    @if ($post->tags->count() > 0)
                        <div class="px-6 py-4 bg-gray-50">
                            <div class="flex flex-wrap items-center">
                                <span class="mr-3 text-sm font-medium font-tertiary text-gray-500">Tags:</span>
                                @foreach ($post->tags as $tag)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium font-body bg-primary bg-opacity-10 text-white mr-2">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Featured Image Display -->
                    @if ($post->featured_image)
                        <div class="px-6 py-5 border-b border-gray-100">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-64 object-cover rounded-lg shadow-sm font-body">
                                <div class="absolute bottom-4 right-4">
                                    <span
                                        class="font-tertiary inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-white bg-opacity-90 text-primary shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Featured Image
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Post Excerpt -->
                    @if ($post->excerpt)
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
                            <h3 class="text-md font-semibold text-primary flex items-center mb-3 font-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Post Excerpt
                            </h3>
                            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                                <p class="text-gray-700 font-body">{{ $post->excerpt }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Post Content -->
                    <div class="px-6 py-5">
                        <h3 class="text-md font-semibold text-primary flex items-center mb-3 font-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Content
                        </h3>

                        <!-- Content Card with Preview -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                            <div id="previewContainer" class="content-preview collapsed">
                                <div class="p-5 prose font-body">
                                    {!! $post->content_html !!}
                                </div>
                            </div>

                            <!-- Expand Button -->
                            <div class="text-center p-4 border-t border-gray-100 font-tertiary">
                                <button id="toggleContentBtn"
                                    class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span id="toggleContentText">View Full Content</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Meta Description (SEO) -->
                    @if ($post->meta_description)
                        <div class="px-6 py-5 border-t border-gray-100 bg-gray-50">
                            <h3 class="text-md font-semibold text-primary flex items-center mb-3 font-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                SEO Meta Description
                            </h3>
                            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-sm font-body">
                                <p class="text-gray-700">{{ $post->meta_description }}</p>
                                <div class="mt-2 flex items-center">
                                    <span
                                        class="text-xs {{ strlen($post->meta_description) > 100 ? 'text-green-500' : 'text-red-500' }}">
                                        {{ strlen($post->meta_description) }} / 160 characters
                                    </span>
                                    <div class="ml-2 w-32 bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full {{ strlen($post->meta_description) > 100 ? 'bg-green-500' : 'bg-red-500' }}"
                                            style="width: {{ min(100, (strlen($post->meta_description) / 160) * 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Comments Pane --}}
                <div id="comments-content" class="tab-content hidden px-6 py-5">
                    <h3 class="text-lg font-heading font-bold text-primary mb-4">Comments</h3>

                    <p class="text-gray-500">No comments yet.</p>
                </div>

                <!-- Related stats and metrics -->
                <div class="px-6 py-5 border-t border-gray-100">
                    <h3 class="text-md font-semibold text-primary flex items-center mb-3 font-tertiary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Performance Metrics
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-primary bg-opacity-10 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-body">Views</p>
                                    <p class="text-xl font-semibold text-primary font-tertiary">
                                        {{ $post->view_count ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-secondary bg-opacity-10 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-body">Likes</p>
                                    <p class="text-xl font-semibold text-secondary font-tertiary">
                                        {{ $post->like_count }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-accent bg-opacity-10 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-body">Comments</p>
                                    <p class="text-xl font-semibold text-accent font-tertiary">
                                        {{ $post->comments_count ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-gray-700 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 font-body">Shares</p>
                                    <p class="text-xl font-semibold text-gray-600 font-tertiary">
                                        {{ $post->shares_count ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm font-body">
                        <span class="text-gray-500">Last updated: {{ $post->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex space-x-3 font-tertiary">
                        <a href="{{ route('posts.index') }}"
                            class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium">
                            Back to Posts
                        </a>
                        @if ($post->status === 'draft')
                            <form action="{{ route('posts.publish', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 btn-accent rounded-lg shadow-sm text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0
                                                         01-3.417.592l-2.147-6.15M18 13a3
                                                         3 0 100-6M5.436 13.683A4.001
                                                         4.001 0 017 6h1.832c4.1 0
                                                         7.625-1.234 9.168-3v14c-1.543-1.766
                                                         -5.067-3-9.168-3H7a3.988 3.988
                                                         0 01-1.564-.317z" />
                                    </svg>
                                    Publish Now
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('posts.edit', $post) }}"
                            class="inline-flex items-center px-4 py-2 btn-primary rounded-lg shadow-sm text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Post
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x.admin-admin-wrapper>

    <!-- JavaScript for SimpleMDE and interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab navigation
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    this.classList.add('tab-active');
                });
            });

            // Initialize SimpleMDE if in edit mode
            if (document.getElementById('content')) {
                const simplemde = new SimpleMDE({
                    element: document.getElementById("content"),
                    spellChecker: true,
                    autosave: {
                        enabled: true,
                        uniqueId: "post-content",
                        delay: 1000,
                    },
                    toolbar: [
                        "bold", "italic", "heading", "|",
                        "quote", "unordered-list", "ordered-list", "|",
                        "link", "image", "table", "|",
                        "preview", "side-by-side", "fullscreen", "|",
                        "guide"
                    ],
                    placeholder: "Write your post content using Markdown...",
                    status: ["autosave", "lines", "words", "cursor"],
                    tabSize: 4,
                    renderingConfig: {
                        singleLineBreaks: false,
                        codeSyntaxHighlighting: true,
                    }
                });

                // Style SimpleMDE to match your form styling
                const simpleMdeContainer = document.querySelector('.CodeMirror');
                if (simpleMdeContainer) {
                    simpleMdeContainer.style.borderRadius = '0.375rem';

                    simpleMdeContainer.addEventListener('focusin', function() {
                        this.style.boxShadow = "0 0 0 .2rem rgba(31, 59, 115, 0.25)";
                    });

                    simpleMdeContainer.addEventListener('focusout', function() {
                        this.style.boxShadow = "";
                        this.style.borderColor = "";
                    });
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const preview = document.getElementById('previewContainer');
            const btn = document.getElementById('toggleContentBtn');
            const text = document.getElementById('toggleContentText');

            if (preview && btn && text) {
                btn.addEventListener('click', () => {
                    // Toggle the "collapsed" class
                    preview.classList.toggle('collapsed');

                    // Update the button label based on current state
                    if (preview.classList.contains('collapsed')) {
                        text.textContent = 'View Full Content';
                    } else {
                        text.textContent = 'Show Less';
                    }
                });
            }
        });
    </script>

    {{-- Tab & Collapse JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.showTab = function(tabName) {
                // Hide all content
                document.querySelectorAll(".tab-content")
                    .forEach(el => el.classList.add("hidden"));

                // Show only the chosen pane
                document.getElementById(tabName + "-content")
                    .classList.remove("hidden");

                // Reset all buttons to inactive state
                document.querySelectorAll('button[id$="-btn"]')
                    .forEach(btn => {
                        // Remove active styles
                        btn.classList.remove("border-accent", "text-accent");
                        // Add inactive styles
                        btn.classList.add("border-transparent", "text-neutral-600");

                        // Keep hover styles on all buttons
                        // This makes sure the hover class remains even after resetting
                        if (!btn.classList.contains("hover:text-secondary")) {
                            btn.classList.add("hover:text-secondary", "hover:border-secondary");
                        }
                    });

                // Activate the selected button
                const activeBtn = document.getElementById(tabName + "-btn");
                // Remove inactive styles
                activeBtn.classList.remove("border-transparent", "text-neutral-600");
                // Add active styles 
                activeBtn.classList.add("border-accent", "text-accent");
            }

            // Initialize tabs (optional)
            showTab('content');
        });
    </script>


@endsection
