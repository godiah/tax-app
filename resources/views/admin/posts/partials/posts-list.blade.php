@if ($posts->count() > 0)
    <ul class="divide-y divide-gray-200">
        @foreach ($posts as $post)
            <li class="hover:bg-gray-50 transition duration-150">
                <div class="px-6 py-5">
                    <div class="flex flex-col md:flex-row md:items-start">
                        <!-- Post Image and Title -->
                        <div class="flex-1 flex items-center min-w-0">
                            @if ($post->featured_image)
                                <div class="flex-shrink-0 h-16 w-16 mr-4">
                                    <img class="h-16 w-16 rounded-md object-cover shadow"
                                        src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                </div>
                            @else
                                <div
                                    class="flex-shrink-0 h-16 w-16 mr-4 bg-gray-100 rounded-md flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
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
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-primary bg-opacity-10 text-white mr-1 mb-1">
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
        @endforeach
    </ul>

    <!-- Pagination -->
    <div class="px-6 py-4">
        {{ $posts->links() }}
    </div>
@else
    <div class="py-12">
        <div class="flex flex-col items-center justify-center text-center px-6 font-body">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="font-heading text-xl font-medium text-gray-900 mb-1">No posts found</h3>
            <p class="text-gray-500 mb-6 max-w-md">No posts match your search criteria</p>
            <a href="{{ route('posts.create') }}"
                class="inline-flex items-center px-4 py-2 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Post
            </a>
        </div>
    </div>
@endif
