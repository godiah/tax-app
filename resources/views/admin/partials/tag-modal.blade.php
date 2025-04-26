<!-- Tag Create Modal -->
<div id="tagModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeTagModal()"></div>

        {{-- Modal panel --}}
        <div
            class="inline-block w-full max-w-lg overflow-hidden text-left align-bottom transform bg-white rounded-lg shadow-xl transition-all sm:my-8 sm:align-middle">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-primary rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010
                       2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013
                       12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-semibold leading-6 font-heading text-primary">
                            Create New Tag
                        </h3>
                        <p class="mt-2 text-sm text-dark">
                            Add a new tag to help users filter and discover specific topics across your posts.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <form id="createTagForm" action="{{ route('tags.store') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="space-y-4">
                        {{-- Name Field --}}
                        <div>
                            <label for="tag_name" class="block text-sm font-medium text-dark">Tag Name</label>
                            <input type="text" name="name" id="tag_name"
                                class="w-full px-3 py-2 mt-1 border rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                placeholder="Enter tag name" required>
                            <p id="tag-validation-message" class="mt-1 text-xs text-red-500 italic hidden"></p>
                        </div>

                        {{-- Slug Field --}}
                        <div>
                            <label for="tag_slug" class="block text-sm font-medium text-dark">Slug</label>
                            <div class="relative mt-1">
                                <input type="text" name="slug" id="tag_slug"
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-accent focus:border-accent font-body"
                                    placeholder="tag-slug">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <button type="button" id="generateTagSlug"
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
            <div class="px-4 py-3 bg-gray-50 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit" form="createTagForm"
                    class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-primary border border-transparent rounded-md shadow-sm hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary font-body">
                    Create Tag
                </button>
                <button type="button" onclick="closeTagModal()"
                    class="inline-flex justify-center px-4 py-2 mt-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent font-body sm:mt-0">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Open the Tag modal
    function openTagModal() {
        document.getElementById('tagModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    // Close the Tag modal
    function closeTagModal() {
        document.getElementById('tagModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        // Reset form and validation
        const form = document.getElementById('createTagForm');
        form.reset();
        document.getElementById('tag-validation-message').classList.add('hidden');
    }

    // Generate slug from tag name
    document.getElementById('generateTagSlug').addEventListener('click', () => {
        const nameField = document.getElementById('tag_name');
        const slugField = document.getElementById('tag_slug');
        if (!nameField.value) return;

        const slug = nameField.value
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '');
        slugField.value = slug;
    });

    // Auto‐generate slug on input (unless manually edited)
    document.getElementById('tag_name').addEventListener('input', () => {
        const nameField = document.getElementById('tag_name');
        const slugField = document.getElementById('tag_slug');
        if (!slugField.dataset.edited) {
            const slug = nameField.value
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '');
            slugField.value = slug;
        }
    });

    // Mark slug as manually edited
    document.getElementById('tag_slug').addEventListener('input', function() {
        this.dataset.edited = 'true';
    });
</script>
