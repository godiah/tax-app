<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Taxgen Consultants LLP')</title>

    <!-- Styles / Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Global Navbar -->
    <x-navbar />

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Global Footer -->
    <x-footer />

    <!-- Scroll Back To Top Btn -->
    <button onclick="topFunction()" id="scrollTopBtn"
        class="fixed hidden bottom-4 right-4 z-50 bg-secondary hover:bg-accent text-white p-3 rounded-full shadow-lg transition-all duration-300 focus:outline-none"
        aria-label="Scroll to top">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        window.filterBar = function(categories) {
            return {
                categories, // all categories from the server
                visibleCategories: [], // first 3
                overflowCategories: [], // the rest
                open: false, // “More” dropdown state
                searchOpen: false, // your existing search toggle
                activeFilter: 'all', // which filter is highlighted

                init() {
                    // reset
                    this.open = false;
                    this.visibleCategories = this.categories.slice(0, 3);
                    this.overflowCategories = this.categories.slice(3);
                },

                applyFilter(categoryId) {
                    this.activeFilter = categoryId;
                    if (categoryId === 'all') {
                        window.location.href = '/blog';
                    } else {
                        window.location.href = `/blog?category=${categoryId}`;
                    }
                },
            }
        }
    </script>

    <script>
        function postsData(initialPosts, initialMeta, categories) {
            return {
                posts: initialPosts.map(normalize),
                meta: initialMeta,
                categories: categories,
                activeCategory: 'all',
                moreOpen: false,
                searchOpen: false,

                // normalize server data for easy Alpine use
                normalize(raw) {
                    return {
                        id: raw.id,
                        title: raw.title,
                        slug: raw.slug,
                        excerpt: raw.excerpt,
                        featured_image_url: raw.featured_image ? raw.featured_image_url : null,
                        category: raw.category,
                        author: {
                            name: raw.author.name,
                            photo_url: raw.author.profile_photo_url
                        },
                        read_time: Math.ceil((raw.content.match(/\w+/g) || []).length / 200),
                        published_date: (new Date(raw.published_at)).toLocaleDateString('en-US', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        })
                    }
                },

                // set filter and reload page 1
                filter(categoryId) {
                    this.activeCategory = categoryId;
                    this.go(1);
                },

                // navigate to `page`, keeping filter, via AJAX
                async go(page) {
                    if (page < 1 || page > this.meta.last_page) return;

                    const params = new URLSearchParams({
                        page,
                        category: this.activeCategory
                    });
                    const res = await fetch(`/blog?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const json = await res.json();

                    // update Alpine state
                    this.posts = json.data.map(r => this.normalize(r));
                    this.meta.current_page = json.current_page;
                    this.meta.last_page = json.last_page;
                }
            }
        }
    </script>


    <script>
        // Get the button
        const scrollTopBtn = document.getElementById("scrollTopBtn");

        // When the user scrolls down 300px from the top, show the button
        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                scrollTopBtn.classList.remove("hidden");
                scrollTopBtn.classList.add("flex");
            } else {
                scrollTopBtn.classList.remove("flex");
                scrollTopBtn.classList.add("hidden");
            }
        };

        // Smooth scroll to top when clicked
        function topFunction() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
