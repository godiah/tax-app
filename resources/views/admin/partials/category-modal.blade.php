<!-- Category Create Modal -->
<div id="categoryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal()"></div>

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
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-semibold leading-6 font-heading text-primary">
                            Create New Category
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-dark">
                                Add a new category to organize your content and improve navigation.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form id="createCategoryForm" action="{{ route('categories.store') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="space-y-4">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-dark">Category Name</label>
                            <input type="text" name="name" id="name"
                                class="w-full px-3 py-2 mt-1 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                placeholder="Enter category name" required>
                            <p id="title-validation-message" class="text-red-500 text-xs italic hidden"></p>
                        </div>

                        <!-- Slug Field -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-dark">Slug</label>
                            <div class="relative mt-1">
                                <input type="text" name="slug" id="slug"
                                    class="w-full px-3 py-2 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                    placeholder="category-slug" disabled>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <button type="button" id="generateSlug"
                                        class="text-xs text-accent hover:text-primary">
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Used in URLs: example.com/categories/your-slug</p>
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-dark">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full px-3 py-2 mt-1 border border-default rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                placeholder="Brief description of this category"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Action Buttons -->
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="createCategoryForm"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white border border-transparent rounded-md shadow-sm bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:ml-3 sm:w-auto sm:text-sm font-body">
                    Create Category
                </button>
                <button type="button" onclick="closeModal()"
                    class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm font-body">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Open the modal
    function openCategoryModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    // Close the modal
    function closeModal() {
        document.getElementById('categoryModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Generate slug from name
    document.getElementById('generateSlug').addEventListener('click', function() {
        const nameField = document.getElementById('name');
        const slugField = document.getElementById('slug');

        if (nameField.value) {
            // Convert to lowercase, replace spaces with hyphens, remove special characters
            const slug = nameField.value
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '');

            slugField.value = slug;
        }
    });

    // Auto-generate slug as user types in name field (optional feature)
    document.getElementById('name').addEventListener('input', function() {
        const nameField = document.getElementById('name');
        const slugField = document.getElementById('slug');

        // Only auto-generate if the slug field is empty or hasn't been manually edited
        if (!slugField.dataset.edited) {
            const slug = nameField.value
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '');

            slugField.value = slug;
        }
    });

    // Track if user has manually edited the slug
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.edited = 'true';
    });
</script>
