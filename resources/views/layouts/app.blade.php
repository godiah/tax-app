<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Taxgen Consultants LLC')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-light min-h-screen flex flex-col">
    @include('partials.flash-messages')

    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo Section -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <div class="relative overflow-hidden">
                            <img class="h-10 md:h-12 w-auto transform hover:scale-105 transition-transform duration-300"
                                src="{{ asset('images/logo.jpg') }}" alt="Logo">
                        </div>
                    </a>
                </div>
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-6">
                    @guest
                        <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-gray-200">
                            <a href="{{ route('login') }}"
                                class="font-heading text-primary hover:text-accent transition-colors duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="mr-1">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="bg-gradient-to-r from-primary to-primary-hover text-white py-2 px-4 rounded-md font-heading shadow-sm transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 transform flex items-center">
                                Register
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="ml-1">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="flex items-center space-x-4 ml-4 pl-4 border-l border-gray-200">
                            <div class="relative group">
                                <button
                                    class="flex items-center gap-2 font-secondary text-dark hover:text-primary transition-colors duration-200">
                                    <div
                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-heading">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-dark hover:bg-light hover:text-primary">Profile</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-dark hover:bg-light hover:text-primary">Settings</a>
                                    <div class="border-t border-gray-100"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-dark hover:bg-light hover:text-primary">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                </nav>
            </div>
        </div>
    </header>


    <main class="flex-grow container mx-auto px-4 py-8">
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
</body>

</html>
