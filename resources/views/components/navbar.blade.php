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
                        <img class="h-16 w-auto" src="{{ asset('images/logo.jpg') }}" alt="Logo">
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
                <a href="#home"
                    class="block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Home
                </a>
                <a href="#about"
                    class="block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    About
                </a>
                <a href="#services"
                    class="block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Services
                </a>
                {{-- <a href="#testimonials"
                    class="block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Testimonials
                </a> --}}
                <a href="#contact"
                    class="block text-dark hover:text-primary hover:bg-light px-3 py-2.5 rounded-md text-base font-medium transition-colors duration-200">
                    Contact
                </a>

                <a href="#demo"
                    class="block flex text-white px-4 py-2.5 rounded-md text-base font-medium transition-colors duration-200 mt-4 items-center justify-center
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
        // Get all nav links
        const navLinks = document.querySelectorAll('.nav-link');
        // Get all sections that correspond to nav links
        const sections = [];
        navLinks.forEach(link => {
            // Get the section ID from the href attribute (removing the # symbol)
            const sectionId = link.getAttribute('href').substring(1);
            const section = document.getElementById(sectionId);
            if (section) {
                sections.push(section);
            }
        });
        // Function to set active link based on hash
        const setActiveByHash = () => {
            const currentHash = window.location.hash || '#home';
            // Remove active class from all links
            navLinks.forEach(link => {
                link.classList.remove('active');
                link.classList.add('text-dark', 'hover:text-accent');
                link.classList.remove('text-primary');
            });
            // Add active class to current link
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentHash) {
                    link.classList.add('active', 'text-primary', 'hover:text-accent');
                    link.classList.remove('text-dark');
                }
            });
        };
        // Function to set active link based on scroll position
        const setActiveByScroll = () => {
            let currentSection = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                // Check if we've scrolled to this section (with a small offset to trigger earlier)
                if (window.scrollY >= (sectionTop - 100)) {
                    currentSection = section.getAttribute('id');
                }
            });
            if (currentSection !== '') {
                // Remove active class from all links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    link.classList.add('text-dark', 'hover:text-accent');
                    link.classList.remove('text-primary');
                    // Add active class to current section's link
                    if (link.getAttribute('href') === `#${currentSection}`) {
                        link.classList.add('active', 'text-primary', 'hover:text-accent');
                        link.classList.remove('text-dark');
                    }
                });
            }
        };
        // Set active link on page load
        setActiveByHash();
        // Set active link when hash changes (when clicking nav links)
        window.addEventListener('hashchange', setActiveByHash);
        // Set active link when scrolling
        window.addEventListener('scroll', setActiveByScroll);
    });
</script>
