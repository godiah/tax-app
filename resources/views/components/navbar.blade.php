<!-- Navigation Bar -->
<header>
    <nav class="bg-white shadow-md fixed w-full top-0 z-50 font-body">
        <!-- Info Bar -->
        <x-info-details />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <img class="h-10 md:h-12 w-auto" src="{{ asset('images/logo.jpg') }}" alt="Logo">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <x-navbar-nav-links href="#home" :active="request()->is('/')">
                        Home
                    </x-navbar-nav-links>
                    <x-navbar-nav-links href="#about" :active="request()->is('about')">
                        About
                    </x-navbar-nav-links>
                    <x-navbar-nav-links href="#services" :active="request()->is('services')">
                        Services
                    </x-navbar-nav-links>
                    {{-- <x-navbar-nav-links href="#testimonials" :active="request()->is('testimonials')">
                        Testimonials
                    </x-navbar-nav-links> --}}

                    <x-navbar-nav-links href="#blog" :active="request()->is('blog')">
                        Blog
                    </x-navbar-nav-links>
                    <x-navbar-nav-links href="#contact" :active="request()->is('contact')">
                        Contact
                    </x-navbar-nav-links>

                    <a href="#contact"
                        class="bg-gradient-to-r from-primary to-secondary shadow-lg hover:shadow-xl hover:from-primary/90 hover:to-secondary/90 text-white px-5 py-2.5 rounded-md text-sm font-medium transition-colors duration-200 flex items-center ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Schedule a Consultation
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-dark hover:text-primary hover:bg-light transition-colors duration-200 focus:outline-none"
                        onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-4 space-y-2 bg-white border-t border-default">

                <a href="/#home"
                    class="mobile-nav-link block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Home
                </a>

                <a href="/#about"
                    class="mobile-nav-link block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    About
                </a>

                <a href="/#services"
                    class="mobile-nav-link block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Services
                </a>

                {{-- <a href="/#testimonials" class="mobile-nav-link …">Testimonials</a> --}}

                <a href="/#blog"
                    class="mobile-nav-link block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Blog
                </a>

                <a href="/#contact"
                    class="mobile-nav-link block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Contact
                </a>

                <a href="/#contact"
                    class="mobile-nav-link skip-active block flex text-white px-4 py-2.5 rounded-md text-base font-medium transition-colors duration-200 mt-4 items-center justify-center
                        bg-gradient-to-r from-primary to-secondary shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Schedule a Consultation
                </a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grab all nav-link anchors
        const navLinks = document.querySelectorAll('.nav-link');

        // Build a map of { link, sectionElement } for each fragment link
        const linkSections = Array.from(navLinks)
            .map(link => {
                const id = link.hash.substring(1);
                const section = document.getElementById(id);
                return section ? {
                    link,
                    section
                } : null;
            })
            .filter(x => x);

        // Utility: reset all links to “inactive”
        function resetLinks() {
            navLinks.forEach(link => {
                link.classList.remove('active', 'text-primary');
                link.classList.add('text-dark', 'hover:text-accent');
            });
        }

        // Utility: activate one link by its hash
        function activateLinkByHash(hash) {
            navLinks.forEach(link => {
                if (link.hash === hash) {
                    link.classList.add('active', 'text-primary');
                    link.classList.remove('text-dark');
                }
            });
        }

        // Set active based on path *or* hash
        function setActiveByHashOrPath() {
            resetLinks();

            const path = window.location.pathname;
            // If we're on any /blog/... route, force the blog link active
            if (path.startsWith('/blog')) {
                activateLinkByHash('#blog');
                return;
            }

            // Otherwise highlight based on the fragment or default to home
            const currentHash = window.location.hash || '#home';
            activateLinkByHash(currentHash);
        }

        // Highlight based on scroll position (only on the SPA homepage)
        function setActiveByScroll() {
            let currentSectionId = null;

            // Find the last section scrolled past
            linkSections.forEach(({
                section
            }) => {
                const top = section.offsetTop - 100;
                if (window.scrollY >= top) {
                    currentSectionId = section.id;
                }
            });

            if (currentSectionId) {
                resetLinks();
                activateLinkByHash('#' + currentSectionId);
            }
        }

        // Initialize
        setActiveByHashOrPath();

        // Re-run on hash changes (e.g. clicking a nav link)
        window.addEventListener('hashchange', setActiveByHashOrPath);

        // Re-run on scroll—but skip when on /blog/* detail pages
        window.addEventListener('scroll', () => {
            if (!window.location.pathname.startsWith('/blog')) {
                setActiveByScroll();
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // All mobile links (including CTA)
        const mobileLinks = document.querySelectorAll('#mobile-menu .mobile-nav-link');

        // Reset *only* those that are NOT marked skip-active
        function resetMobileLinks() {
            mobileLinks.forEach(link => {
                if (link.classList.contains('skip-active')) return;
                link.classList.remove('text-primary', 'bg-light');
                link.classList.add('text-dark', 'hover:text-primary', 'hover:bg-light');
            });
        }

        // Activate *only* those that are NOT marked skip-active
        function activateMobileByHash(hash) {
            mobileLinks.forEach(link => {
                if (link.classList.contains('skip-active')) return;
                if (link.hash === hash) {
                    link.classList.add('text-primary', 'bg-light');
                    link.classList.remove('text-dark');
                }
            });
        }

        function updateMobileActive() {
            resetMobileLinks();

            const path = window.location.pathname;
            if (path.startsWith('/blog')) {
                return activateMobileByHash('#blog');
            }

            const currentHash = window.location.hash || '#home';
            activateMobileByHash(currentHash);
        }

        // Close menu & navigate when any mobile link is clicked
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                // if it's a fragment link
                if (link.hash) {
                    window.location.href = '/' + link.hash;
                }
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });

        // Initialize & hook into hashchange
        updateMobileActive();
        window.addEventListener('hashchange', updateMobileActive);
    });
</script>
