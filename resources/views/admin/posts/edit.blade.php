@extends('layouts.app')

@section('title', 'Edit Post')

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
                            <span class="text-sm font-medium text-accent font-tertiary">Edit Post </span>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data"
                    class="p-6 space-y-8 font-body">
                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div>
                        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                            Basic Information
                        </h3>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            {{-- Title --}}
                            <div class="sm:col-span-6">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                    required
                                    class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm 
                      focus:border-primary focus:ring-primary sm:text-sm"
                                    placeholder="Enter an engaging title for your post">
                            </div>

                            {{-- Status --}}
                            <div class="sm:col-span-3">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="status" id="status" required
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm
                         focus:border-primary focus:ring-primary sm:text-sm appearance-none pr-10">
                                        <option value="draft"
                                            {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option
                                            value="published"{{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="archived"
                                            {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>Archived
                                        </option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10
                                                               10.586l3.293-3.293a1 1 0
                                                               111.414 1.414l-4 4a1 1 0
                                                               01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="sm:col-span-3">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select name="category_id" id="category_id" required
                                        class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm
                         focus:border-primary focus:ring-primary sm:text-sm appearance-none pr-10">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10
                                                               10.586l3.293-3.293a1 1 0
                                                               111.414 1.414l-4 4a1 1 0
                                                               01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Excerpt --}}
                            <div class="sm:col-span-6">
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">
                                    Excerpt/Summary <span class="text-red-500">*</span>
                                </label>
                                <textarea name="excerpt" id="excerpt" rows="3" required
                                    class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm
                                    focus:border-primary focus:ring-primary sm:text-sm"
                                    placeholder="Write a brief summary of your post…">{{ old('excerpt', $post->excerpt) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Media Section --}}
                    <div>
                        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                            Media
                        </h3>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            <div class="sm:col-span-6">
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">
                                    Featured Image
                                </label>

                                {{-- Hidden file input --}}
                                <input type="file" name="featured_image" id="featured_image" accept="image/*"
                                    class="hidden" onchange="handleImageChange(event)">

                                {{-- Current image preview --}}
                                @if ($post->featured_image)
                                    <div id="image-preview-container" class="mt-3">
                                        <img id="image-preview" src="{{ asset('storage/' . $post->featured_image) }}"
                                            alt="Current" class="w-48 h-32 object-cover rounded-md border">
                                        <div class="mt-2 flex items-center justify-between w-48">
                                            <span id="image-preview-name" class="text-sm text-gray-700 truncate">
                                                {{ basename($post->featured_image) }}
                                            </span>
                                            <button type="button" onclick="removeSelectedImage()"
                                                class="text-red-500 hover:text-red-700 text-sm">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @else
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
                                @endif

                                {{-- Select / Change button --}}
                                <button type="button" onclick="document.getElementById('featured_image').click()"
                                    class="inline-flex items-center px-4 py-2 mt-3 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition-colors text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828
                                                                            0L16 16m-2-2l1.586-1.586a2 2
                                                                            0 012.828 0L20 14m-6-6h.01M6
                                                                            20h12a2 2 0 002-2V6a2 2 0 00-2-2H6
                                                                            a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span id="image-button-label">
                                        {{ $post->featured_image ? 'Change Image' : 'Select Image' }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div>
                        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                            Post Content
                        </h3>
                        <div>
                            <textarea name="content" id="content" rows="12" required>
                              {{ old('content', $post->content) }}
                            </textarea>
                        </div>
                    </div>

                    {{-- SEO & Tags Section --}}
                    <div>
                        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">
                            SEO & Categorization
                        </h3>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            {{-- Meta Description --}}
                            <div class="sm:col-span-6">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Meta Description (for SEO)
                                </label>
                                <textarea name="meta_description" id="meta_description" rows="3"
                                    class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                    placeholder="Enter a description that will appear in search engine results">{{ old('meta_description', $post->meta_description) }}</textarea>
                                <div class="flex justify-between mt-1">
                                    <p class="text-xs text-gray-500">Recommended length: 140–160 characters</p>
                                    <p class="text-xs text-gray-500"><span id="meta-char-count">0</span>/160</p>
                                </div>
                            </div>

                            {{-- Tags --}}
                            <div class="sm:col-span-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                                <p class="text-sm text-gray-500 mb-3">Select relevant tags for your post</p>

                                {{-- Hidden JSON seed --}}
                                <input type="hidden" name="tags[]" id="selected-tags"
                                    value="{{ json_encode(old('tags', $selectedTags)) }}">

                                <div class="flex flex-wrap gap-2">
                                    @foreach ($tags as $tag)
                                        <button type="button" data-tag-id="{{ $tag->id }}"
                                            class="tag-option inline-flex items-center px-3 py-1 text-sm rounded-full border border-gray-300 bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                                            {{ $tag->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-8 border-t border-gray-200 pt-6 flex justify-end">
                        <button type="button" onclick="window.location='{{ route('posts.index') }}'"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 bg-primary text-white rounded-md text-sm font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x.admin-admin-wrapper>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            //
            // 1) SIMPLEMDE + STICKY TOOLBAR
            //
            const simplemde = new SimpleMDE({
                element: document.getElementById("content"),
                spellChecker: true,
                autosave: {
                    enabled: true,
                    uniqueId: "post-content-{{ $post->id }}",
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
                },
            });

            // Make the toolbar sticky and editor scrollable
            const toolbar = document.querySelector('.editor-toolbar');
            if (toolbar) {
                toolbar.style.position = 'sticky';
                toolbar.style.top = '0';
                toolbar.style.zIndex = '10';
                toolbar.style.backgroundColor = 'white';
            }

            // Constrain the scroll area
            const cmScroll = document.querySelector('.CodeMirror-scroll');
            if (cmScroll) {
                cmScroll.style.maxHeight = '400px';
                cmScroll.style.overflowY = 'auto';
            }

            //
            // 2) IMAGE PREVIEW
            //
            function handleImageChange(event) {
                const input = event.target,
                    file = input.files[0],
                    container = document.getElementById('image-preview-container'),
                    previewImg = document.getElementById('image-preview'),
                    previewName = document.getElementById('image-preview-name'),
                    buttonLabel = document.getElementById('image-button-label');

                if (file) {
                    buttonLabel.textContent = 'Change Image';
                    previewName.textContent = file.name;
                    const reader = new FileReader();
                    reader.onload = e => {
                        previewImg.src = e.target.result;
                        container.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }

            function removeSelectedImage() {
                const input = document.getElementById('featured_image'),
                    container = document.getElementById('image-preview-container'),
                    buttonLabel = document.getElementById('image-button-label');
                input.value = '';
                container.classList.add('hidden');
                buttonLabel.textContent = 'Select Image';
            }
            window.handleImageChange = handleImageChange;
            window.removeSelectedImage = removeSelectedImage;

            //
            // 3) TAG PILL PICKER
            //
            (function() {
                const jsonInput = document.getElementById('selected-tags');
                let selected = [];
                try {
                    selected = JSON.parse(jsonInput.value)
                } catch {}
                const form = jsonInput.closest('form');

                function addHidden(id) {
                    if (!form.querySelector(`input[name="tags[]"][value="${id}"]`)) {
                        const i = document.createElement('input');
                        i.type = 'hidden';
                        i.name = 'tags[]';
                        i.value = id;
                        i.dataset.tagId = id;
                        form.appendChild(i);
                    }
                }

                function removeHidden(id) {
                    const i = form.querySelector(`input[name="tags[]"][value="${id}"]`);
                    if (i) i.remove();
                }

                document.querySelectorAll('.tag-option').forEach(el => {
                    const id = parseInt(el.dataset.tagId, 10);
                    if (selected.includes(id)) {
                        el.classList.add('selected');
                        addHidden(id);
                    }
                    el.addEventListener('click', () => {
                        el.classList.toggle('selected');
                        el.classList.contains('selected') ? addHidden(id) : removeHidden(id);
                    });
                });
                jsonInput.remove();
            })();

            //
            // 4) META‐DESCRIPTION COUNTER
            //
            (function() {
                const meta = document.getElementById('meta_description');
                if (!meta) return;
                const counter = document.getElementById('meta-char-count');

                function update() {
                    const l = meta.value.length;
                    counter.textContent = l;
                    counter.classList.toggle('text-red-500', l > 160);
                }
                meta.addEventListener('input', update);
                update();
            })();

        });
    </script>
@endsection
