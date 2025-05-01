@extends('layouts.app')

@section('title', 'Register - Tax Insights')

@section('content')
    <div class="flex items-center justify-center bg-light py-6 px-4 sm:px-6 lg:px-8">
        <!-- Registration Card with Pattern Background -->
        <div class="max-w-xl w-full bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Decorative Pattern Header -->
            <div class="relative h-24 bg-gradient-to-r from-accent to-primary">
                <div class="absolute inset-0 opacity-20">
                    <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="register-pattern" x="0" y="0" width="10" height="10"
                                patternUnits="userSpaceOnUse">
                                <circle cx="1" cy="1" r="1" fill="white" opacity="0.3" />
                                <path d="M5 5L7 7M5 7L7 5" stroke="white" stroke-width="0.5" opacity="0.5" />
                            </pattern>
                        </defs>
                        <rect x="0" y="0" width="100%" height="100%" fill="url(#register-pattern)" />
                    </svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-white font-heading text-2xl font-bold">Create your account</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </div>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name Input Group -->
                    <div class="mb-6">
                        <label for="name" class="block text-dark font-medium mb-2 font-body text-sm">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-400">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                autofocus
                                class="font-body block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:border-primary transition-all @error('name') border-red-500 @enderror"
                                placeholder="John Doe">
                        </div>
                        @error('name')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Input Group -->
                    <div class="mb-6">
                        <label for="email" class="block text-dark font-medium mb-2 font-body text-sm">Email
                            Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-400">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="font-body block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:border-primary transition-all @error('email') border-red-500 @enderror"
                                placeholder="your@email.com">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input Group -->
                    <div class="mb-6">
                        <label for="password" class="block text-dark font-medium mb-2 font-body text-sm">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-400">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="font-body block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:border-primary transition-all @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="togglePassword"
                                    class="text-gray-400 hover:text-primary focus:outline-none transition-colors">
                                    <svg id="showPasswordIcon" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <svg id="hidePasswordIcon" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                                        <path
                                            d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                        </path>
                                        <line x1="1" y1="1" x2="23" y2="23"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                        <div class="mt-1 text-xs text-gray-500 font-body">
                            Password must be at least 8 characters and include uppercase, lowercase, and a number
                        </div>
                    </div>

                    <!-- Confirm Password Input Group -->
                    <div class="mb-6">
                        <label for="password_confirmation"
                            class="block text-dark font-medium mb-2 font-body text-sm">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-gray-400">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="font-body block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:border-primary transition-all"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="toggleConfirmPassword"
                                    class="text-gray-400 hover:text-primary focus:outline-none transition-colors">
                                    <svg id="showConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    <svg id="hideConfirmPasswordIcon" xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                                        <path
                                            d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                        </path>
                                        <line x1="1" y1="1" x2="23" y2="23"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Button -->
                    <div class="mb-6">
                        <button type="submit"
                            class="w-full flex justify-center items-center bg-gradient-to-r from-accent to-primary text-white py-3 px-4 rounded-lg font-medium transition-all hover:shadow-lg transform hover:-translate-y-0.5 font-heading">
                            <span>Create Account</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="ml-2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <div class="relative py-2 flex items-center justify-center">
                            <div class="absolute left-0 right-0 border-t border-gray-200"></div>
                            <span class="relative px-3 bg-white text-sm text-gray-500 font-body">Already have an
                                account?</span>
                        </div>
                        <a href="{{ route('login') }}"
                            class="inline-flex mt-1 items-center justify-center text-accent hover:text-primary transition-colors font-body">
                            Sign in here
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="ml-1">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                <polyline points="10 17 15 12 10 7"></polyline>
                                <line x1="15" y1="12" x2="3" y2="12"></line>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom and password toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const showPasswordIcon = document.getElementById('showPasswordIcon');
            const hidePasswordIcon = document.getElementById('hidePasswordIcon');

            if (togglePassword && password && showPasswordIcon && hidePasswordIcon) {
                togglePassword.addEventListener('click', function() {
                    // Check if the password field is of type password
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // Toggle visibility of icons
                    if (type === 'text') {
                        showPasswordIcon.classList.add('hidden');
                        hidePasswordIcon.classList.remove('hidden');
                    } else {
                        showPasswordIcon.classList.remove('hidden');
                        hidePasswordIcon.classList.add('hidden');
                    }
                });
            }

            // Confirm Password toggle functionality
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPassword = document.getElementById('password_confirmation');
            const showConfirmPasswordIcon = document.getElementById('showConfirmPasswordIcon');
            const hideConfirmPasswordIcon = document.getElementById('hideConfirmPasswordIcon');

            if (toggleConfirmPassword && confirmPassword && showConfirmPasswordIcon && hideConfirmPasswordIcon) {
                toggleConfirmPassword.addEventListener('click', function() {
                    // Check if the confirm password field is of type password
                    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPassword.setAttribute('type', type);

                    // Toggle visibility of icons
                    if (type === 'text') {
                        showConfirmPasswordIcon.classList.add('hidden');
                        hideConfirmPasswordIcon.classList.remove('hidden');
                    } else {
                        showConfirmPasswordIcon.classList.remove('hidden');
                        hideConfirmPasswordIcon.classList.add('hidden');
                    }
                });
            }

            // For debugging purposes
            console.log("Password toggle elements:", {
                togglePassword: !!togglePassword,
                password: !!password,
                showPasswordIcon: !!showPasswordIcon,
                hidePasswordIcon: !!hidePasswordIcon,
                toggleConfirmPassword: !!toggleConfirmPassword,
                confirmPassword: !!confirmPassword,
                showConfirmPasswordIcon: !!showConfirmPasswordIcon,
                hideConfirmPasswordIcon: !!hideConfirmPasswordIcon
            });
        });
    </script>
@endsection
