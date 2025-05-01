@extends('layouts.app')

@section('title', 'Forgot Password - Tax Insights')

@section('content')
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-primary p-4">
            <h2 class="text-white font-heading text-xl font-semibold">Reset Password</h2>
        </div>

        <div class="p-6">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <p class="mb-4 text-dark">Forgot your password? No problem. Enter your email address and we'll send you a
                password reset link.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-dark font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                        class="bg-primary text-white py-2 px-4 rounded-md font-medium transition-colors hover:bg-primary-hover">Send
                        Reset Link</button>

                    <a href="{{ route('login') }}" class="text-accent hover:underline">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
