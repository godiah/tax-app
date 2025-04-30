<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Taxgen Consultants LLP')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <style>
        /* Custom styles to apply font-body to SweetAlert elements */
        .swal2-title,
        .swal2-content,
        .swal2-html-container {
            font-family: inherit !important;
        }

        /* This makes SweetAlert inherit your site's font-body class */
        .swal2-popup {
            font-family: inherit !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    <!-- Add SimpleMDE CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>

    <!-- Add FilePond for better image uploads -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light min-h-screen flex flex-col">
    @include('partials.flash-messages')

    <x-admin-header />

    <main class="flex-grow container mx-auto px-8 py-8 mt-24">
        @yield('content')
    </main>

    {{-- <footer class="bg-primary text-white py-6">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Tax Insights. All rights reserved.</p>
            </div>
        </div>
    </footer> --}}

    {{-- @yield('scripts') --}}
    <!-- Add this JavaScript to toggle the dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenu = userMenuButton.nextElementSibling;

            // Toggle dropdown on button click
            userMenuButton.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                userMenu.classList.toggle('hidden');
            });

            // Close dropdown when clicking elsewhere
            document.addEventListener('click', function(event) {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenuButton.setAttribute('aria-expanded', 'false');
                    userMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
