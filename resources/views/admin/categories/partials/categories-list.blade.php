@if ($categories->isEmpty())
    <div class="p-8 text-center font-body">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        <h3 class="text-lg font-heading font-semibold text-primary mb-2">No Categories Found</h3>
        <p class="text-dark">Get started by creating your first category.</p>
        <button onclick="openCategoryModal()"
            class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-tertiary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Category
        </button>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($categories as $category)
            <div
                class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="bg-blog-paper-accent px-5 py-4 border-b border-default">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-heading text-primary font-medium truncate">
                            {{ $category->name }}</h3>
                        <span
                            class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold font-tertiary rounded-full">
                            {{ $category->posts_count ?? 0 }} posts
                        </span>
                    </div>
                </div>

                <div class="px-5 py-4">
                    <div class="text-sm text-dark font-body h-16 overflow-y-auto pr-1 custom-scrollbar">
                        {{ $category->description ?: 'No description' }}
                    </div>
                </div>

                <div class="bg-light px-5 py-3 flex justify-between items-center">
                    <span class="text-xs text-gray-500 font-tertiary">
                        Created {{ $category->created_at->format('M d, Y') }}
                    </span>

                    <div class="flex space-x-3">
                        <button onclick="editCategory({{ $category->id }})"
                            class="text-primary hover:text-accent transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <button type="button" class="text-red-500 hover:text-red-700 transition-colors"
                            onclick="showDeleteModal('{{ $category->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="px-4 pt-6">
        @if (method_exists($categories, 'links'))
            {{ $categories->links() }}
        @else
            <div class="bg-light rounded-lg p-4">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ count($categories) }}</span> categories
                </div>
            </div>
        @endif
    </div>
@endif
