<header>
    <nav class="bg-white shadow-md fixed top-0 z-30 w-full">
        <div class="mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex justify-between items-center py-3">
                <!-- Logo Section -->
                <div class="flex-shrink-0">
                    <a href="/dashboard" class="flex items-center">
                        <div class="relative overflow-hidden">
                            <img class="h-10 md:h-12 w-auto transform hover:scale-105 transition-transform duration-300"
                                src="{{ asset('images/logo.jpg') }}" alt="Logo">
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}"
                        class="font-secondary hover:text-primary transition-colors px-3 py-2 rounded-md hover:bg-gray-50 flex items-center
                    {{ request()->routeIs('dashboard') ? 'text-accent' : 'text-dark hover:text-primary' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="font-secondary {{ request()->routeIs('posts.index') ? 'text-accent' : 'text-dark hover:text-primary' }} hover:text-primary transition-colors px-3 py-2 rounded-md hover:bg-gray-50 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Posts
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="font-secondary {{ request()->routeIs('categories.index') ? 'text-accent' : 'text-dark hover:text-primary' }} hover:text-primary transition-colors px-3 py-2 rounded-md hover:bg-gray-50 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categories
                    </a>
                    <a href="{{ route('tags.index') }}"
                        class="font-secondary {{ request()->routeIs('tags.index') ? 'text-accent' : 'text-dark hover:text-primary' }} hover:text-primary transition-colors px-3 py-2 rounded-md hover:bg-gray-50 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Tags
                    </a>
                    <a href="{{ url('/') }}" target="_blank"
                        class="font-secondary {{ request()->is('/') ? 'text-accent' : 'text-dark hover:text-primary' }} hover:text-primary transition-colors px-3 py-2 rounded-md hover:bg-gray-50 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        View Site
                    </a>
                </div>

                <!-- User Menu -->
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
                        {{-- <a href="{{ route('register') }}"
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
                        </a> --}}
                    </div>
                @else
                    <div class="flex items-center ml-4 pl-4 border-l border-gray-200">
                        <!-- User Dropdown with Tailwind -->
                        <div class="relative">
                            <button type="button"
                                class="flex items-center gap-2 font-secondary text-dark hover:text-primary transition-colors duration-200"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <div
                                    class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-heading">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="font-body absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none hidden"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="{{ route('profile') }}"
                                        class="block px-4 py-2 text-sm text-dark hover:bg-gray-100 hover:text-primary"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Profile
                                        </div>
                                    </a>
                                    <div class="border-t border-gray-100"></div>
                                    <form method="POST" action="{{ route('logout') }}" role="none">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-left text-sm text-red-500 hover:bg-gray-100 hover:text-red-700"
                                            role="menuitem" tabindex="-1" id="user-menu-item-1">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Logout
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @endguest

                <!-- Mobile menu toggle -->
                <label for="mobile-menu-toggle" class="md:hidden text-gray-600 hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
            </div>

            <!-- Checkbox for mobile menu -->
            <input type="checkbox" id="mobile-menu-toggle" class="hidden peer">

            <!-- Mobile Navigation Menu -->
            <div class="hidden peer-checked:block md:hidden bg-white border-t border-gray-200 shadow-lg">
                <div class="px-4 py-3 space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="block py-2 px-3 text-dark hover:bg-light rounded-md hover:text-primary font-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="block py-2 px-3 text-dark hover:bg-light rounded-md hover:text-primary font-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Posts
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="block py-2 px-3 text-dark hover:bg-light rounded-md hover:text-primary font-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Categories
                    </a>
                    <a href="{{ route('tags.index') }}"
                        class="block py-2 px-3 text-dark hover:bg-light rounded-md hover:text-primary font-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Tags
                    </a>
                    <a href="{{ url('/') }}" target="_blank"
                        class="block py-2 px-3 text-dark hover:bg-light rounded-md hover:text-primary font-secondary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        View Site
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
