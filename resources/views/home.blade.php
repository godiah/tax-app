<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Taxgen Consultants LLP</title>

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navigation -->
    <x-navbar />

    <!-- Hero Section -->
    <x-hero-section />

    <!-- About Section -->
    <x-about-section />

    <!-- Services Offered -->
    <x-services-section />

    <!-- Testimonials Section -->
    <x-testimonials-section />

    <!-- Contact Section -->
    <x-contact-section />

    <!-- Footer -->
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
