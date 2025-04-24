@extends('layouts.app')

@section('title', 'Reset Password - Tax Insights')

@section('content')
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-primary p-4">
            <h2 class="text-white font-heading text-xl font-semibold">Reset Password</h2>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="block text-dark font-medium mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required
                        autofocus
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-dark font-medium mb-2">New Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-dark font-medium mb-2">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="submit"
                        class="bg-primary text-white py-2 px-4 rounded-md font-medium transition-colors hover:bg-primary-hover">Reset
                        Password</button>

                    <a href="{{ route('login') }}" class="text-accent hover:underline">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
