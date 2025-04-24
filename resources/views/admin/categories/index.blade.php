@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h1 class="text-2xl font-heading font-bold text-primary">Category Management</h1>
                <p class="text-dark mt-1">Organize and manage your content categories</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button onclick="openCategoryModal()"
                    class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-body">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Category
                </button>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="bg-white rounded-lg border border-default p-4 mb-6 shadow-sm">
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
                            class="pl-10 pr-4 py-2 w-full border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body text-dark">
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <select id="sort"
                        class="border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body text-dark px-3 py-2">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="created_desc">Newest First</option>
                        <option value="created_asc">Oldest First</option>
                    </select>
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-default rounded-md shadow-sm text-dark hover:bg-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="bg-white rounded-lg border border-default shadow-sm overflow-hidden">
            @if ($categories->isEmpty())
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <h3 class="text-lg font-heading font-semibold text-primary mb-2">No Categories Found</h3>
                    <p class="text-dark">Get started by creating your first category.</p>
                    <button onclick="openCategoryModal()"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Category
                    </button>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-dark uppercase tracking-wider">Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-dark uppercase tracking-wider">
                                    Description</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-dark uppercase tracking-wider">
                                    Content Count</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-dark uppercase tracking-wider">
                                    Created</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-dark uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-light">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-primary">{{ $category->name }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 line-clamp-2">
                                            {{ $category->description ?: 'No description' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $category->posts_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $category->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button onclick="editCategory({{ $category->id }})"
                                                class="text-primary hover:text-accent">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-red-500 hover:text-red-700"
                                                onclick="showDeleteModal('{{ $category->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    @if (method_exists($categories, 'links'))
                        {{ $categories->links() }}
                    @else
                        <div class="flex justify-between items-center">
                            <div class="text-sm text-gray-700">
                                Showing <span class="font-medium">{{ count($categories) }}</span> categories
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

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
                                        placeholder="category-slug">
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
                                    Are you sure you want to delete this category? This action cannot be undone.
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

@endsection
