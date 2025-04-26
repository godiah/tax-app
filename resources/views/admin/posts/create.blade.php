@extends('layouts.app')

@section('title', 'New Post')

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
                            <span class="text-sm font-medium text-accent font-tertiary">Create New Post </span>
                            <p class="text-xl font-bold text-primary font-heading">Add fresh content to your blog</p>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Post Form -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
                    <h2 class="font-heading text-lg font-semibold text-gray-800 font-heading">Post Details</h2>
                    <p class="text-sm text-gray-500 font-tertiary">All fields marked with an asterisk (*) are required</p>
                </div>

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf

                    <div class="space-y-8">
                        <!-- Basic Information Section -->
                        <div>
                            <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                                Basic
                                Information</h3>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 font-body">
                                <!-- Title -->
                                <div class="sm:col-span-6">
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                        Title <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                        placeholder="Enter an engaging title for your post">
                                </div>

                                <!-- Status and Category -->
                                <div class="sm:col-span-3">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="status" id="status"
                                            class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm appearance-none pr-10">
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                            </option>
                                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                                Published</option>
                                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>
                                                Archived</option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Category <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="category_id" id="category_id" required
                                            class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm appearance-none pr-10">
                                            <option value="">Select a category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Excerpt -->
                                <div class="sm:col-span-6">
                                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">
                                        Excerpt/Summary <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="excerpt" id="excerpt" rows="3" required
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                        placeholder="Write a brief summary of your post (will be displayed in post lists)">{{ old('excerpt') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Media Section -->
                        <div>
                            <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                                Media</h3>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 font-body">
                                <div class="sm:col-span-6">
                                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">
                                        Featured Image
                                    </label>

                                    {{-- Hidden file input --}}
                                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                        class="hidden" onchange="handleImageChange(event)">

                                    {{-- Select / Change button --}}
                                    <button type="button" onclick="document.getElementById('featured_image').click()"
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition-colors text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586
                                                                                                                                a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2
                                                                                                                                0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span id="image-button-label">Select Image</span>
                                    </button>

                                    {{-- Preview & filename --}}
                                    <div id="image-preview-container" class="mt-3 hidden">
                                        <img id="image-preview" src="" alt="Preview"
                                            class="w-48 h-32 object-cover rounded-md border">
                                        <div class="mt-2 flex items-center justify-between w-48">
                                            <span id="image-preview-name" class="text-sm text-gray-700 truncate"></span>
                                            <button type="button" onclick="removeSelectedImage()"
                                                class="text-red-500 hover:text-red-700 text-sm">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div>
                            <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                                Post Content
                            </h3>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 font-body">
                                <div class="sm:col-span-6">
                                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                                        Content <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1">
                                        <textarea name="content" id="content" rows="12"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO & Tags Section -->
                        <div>
                            <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                                SEO & Categorization</h3>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                <!-- Meta Description -->
                                <div class="sm:col-span-6">
                                    <label for="meta_description"
                                        class="font-body block text-sm font-medium text-gray-700 mb-1">
                                        Meta Description (for SEO)
                                    </label>
                                    <textarea name="meta_description" id="meta_description" rows="3"
                                        class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 text-sm font-body"
                                        placeholder="Enter a description that will appear in search engine results">{{ old('meta_description') }}</textarea>
                                    <div class="flex justify-between mt-1 font-body">
                                        <p class="text-xs text-gray-500">Recommended length: 140-160 characters</p>
                                        <p class="text-xs text-gray-500"><span id="meta-char-count">0</span>/160</p>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <div class="sm:col-span-6 font-body">
                                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tags
                                    </label>
                                    <p class="text-sm text-gray-500 mb-3">
                                        Select relevant tags for your post
                                    </p>

                                    {{-- This hidden input holds old() values and is read & removed by your JS --}}
                                    <input type="hidden" name="tags[]" id="selected-tags"
                                        value="{{ json_encode(old('tags', [])) }}">

                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($tags as $tag)
                                            <button type="button" data-tag-id="{{ $tag->id }}"
                                                class="tag-option inline-flex items-center
                                                  px-3 py-1
                                                  text-sm font-body
                                                  rounded-full
                                                  border border-gray-300
                                                  bg-gray-100 text-gray-700
                                                  hover:bg-gray-200
                                                  transition
                                                ">
                                                {{ $tag->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-6 flex items-center justify-end">
                        <button type="button" onclick="window.location.href='{{ route('posts.index') }}'"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Cancel
                        </button>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x.admin-admin-wrapper>

    <script>
        // Immediately execute this code for the meta description counter
        (function() {
            const metaDescription = document.getElementById('meta_description');
            const counterElement = document.getElementById('meta-char-count');

            if (metaDescription && counterElement) {
                // Update character count function
                const updateCount = function() {
                    const count = metaDescription.value.length;
                    counterElement.textContent = count;

                    // Visual feedback
                    if (count > 160) {
                        counterElement.className = 'text-red-500';
                    } else {
                        counterElement.className = '';
                    }
                };

                // Set initial count
                updateCount();

                // Update on input
                metaDescription.addEventListener('input', updateCount);
            }
        })();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize SimpleMDE
            const simplemde = new SimpleMDE({
                element: document.getElementById("content"),
                spellChecker: true,
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

            // Immediately wipe any saved draft for this key:
            simplemde.clearAutosaved();

            // Style SimpleMDE editor
            const simpleMdeContainer = document.querySelector('.CodeMirror');
            const toolbarContainer = document.querySelector('.editor-toolbar');

            if (simpleMdeContainer && toolbarContainer) {
                // Fixed height and scrolling
                simpleMdeContainer.style.height = '400px';
                simpleMdeContainer.style.overflowY = 'auto';
                simpleMdeContainer.style.borderRadius = '0.375rem';

                // Fix toolbar at the top
                toolbarContainer.style.position = 'sticky';
                toolbarContainer.style.top = '0';
                toolbarContainer.style.zIndex = '10';
                toolbarContainer.style.backgroundColor = '#fff';
                toolbarContainer.style.borderBottom = '1px solid #ddd';
            }

            // Highlight border on focus
            simpleMdeContainer.addEventListener('focusin', function() {
                this.style.boxShadow = "0 0 0 .2rem rgba(31, 59, 115, 0.25)";
            });

            simpleMdeContainer.addEventListener('focusout', function() {
                this.style.boxShadow = "";
            });


            // Tag toggle functionality
            window.toggleTag = function(element) {
                element.classList.toggle('selected');
                updateSelectedTags();
            };

            function updateSelectedTags() {
                const selectedTags = [];
                document.querySelectorAll('.tag-option.selected').forEach(tag => {
                    selectedTags.push(tag.dataset.tagId);
                });
                document.getElementById('selected-tags').value = JSON.stringify(selectedTags);
            }

            // Restore previously selected tags
            try {
                const selectedTagsValue = document.getElementById('selected-tags').value;
                if (selectedTagsValue) {
                    const selectedTags = JSON.parse(selectedTagsValue);
                    document.querySelectorAll('.tag-option').forEach(tag => {
                        if (selectedTags.includes(parseInt(tag.dataset.tagId))) {
                            tag.classList.add('selected');
                        }
                    });
                }
            } catch (e) {
                console.error('Error parsing selected tags', e);
            }

            // Image preview functionality
            window.previewImage = function(input) {
                const fileNameElement = document.getElementById('file-name');
                const previewContainer = document.getElementById('image-preview-container');
                const preview = document.getElementById('image-preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };
                    reader.readAsDataURL(input.files[0]);
                    fileNameElement.textContent = input.files[0].name;
                } else {
                    fileNameElement.textContent = 'Click or drag image here to upload';
                    previewContainer.classList.add('hidden');
                }
            };
        });
    </script>

    <script>
        // Manage selected tags with real hidden inputs
        document.addEventListener('DOMContentLoaded', function() {
            const jsonInput = document.getElementById('selected-tags');
            const form = jsonInput.closest('form');
            let selected = [];

            try {
                selected = JSON.parse(jsonInput.value) || [];
            } catch (e) {
                console.warn('Invalid JSON in selected-tags:', jsonInput.value);
            }

            const addHiddenInput = id => {
                if (!form.querySelector(`input[name="tags[]"][value="${id}"]`)) {
                    const inp = document.createElement('input');
                    inp.type = 'hidden';
                    inp.name = 'tags[]';
                    inp.value = id;
                    inp.dataset.tagId = id;
                    form.appendChild(inp);
                }
            };

            const removeHiddenInput = id => {
                const inp = form.querySelector(`input[name="tags[]"][value="${id}"]`);
                if (inp) inp.remove();
            };

            document.querySelectorAll('.tag-option').forEach(el => {
                const id = el.dataset.tagId;
                if (selected.includes(parseInt(id))) {
                    el.classList.add('selected');
                    addHiddenInput(id);
                }

                el.addEventListener('click', () => {
                    el.classList.toggle('selected');
                    if (el.classList.contains('selected')) {
                        addHiddenInput(id);
                    } else {
                        removeHiddenInput(id);
                    }
                });
            });

            // Remove placeholder JSON input
            jsonInput.remove();
        });
    </script>

    <script>
        // Handle featured image preview and remove
        function handleImageChange(event) {
            const input = event.target;
            const file = input.files[0];
            const container = document.getElementById('image-preview-container');
            const previewImg = document.getElementById('image-preview');
            const previewName = document.getElementById('image-preview-name');
            const buttonLabel = document.getElementById('image-button-label');

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    container.classList.remove('hidden');
                };
                reader.readAsDataURL(file);

                buttonLabel.textContent = 'Change Image';
                previewName.textContent = file.name;
            } else {
                removeSelectedImage();
            }
        }

        function removeSelectedImage() {
            const input = document.getElementById('featured_image');
            const container = document.getElementById('image-preview-container');
            const buttonLabel = document.getElementById('image-button-label');

            input.value = '';
            container.classList.add('hidden');
            buttonLabel.textContent = 'Select Image';
        }
    </script>


@endsection
