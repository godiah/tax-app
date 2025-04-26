@extends('layouts.app')

@section('title', 'Manage Tags')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with background accent -->
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2 font-heading">Tags Management</h1>
                        <p class="font-body text-white/80 font-tertiary text-sm max-w-xl">Tags help categorize your content
                            for better
                            organization and discoverability. <br>
                            They enable readers to find related content and improve your site's navigation.</p>
                    </div>
                    <div class="flex gap-3">
                        <button onclick="openTagModal()"
                            class="px-4 py-2 bg-accent text-white rounded-lg hover:bg-opacity-90 flex items-center text-sm font-medium rounded-md shadow-lg cursor-pointer transition-colors font-body">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create New Tag
                        </button>
                        <button onclick="showHelpGuide()"
                            class="px-4 py-2 text-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-600 duration-200 flex items-center text-sm font-medium rounded-md shadow-lg cursor-pointer transition-colors font-body">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            How Tags Work
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search, Filter & Action Bar -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="tagSearch" placeholder="Search tags by name..."
                            class="pl-10 pr-4 py-2 w-full border border-default rounded-md shadow-sm text-sm font-body text-dark">
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <select id="tagSort"
                            class="border border-default rounded-md shadow-sm text-sm font-body text-dark px-3 py-2">
                            <option value="name_asc">Name (A-Z)</option>
                            <option value="name_desc">Name (Z-A)</option>
                            <option value="count_desc">Most Used</option>
                            <option value="count_asc">Least Used</option>
                            <option value="created_desc">Newest First</option>
                            <option value="created_asc">Oldest First</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- tags Table -->
            <div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create your first tag
                        </button>
                    </div>
                @else
                    <!-- Tag Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($tags as $tag)
                            <div
                                class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100 flex">
                                <div class="w-1 bg-accent rounded-l-lg"></div>

                                <div class="flex-1 p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <h3 class="text-base font-heading font-medium text-primary truncate">
                                            {{ $tag->name }}</h3>
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
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
            </div>
        </div>

        <!-- Stats Sidebar -->
        <div class="bg-blog-paper-accent p-10 mt-8 rounded-xl border border-gray-100 flex justify-center mx-auto">
            <div class="flex flex-row gap-6">
                <!-- Total Tags Card -->
                <div
                    class="bg-white flex p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow w-64">
                    <div class="flex items-center gap-3">
                        <!-- SVG Icon for Total Tags -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-accent">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5-3.9 19.5m-2.1-19.5-3.9 19.5" />
                        </svg>

                        <div class="flex flex-col">
                            <p class="text-xs text-gray-500 font-body">Total Tags</p>
                            <p class="text-lg font-bold text-accent font-tertiary">{{ $tags->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Tagged Content Card -->
                <div
                    class="bg-white flex p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow w-64">
                    <div class="flex items-center gap-3">
                        <!-- SVG Icon for Tagged Content -->
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                            </path>
                        </svg>
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-500 font-body">Tagged Content</p>
                            <p class="text-lg font-bold text-blue-700 font-tertiary">{{ $totalTaggedContent ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Most Used Tag Card -->
                <div
                    class="bg-white flex p-5 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow w-64">
                    <div class="flex items-center gap-3">
                        <!-- SVG Icon for Most Used Tag -->
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-500 font-body">Most Used Tag</p>
                            <p class="text-lg font-bold text-secondary truncate font-tertiary">
                                {{ $mostUsedTag ? $mostUsedTag->name : 'None' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x.admin-admin-wrapper>

    {{-- Include the Create Tag Modal --}}
    @include('admin.partials.tag-modal')
    @include('admin.partials.tag-help-guide-modal')

    <!-- Edit Tag Modal -->
    <div id="editTagModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            {{-- Background overlay --}}
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeEditTagModal()"></div>

            {{-- Modal panel --}}
            <div
                class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transform bg-white rounded-lg shadow-xl transition-all sm:my-8 sm:align-middle">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto bg-primary rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414
                                                                                                                                                                                                                                                                                       a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 font-heading text-primary">
                                Edit Tag
                            </h3>
                            <p class="mt-2 text-sm text-dark">
                                Update the name and URL slug for this tag.
                            </p>
                        </div>
                    </div>

                    {{-- Loading spinner --}}
                    <div id="editTagLoading" class="flex justify-center py-8">
                        <svg class="w-8 h-8 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0
                                                                                                                                                                                                                                                                                     12h4zm2 5.291A7.962 7.962 0 014 12H0c0
                                                                                                                                                                                                                                                                                     3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>

                    {{-- Edit Form --}}
                    <form id="editTagForm" method="POST" class="mt-6 hidden">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            {{-- Name --}}
                            <div>
                                <label for="edit_tag_name" class="block text-sm font-medium text-dark">Tag Name</label>
                                <input type="text" name="name" id="edit_tag_name"
                                    class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                    placeholder="Enter tag name" required>
                            </div>

                            {{-- Slug --}}
                            <div>
                                <label for="edit_tag_slug" class="block text-sm font-medium text-dark">Slug</label>
                                <div class="relative mt-1">
                                    <input type="text" name="slug" id="edit_tag_slug"
                                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                        placeholder="tag-slug">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <button type="button" id="editGenerateTagSlug"
                                            class="text-xs text-accent hover:text-primary">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    Used in URLs: example.com/tag/<em>your-tag-slug</em>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Action Buttons --}}
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="editTagForm"
                        class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-transparent rounded-md shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary font-body">
                        Update Tag
                    </button>
                    <button type="button" onclick="closeEditTagModal()"
                        class="inline-flex justify-center px-4 py-2 mt-3 text-sm font-medium text-gray-700 bg-white border rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent font-body sm:mt-0">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Tag Confirmation Modal -->
    <div id="deleteTagConfirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">

            {{-- Background overlay --}}
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDeleteTagModal()"></div>

            {{-- Modal panel --}}
            <div
                class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transform bg-white rounded-lg shadow-xl transition-all sm:my-8 sm:align-middle">
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">

                        {{-- Warning icon --}}
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54
                                                                                                                                                                                                                                                                               0 2.502-1.667 1.732-3L13.732
                                                                                                                                                                                                                                                                               4c-.77-1.333-2.694-1.333-3.464
                                                                                                                                                                                                                                                                               0L3.34 16c-.77 1.333.192 3
                                                                                                                                                                                                                                                                               1.732 3z" />
                            </svg>
                        </div>

                        {{-- Text --}}
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 font-heading text-gray-900">
                                Delete Tag
                            </h3>
                            <p class="mt-2 text-sm text-dark">
                                Are you sure you want to delete this tag? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteTagForm" action="" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-body">
                            Delete
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteTagModal()"
                        class="inline-flex justify-center px-4 py-2 mt-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent font-body sm:mt-0">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the delete confirmation for a specific tag
        function showDeleteTagModal(tagId) {
            const form = document.getElementById('deleteTagForm');
            form.action = `/tags/${tagId}`;
            document.getElementById('deleteTagConfirmModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        // Close the delete modal
        function closeDeleteTagModal() {
            document.getElementById('deleteTagConfirmModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>

    @php $tagsBase = url('tags'); @endphp
    <script>
        const TAG_BASE = @json($tagsBase);

        function editTag(tagId) {
            // show modal & loading
            document.getElementById('editTagModal').classList.remove('hidden');
            document.getElementById('editTagLoading').classList.remove('hidden');
            document.getElementById('editTagForm').classList.add('hidden');
            document.body.classList.add('overflow-hidden');

            // set form action to PUT /tags/{id}
            const form = document.getElementById('editTagForm');
            form.action = `${TAG_BASE}/${tagId}`;

            // fetch data: GET /tags/{id}/edit
            fetch(`${TAG_BASE}/${tagId}/edit`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    // populate & show form
                    document.getElementById('editTagLoading').classList.add('hidden');
                    document.getElementById('editTagForm').classList.remove('hidden');

                    document.getElementById('edit_tag_name').value = data.tag.name;
                    document.getElementById('edit_tag_slug').value = data.tag.slug;
                })
                .catch(err => {
                    console.error('Error fetching tag:', err);
                    closeEditTagModal();
                    alert('Failed to load tag data. Please try again.');
                });
        }

        function closeEditTagModal() {
            document.getElementById('editTagModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.getElementById('editTagForm').reset();
        }

        // Slug generation
        document.getElementById('editGenerateTagSlug')
            .addEventListener('click', () => {
                const name = document.getElementById('edit_tag_name').value;
                if (!name) return;
                const slug = name.toLowerCase().trim()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '');
                document.getElementById('edit_tag_slug').value = slug;
            });

        document.getElementById('edit_tag_name')
            .addEventListener('input', () => {
                const slugField = document.getElementById('edit_tag_slug');
                if (!slugField.dataset.edited) {
                    const slug = event.target.value.toLowerCase().trim()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\-]+/g, '');
                    slugField.value = slug;
                }
            });

        document.getElementById('edit_tag_slug')
            .addEventListener('input', function() {
                this.dataset.edited = 'true';
            });
    </script>

@endsection
