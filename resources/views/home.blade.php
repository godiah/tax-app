<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles / Scripts -->
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
</body>

</html>
