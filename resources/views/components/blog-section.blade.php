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

        <!-- Blog Filter + Search  -->
        <div x-data="postsData(@js($posts->items()), { current_page: {{ $posts->currentPage() }}, last_page: {{ $posts->lastPage() }} }, @js($categories))" x-init="" class="space-y-8">
            {{-- FILTER BAR --}}
            <div class="relative mb-10" x-data="{ searchOpen: false }">
                {{-- reuse your “All + 3 + More” markup, but call filter(cat.id) --}}
                <div :class="searchOpen ? 'mr-64' : ''"
                    class="flex flex-wrap justify-center items-center gap-3 transition-all duration-300">
                    <button @click="filter('all')"
                        :class="activeCategory === 'all' ? 'bg-primary text-white' :
                            'border border-default text-dark hover:bg-primary hover:text-white'"
                        class="px-5 py-2 rounded-full font-secondary text-sm transition">All Posts</button>

                    <template x-for="(cat, idx) in categories.slice(0,3)" :key="cat.id">
                        <button @click="filter(cat.id)" x-text="cat.name"
                            :class="activeCategory === cat.id ? 'bg-primary text-white' :
                                'border border-default text-dark hover:bg-primary hover:text-white'"
                            class="px-5 py-2 rounded-full font-secondary text-sm transition"></button>
                    </template>

                    <div x-show="categories.length>3" class="relative" x-cloak>
                        <button @click="moreOpen = !moreOpen"
                            class="px-5 py-2 rounded-full border font-secondary text-sm flex items-center transition">
                            More
                            <svg class="h-4 w-4 ml-1 transition-transform" :class="{ 'rotate-180': moreOpen }">
                                <path d="M19 9l-7 7-7-7" stroke="currentColor" stroke-width="2" fill="none"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                        <div x-show="moreOpen" @click.away="moreOpen=false" x-transition
                            class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-10"
                            x-cloak>
                            <template x-for="cat in categories.slice(3)" :key="cat.id">
                                <button @click="filter(cat.id); moreOpen=false" x-text="cat.name"
                                    :class="activeCategory === cat.id ? 'bg-light' : ''"
                                    class="block w-full text-left px-4 py-2 font-secondary text-sm hover:bg-light"></button>
                            </template>
                        </div>
                    </div>

                    {{-- your search toggle on the right --}}
                    <div class="absolute top-0 right-0 flex items-center">
                        <div x-show="searchOpen" x-transition…>…</div>
                        <button @click="searchOpen=!searchOpen; $nextTick(()=>searchOpen&&$refs.searchInput.focus())"
                            …>🔍</button>
                    </div>
                </div>
            </div>



            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="post in posts" :key="post.id">
                    <div class="bg-white rounded-xl shadow-lg flex flex-col h-full">
                        <div class="relative h-48 overflow-hidden">
                            <img x-show="post.featured_image" :src="post.featured_image_url"
                                class="w-full h-full object-cover">
                            <div x-show="!post.featured_image"
                                class="h-full w-full bg-gradient-to-r from-primary to-secondary"></div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex-grow">
                                <span class="font-secondary text-sm text-accent font-medium mb-2 block"
                                    x-text="post.category.name"></span>
                                <h3 class="font-heading text-xl text-primary mb-1 h-14 overflow-hidden">
                                    <a :href="`/blog/${post.slug}`" class="hover:text-accent line-clamp-2"
                                        x-text="post.title"></a>
                                </h3>
                                <p class="font-body text-dark mb-2 text-justify h-24 overflow-hidden"
                                    x-text="post.excerpt"></p>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-body text-sm text-border"
                                        x-text="post.read_time + ' min read'"></span>
                                    <span class="font-body text-sm text-border" x-text="post.published_date"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                <div class="flex items-center">
                                    <img :src="post.author.photo_url"
                                        class="w-10 h-10 rounded-full mr-3 object-cover border-3 border-white shadow-md">
                                    <span class="font-heading text-sm text-dark" x-text="post.author.name"></span>
                                </div>
                                <a :href="`/blog/${post.slug}`"
                                    class="text-sm text-accent hover:underline font-body">Read More →</a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Pagination links --}}
            <div class="mt-8 flex justify-center space-x-2">
                <button @click="go(meta.current_page - 1)" :disabled="meta.current_page === 1"
                    class="px-3 py-1 border rounded">&lt;</button>

                <template x-for="p in Array(meta.last_page).fill().map((_,i)=>i+1)" :key="p">
                    <button @click="go(p)" :class="p === meta.current_page ? 'bg-primary text-white' : 'border'
                    }"
                        class="px-3 py-1 rounded" x-text="p"></button>
                </template>

                <button @click="go(meta.current_page + 1)" :disabled="meta.current_page === meta.last_page"
                    class="px-3 py-1 border rounded">&gt;</button>
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
        </div>
</section>
