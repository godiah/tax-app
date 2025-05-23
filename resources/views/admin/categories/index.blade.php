@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with background accent -->
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2 font-heading">Category Management</h1>
                        <p class="font-body text-white/80 font-tertiary">Organize and manage your content categories</p>
                    </div>
                    <div>
                        <button onclick="openCategoryModal()"
                            class="inline-flex items-center px-4 py-2 bg-accent text-white rounded-lg hover:bg-opacity-90 text-sm font-medium rounded-md shadow-lg cursor-pointer transition-colors font-body">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Category
                        </button>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Bar -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <div class="flex-grow">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="search" placeholder="Search categories..."
                                class="pl-10 pr-4 py-2 w-full border border-default rounded-md shadow-sm text-sm font-body text-dark">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <select id="sort"
                            class="border border-default rounded-md shadow-sm text-sm font-body text-dark px-3 py-2">
                            <option value="name_asc">Name (A-Z)</option>
                            <option value="name_desc">Name (Z-A)</option>
                            <option value="created_desc">Newest First</option>
                            <option value="created_asc">Oldest First</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Categories Table -->
            <div id="categories-container">
                @include('admin.categories.partials.categories-list', ['categories' => $categories])
            </div>
        </div>
    </x.admin-admin-wrapper>

    {{-- Include the Create Category Modal --}}
    @include('admin.partials.category-modal')

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeEditModal()"></div>

            <!-- Modal panel -->
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-primary rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 font-heading text-primary">
                                Edit Category
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-dark">
                                    Update the details for this category.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form with loading state -->
                    <div id="editCategoryLoading" class="flex justify-center py-8">
                        <svg class="w-8 h-8 animate-spin text-primary" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>

                    <form id="editCategoryForm" action="" method="POST" class="mt-6 hidden">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <!-- Name Field -->
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-dark">Category Name</label>
                                <input type="text" name="name" id="edit_name"
                                    class="w-full px-3 py-2 mt-1 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                    placeholder="Enter category name" required>
                            </div>

                            <!-- Slug Field -->
                            <div>
                                <label for="edit_slug" class="block text-sm font-medium text-dark">Slug</label>
                                <div class="relative mt-1">
                                    <input type="text" name="slug" id="edit_slug"
                                        class="w-full px-3 py-2 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                        placeholder="category-slug" disabled>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <button type="button" id="editGenerateSlug"
                                            class="text-xs text-accent hover:text-primary">
                                            Generate
                                        </button>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Used in URLs: example.com/categories/your-slug</p>
                            </div>

                            <!-- Description Field -->
                            <div>
                                <label for="edit_description"
                                    class="block text-sm font-medium text-dark">Description</label>
                                <textarea name="description" id="edit_description" rows="3"
                                    class="w-full px-3 py-2 mt-1 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                    placeholder="Brief description of this category"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Action Buttons -->
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" form="editCategoryForm"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm font-body">
                        Update Category
                    </button>
                    <button type="button" onclick="closeEditModal()"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm font-body">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeDeleteModal()"></div>

            <!-- Modal panel -->
            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 font-heading text-gray-900">
                                Delete Category
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-dark">
                                    Are you sure you want to delete this category? This action cannot be undone and all
                                    <span class="text-accent">related posts</span> will be deleted too.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteCategoryForm" action="" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm font-body">
                            Delete
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm font-body">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle the delete modal -->
    <script>
        function showDeleteModal(categoryId) {
            // Set the form action dynamically with the category ID
            const deleteForm = document.getElementById('deleteCategoryForm');
            deleteForm.action = `/categories/${categoryId}`;

            // Show the modal
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>

    @php $categoriesBase = url('categories'); @endphp
    <!-- JavaScript to handle the edit modal -->
    <script>
        const BASE = @json($categoriesBase);

        // Function to edit a category using AJAX
        function editCategory(categoryId) {
            // Show the modal with loading state
            document.getElementById('editCategoryModal').classList.remove('hidden');
            document.getElementById('editCategoryLoading').classList.remove('hidden');
            document.getElementById('editCategoryForm').classList.add('hidden');
            document.body.classList.add('overflow-hidden');

            // Set the form action URL
            const form = document.getElementById('editCategoryForm');
            form.action = `${BASE}/${categoryId}`;

            // Fetch category data
            fetch(`${BASE}/${categoryId}/edit`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hide loading and show form
                    document.getElementById('editCategoryLoading').classList.add('hidden');
                    document.getElementById('editCategoryForm').classList.remove('hidden');

                    // Populate form fields
                    document.getElementById('edit_name').value = data.category.name;
                    document.getElementById('edit_slug').value = data.category.slug;
                    document.getElementById('edit_description').value = data.category.description || '';
                })
                .catch(error => {
                    console.error('Error fetching category:', error);
                    closeEditModal();

                    // Show flash error notification
                    alert('Failed to load category data. Please try again.');
                });
        }

        // Close the edit modal
        function closeEditModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');

            // Clear form data
            document.getElementById('editCategoryForm').reset();
        }

        // Generate slug from name in edit form
        document.getElementById('editGenerateSlug').addEventListener('click', function() {
            const nameField = document.getElementById('edit_name');
            const slugField = document.getElementById('edit_slug');

            if (nameField.value) {
                const slug = nameField.value
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '');

                slugField.value = slug;
            }
        });
    </script>

    <script>
        // public/js/category-filter.js
        (() => {
            const searchInput = document.getElementById('search');
            const sortSelect = document.getElementById('sort');
            const container = document.getElementById('categories-container');
            let debounceTimer;

            // Build "?search=…&sort=…" string
            function buildQuery() {
                const params = new URLSearchParams();
                const s = searchInput.value.trim();
                if (s) params.set('search', s);

                // Always include sort parameter
                params.set('sort', sortSelect.value || 'name_asc');

                return params.toString();
            }

            // Fetch HTML and swap in
            function loadUrl(url, push = true) {
                container.style.opacity = 0.5;
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(res => res.ok ? res.text() : Promise.reject(res.statusText))
                    .then(html => {
                        container.innerHTML = html;
                        container.style.opacity = 1;
                        if (push) window.history.pushState({}, '', url);
                    })
                    .catch(err => {
                        console.error('Load error:', err);
                        container.style.opacity = 1;
                    });
            }

            // Triggered on search or sort change
            function applyFilters() {
                const base = window.location.pathname;
                const q = buildQuery();
                const url = q ? `${base}?${q}` : base;
                loadUrl(url);
            }

            // Debounce the search input
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(applyFilters, 300);
            });

            // Instant on sort dropdown
            sortSelect.addEventListener('change', applyFilters);

            // Intercept pagination link clicks
            container.addEventListener('click', e => {
                const a = e.target.closest('.pagination a');
                if (!a) return;
                e.preventDefault();
                loadUrl(a.href);
            });

            // Back/forward support
            window.addEventListener('popstate', () => {
                const params = new URLSearchParams(window.location.search);
                searchInput.value = params.get('search') || '';
                sortSelect.value = params.get('sort') || 'name_asc';
                loadUrl(window.location.href, false);
            });

            // On page load, set form values from URL params if they exist
            document.addEventListener('DOMContentLoaded', () => {
                const params = new URLSearchParams(window.location.search);
                searchInput.value = params.get('search') || '';
                sortSelect.value = params.get('sort') || 'name_asc';

                // Apply initial filters if there are URL parameters
                if (params.toString()) {
                    loadUrl(window.location.href, false);
                }
            });
        })();
    </script>

@endsection
