@extends('layouts.app')

@section('title', 'Login - Taxgen Consultants LLC')

@section('content')
    <div class="flex items-center justify-center bg-light py-6 px-4 sm:px-6 lg:px-8">
        <!-- Login Card -->
        <div class="max-w-lg w-full bg-white rounded-xl shadow-xl overflow-hidden">
            <!-- Decorative Pattern Header -->
            <div class="relative h-24 bg-gradient-to-r from-primary to-primary-hover">
                <div class="absolute inset-0 opacity-20">
                    <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <defs>
                            <pattern id="header-pattern" x="0" y="0" width="10" height="10"
                                patternUnits="userSpaceOnUse">
                                <circle cx="1" cy="1" r="1" fill="white" opacity="0.3" />
                                <path d="M5 5L7 7M5 7L7 5" stroke="white" stroke-width="0.5" opacity="0.5" />
                            </pattern>
                        </defs>
                        <rect x="0" y="0" width="100%" height="100%" fill="url(#header-pattern)" />
                    </svg>
                </div>
                <div class="absolute bottom-0 left-0 right-0 px-6 py-4 flex justify-between items-center">
                    <h2 class="text-white font-heading text-2xl font-bold">Welcome Back</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                </div>
            </div>

            <div class="p-8">
                <!-- Status Message -->
                @if (session('status'))
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mr-2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                                autofocus
                                class="font-body block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg transition-all @error('email') border-red-500 @enderror"
                                placeholder="your@email.com">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input Group -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-dark font-medium font-body text-sm">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-accent hover:text-primary text-sm transition-colors font-body">
                                    Forgot Password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="text-gray-400">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="font-body block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg transition-all @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                            class="mr-2">
                        <label for="remember" class="ml-2 text-dark text-sm font-body">Remember Me</label>
                    </div>

                    <!-- Login Button -->
                    <div class="mb-6">
                        <button type="submit"
                            class="cursor-pointer w-full flex justify-center items-center bg-gradient-to-r from-primary to-primary-hover text-white py-3 px-4 rounded-lg font-medium transition-all hover:shadow-lg transform hover:-translate-y-0.5 font-heading">
                            <span>Sign In</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="ml-2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </div>

                    <!-- Registration Link -->
                    <div class="text-center">
                        <div class="relative py-2 flex items-center justify-center">
                            <div class="absolute left-0 right-0 border-t border-gray-200"></div>
                            <span class="relative px-3 bg-white text-sm text-gray-500 font-body">Don't have an account
                                yet?</span>
                        </div>
                        <a href="{{ route('register') }}"
                            class="inline-flex mt-1 items-center justify-center text-accent hover:text-primary transition-colors font-body">
                            Create an account
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="ml-2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
