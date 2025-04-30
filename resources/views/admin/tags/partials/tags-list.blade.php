@if ($tags->isEmpty())
    <div class="p-8 text-center font-body">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        <h3 class="text-lg font-heading font-semibold text-primary mb-2">No tags Found</h3>
        <p class="text-dark">Get started by creating your first tag.</p>
        <button onclick="openTagModal()"
            class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-tertiary">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Create your first tag
        </button>
    </div>
@else
    <!-- Tag Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($tags as $tag)
            <div
                class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 flex">
                <div class="w-1 bg-accent rounded-l-lg"></div>

                <div class="flex-1 p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-base font-heading font-medium text-primary truncate">
                            {{ $tag->name }}</h3>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                            {{ $tag->posts_count ?? 0 }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 font-secondary">
                            {{ $tag->created_at->format('M d, Y') }}
                        </span>

                        <div class="flex space-x-3">
                            <button onclick="editTag({{ $tag->id }})"
                                class="text-primary hover:text-accent transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button type="button" class="text-red-500 hover:text-red-700 transition-colors"
                                onclick="showDeleteTagModal('{{ $tag->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Pagination -->
<div class="px-4 pt-6">
    @if (method_exists($tags, 'links'))
        {{ $tags->links() }}
    @else
        <div class="bg-light rounded-lg p-4">
            <div class="text-sm text-gray-700">
                Showing <span class="font-medium">{{ count($tags) }}</span> tags
            </div>
        </div>
    @endif
</div>
