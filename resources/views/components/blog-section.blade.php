<section id="blog" class="py-16 lg:py-24 bg-blog-paper-accent">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Section Header -->
        <div class="text-center mb-12" data-aos="fade-up" data-aos-duration="800">
            <span
                class="inline-block bg-primary/10 text-accent px-3 py-1 rounded-full text-sm font-medium font-secondary mb-3">
                Blog
            </span>
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-primary">
                Tax Insights, Updates
                <span class="text-secondary">& Expert Advice</span>
            </h2>
            <p class="text-base text-dark-text max-w-2xl mx-auto mt-4 font-secondary" data-aos="fade-up">
                Stay updated with the latest tax regulations, expert analyses, and practical tips.
            </p>
        </div>

        @if ($posts->count() > 0)
            <!-- Blog Filter + Search (Alpine.js) -->
            <div x-data="{
                searchOpen: false,
                moreOpen: false,
                categoriesOpen: false,
                selectedCategory: '{{ $selectedCategory ?? '' }}',
                searchQuery: '{{ $searchQuery ?? '' }}',
                currentPage: '{{ request()->get('page', 1) }}',
            
                // Filter posts by category (resets to page 1)
                filterByCategory(categoryId) {
                    this.selectedCategory = categoryId;
                    this.currentPage = 1; // Reset to page 1 when changing filters
                    this.fetchFilteredPosts();
                    // Close dropdown after selection on mobile
                    this.categoriesOpen = false;
                },
            
                // Search posts (resets to page 1)
                searchPosts() {
                    this.currentPage = 1; // Reset to page 1 when searching
                    this.fetchFilteredPosts();
                },
            
                // Change page without changing filters
                fetchFilteredPostsWithPage(page) {
                    this.currentPage = page;
                    this.fetchFilteredPosts();
            
                    // Scroll to the top of blog section smoothly
                    document.getElementById('blog').scrollIntoView({ behavior: 'smooth' });
                },
            
                // Fetch filtered posts with AJAX
                fetchFilteredPosts() {
                    const url = new URL(window.location);
            
                    // Update URL parameters without page reload
                    if (this.selectedCategory) {
                        url.searchParams.set('category_id', this.selectedCategory);
                    } else {
                        url.searchParams.delete('category_id');
                    }
            
                    if (this.searchQuery) {
                        url.searchParams.set('search', this.searchQuery);
                    } else {
                        url.searchParams.delete('search');
                    }
            
                    // Set page parameter
                    if (this.currentPage > 1) {
                        url.searchParams.set('page', this.currentPage);
                    } else {
                        url.searchParams.delete('page');
                    }
            
                    // Update browser URL without refresh
                    window.history.pushState({}, '', url);
            
                    // Show loading state
                    document.getElementById('posts-container').classList.add('opacity-50');
            
                    // Fetch posts with AJAX
                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
            
                            // Update posts container with new content
                            document.getElementById('posts-container').innerHTML =
                                doc.getElementById('posts-container').innerHTML;
            
                            // Update pagination links
                            const paginationContainer = document.getElementById('pagination-container');
                            if (paginationContainer) {
                                paginationContainer.innerHTML =
                                    doc.getElementById('pagination-container').innerHTML;
                            }
            
                            // Remove loading state
                            document.getElementById('posts-container').classList.remove('opacity-50');
                        });
                }
            }" class="container mx-auto px-4 lg:px-8">

                <div class="relative mb-10">
                    {{-- Filters container --}}
                    <div :class="searchOpen ? 'mr-64' : ''"
                        class="flex flex-wrap justify-center items-center gap-3 transition-all duration-300">

                        {{-- All Posts Filter (always visible) --}}
                        <button @click="filterByCategory('')"
                            :class="selectedCategory === '' || selectedCategory === null ? 'bg-primary text-white' :
                                'border border-default text-dark hover:bg-primary hover:text-white'"
                            class="px-5 py-2 rounded-full transition duration-300 font-secondary text-sm whitespace-nowrap">
                            All Posts
                        </button>

                        {{-- Featured Categories (visible only on lg screens) --}}
                        <div class="hidden lg:block">
                            @foreach ($featuredCategories as $category)
                                <button @click="filterByCategory('{{ $category->id }}')"
                                    :class="selectedCategory == '{{ $category->id }}' ? 'bg-primary text-white' :
                                        'border border-default text-dark hover:bg-primary hover:text-white'"
                                    class="px-5 py-2 rounded-full transition duration-300 font-secondary text-sm">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>

                        {{-- More Dropdown (visible only on lg screens) --}}
                        @if ($moreCategories->count() > 0)
                            <div class="relative hidden lg:block">
                                <button @click="moreOpen = !moreOpen"
                                    class="px-5 py-2 rounded-full border border-default text-dark hover:bg-primary hover:text-white transition duration-300 font-secondary text-sm flex items-center">
                                    More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform"
                                        :class="{ 'rotate-180': moreOpen }" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="moreOpen" @click.away="moreOpen = false" x-transition
                                    class="absolute left-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-10"
                                    style="display: none;">
                                    <div class="py-1 font-secondary">
                                        @foreach ($moreCategories as $category)
                                            <button @click="filterByCategory('{{ $category->id }}'); moreOpen = false"
                                                :class="selectedCategory == '{{ $category->id }}' ?
                                                    'bg-light text-primary font-medium' : 'text-dark'"
                                                class="w-full text-left px-4 py-2 text-sm hover:bg-light">
                                                {{ $category->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Categories Dropdown (visible only on md and below screens) --}}
                        <div class="relative lg:hidden">
                            <button @click="categoriesOpen = !categoriesOpen"
                                class="px-5 py-2 rounded-full border border-default text-dark hover:bg-primary hover:text-white transition duration-300 font-secondary text-sm flex items-center">
                                Categories
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform"
                                    :class="{ 'rotate-180': categoriesOpen }" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="categoriesOpen" @click.away="categoriesOpen = false" x-transition
                                class="absolute left-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-10"
                                style="display: none;">
                                <div class="py-1 font-secondary">
                                    {{-- Include all categories in the dropdown (featured + more) --}}
                                    @foreach ($categories as $category)
                                        <button @click="filterByCategory('{{ $category->id }}'); categoriesOpen = false"
                                            :class="selectedCategory == '{{ $category->id }}' ?
                                                'bg-light text-primary font-medium' : 'text-dark'"
                                            class="w-full text-left px-4 py-2 text-sm hover:bg-light">
                                            {{ $category->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Search control --}}
                    <div class="absolute top-0 right-0 flex items-center">
                        {{-- Expanding search bar - positioned differently based on screen size --}}
                        <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2" class="mr-2 lg:static"
                            style="display: none;">

                            {{-- For large screens - appears next to filters --}}
                            <form @submit.prevent="searchPosts()"
                                class="lg:relative lg:flex lg:items-center hidden lg:block">
                                <input x-ref="searchInputLg" x-model="searchQuery" type="text"
                                    placeholder="Search blog posts…"
                                    class="w-48 md:w-64 py-2 pl-4 pr-10 rounded-full border border-default shadow-md font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <button type="submit" class="absolute right-3 text-dark hover:text-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </form>

                            {{-- For small/medium screens - appears below filters --}}
                            <div class="lg:hidden absolute right-0 top-12">
                                <form @submit.prevent="searchPosts()" class="relative flex items-center">
                                    <input x-ref="searchInputSm" x-model="searchQuery" type="text"
                                        placeholder="Search blog posts…"
                                        class="w-48 md:w-64 py-2 pl-4 pr-10 rounded-full border border-default shadow-md font-body text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <button type="submit" class="absolute right-3 text-dark hover:text-accent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Search toggle button --}}
                        <button
                            @click="searchOpen = !searchOpen; $nextTick(() => { 
                            searchOpen ? 
                                (window.innerWidth >= 1024 ? $refs.searchInputLg?.focus() : $refs.searchInputSm?.focus()) 
                                : null 
                        })"
                            class="p-2 rounded-full border border-default text-dark hover:bg-primary hover:text-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    {{-- <div x-show="searchOpen" class="w-full h-16 lg:h-0 mt-2 lg:mt-0 block lg:hidden"
                    style="display: none;"></div> --}}
                </div>

                <!-- Articles Grid -->
                <div id="posts-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="bg-white rounded-xl overflow-hidden shadow-lg flex flex-col h-full"
                                data-aos="fade-up">
                                <div class="relative h-48 overflow-hidden">
                                    @if ($post->featured_image)
                                        <img src="{{ Storage::url($post->featured_image) }}"
                                            alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-gradient-to-r from-primary to-accent"></div>
                                    @endif
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <div class="flex-grow">
                                        <span class="font-secondary text-sm text-accent font-medium mb-2 block">
                                            {{ $post->category->name }}
                                        </span>
                                        <h3 class="font-heading text-xl text-primary mb-1 h-14 overflow-hidden">
                                            <a href="{{ route('blog.show', $post) }}"
                                                class="hover:text-accent transition-colors line-clamp-2">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="font-body text-dark mb-2 text-justify h-24 overflow-hidden">
                                            {{ Str::limit($post->excerpt, 150) }}
                                        </p>
                                        <div class="flex items-center justify-between mb-2">
                                            @php
                                                $words = str_word_count(strip_tags($post->content));
                                                $readTime = ceil($words / 200);
                                            @endphp
                                            <span class="font-body text-sm text-border">{{ $readTime }} min
                                                read</span>

                                            <span class="font-body text-sm text-border">
                                                {{ $post->published_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-primary mr-3 overflow-hidden">
                                                <img src="{{ $post->author->profile_photo_url ?? asset('images/profile.jpg') }}"
                                                    alt="{{ $post->author->name }}"
                                                    class="w-10 h-10 rounded-full object-cover border-3 border-white shadow-md">
                                            </div>
                                            <span
                                                class="font-heading text-sm text-dark">{{ $post->author->name }}</span>
                                        </div>
                                        <a href="{{ route('blog.show', $post) }}"
                                            class="text-sm text-accent hover:underline font-body">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-heading text-primary mb-2">No Posts Found</h3>
                            <p class="text-dark font-body">We couldn't find any posts matching your criteria.</p>
                            <button @click="filterByCategory(''); searchQuery = ''; searchPosts()"
                                class="mt-4 px-5 py-2 bg-primary text-white rounded-full hover:bg-primary-hover transition font-secondary">
                                View All Posts
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div id="pagination-container" class="mt-10 flex justify-center">
                    @if ($posts->hasPages())
                        <div class="flex space-x-1">
                            {{-- Previous Page Link --}}
                            @if ($posts->onFirstPage())
                                <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                                    &laquo;
                                </span>
                            @else
                                <button @click="fetchFilteredPostsWithPage('{{ $posts->currentPage() - 1 }}')"
                                    class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-primary hover:text-white transition">
                                    &laquo;
                                </button>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                @if ($page == $posts->currentPage())
                                    <span class="px-4 py-2 rounded-md bg-primary text-white">
                                        {{ $page }}
                                    </span>
                                @else
                                    <button @click="fetchFilteredPostsWithPage('{{ $page }}')"
                                        class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-primary hover:text-white transition">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($posts->hasMorePages())
                                <button @click="fetchFilteredPostsWithPage('{{ $posts->currentPage() + 1 }}')"
                                    class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-primary hover:text-white transition">
                                    &raquo;
                                </button>
                            @else
                                <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-400 cursor-not-allowed">
                                    &raquo;
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Newsletter Subscription Box -->
            <div class="mt-12 bg-primary rounded-xl p-8 md:p-10" data-aos="fade-up" data-aos-delay="100">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2 mb-6 md:mb-0">
                        <h3 class="text-white text-2xl font-bold font-heading mb-3">Stay Updated on Tax Matters</h3>
                        <p class="text-white opacity-90 font-secondary">Subscribe to our newsletter and never miss
                            important tax updates, deadline reminders, and expert advice.</p>
                    </div>
                    <div class="md:w-1/2 lg:w-2/5">
                        <form class="flex flex-col sm:flex-row gap-3">
                            <input type="email" placeholder="Your email address"
                                class="flex-grow px-4 py-3 rounded-lg text-white font-semibold focus:outline-none border-2 border-accent "
                                required>
                            <button type="submit"
                                class="bg-accent hover:bg-opacity-90 transition duration-300 text-white font-bold py-3 px-6 rounded-lg font-secondary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="p-2 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h2 class="text-xl font-heading mb-2 text-primary">We're Just Getting Started!</h2>
                <p class="text-gray-600 mb-4 font-body">We haven't published any articles yet, but great content is
                    on the way!</p>
                <p class="text-gray-600 mb-6 font-body">Your interest means the world to us—it shows we're on the right
                    track.
                </p>
            </div>

            <!-- Newsletter Subscription Box -->
            <div class="mt-4 bg-primary rounded-xl p-8 md:p-10" data-aos="fade-up" data-aos-delay="100">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-1/2 mb-6 md:mb-0">
                        <h3 class="text-white text-2xl font-bold font-heading mb-3">Stay Updated on Tax Matters</h3>
                        <p class="text-white opacity-90 font-secondary">Subscribe to our newsletter and never miss
                            important tax updates, deadline reminders, and expert advice.</p>
                    </div>
                    <div class="md:w-1/2 lg:w-2/5">
                        <form class="flex flex-col sm:flex-row gap-3">
                            <input type="email" placeholder="Your email address"
                                class="flex-grow px-4 py-3 rounded-lg text-white font-semibold focus:outline-none border-2 border-accent "
                                required>
                            <button type="submit"
                                class="bg-accent hover:bg-opacity-90 transition duration-300 text-white font-bold py-3 px-6 rounded-lg font-secondary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

        @endif
    </div>
</section>
