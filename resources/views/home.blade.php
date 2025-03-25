<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <div class="text-center">
        <h1 class="font-body text-primary">Welcome to Laravel</h1>
        <p class="mt-4">This is a Laravel application with Vite.js integration.</p>
    </div>
</body>

</html>
