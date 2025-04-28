@extends('layouts.app')

@section('title', 'My Profile')

<style>
    /* Base Styles */
    body {
        font-family: "Inter", ui-sans-serif, system-ui, sans-serif;
        color: #424242;
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
    }

    .profile-container {
        max-width: 972px;
        margin: 0 auto;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 10px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .profile-header {
        background-color: #1f3b73;
        color: white;
        padding: 1.25rem 1.5rem;
        border-radius: 0.5rem 0.5rem 0 0;
        font-family: "Poppins", sans-serif;
    }

    .profile-body {
        padding: 1.5rem;
        background-color: rgba(226, 88, 34, 0.01);
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23e25822' fill-opacity='0.15' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
    }

    /* Tab Styles */
    .tab-navigation {
        display: flex;
        border-bottom: 1px solid #a3a3a3;
        padding: 0 1.5rem;
        background-color: #f4f4f4;
    }

    .tab-button {
        padding: 1rem 1.25rem;
        cursor: pointer;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        color: #424242;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
    }

    .tab-button.active {
        color: #e25822;
        border-bottom-color: #e25822;
    }

    .tab-button:hover:not(.active) {
        color: #456990;
        border-bottom-color: #456990;
    }

    .tab-content {
        display: none;
        padding: 1.5rem;
    }

    .tab-content.active {
        display: block;
    }

    /* Profile Card Styles */
    .profile-card {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        margin-bottom: 1.5rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #1f3b73;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-family: "Poppins", sans-serif;
        margin-right: 1.5rem;
    }

    .user-details h3 {
        margin: 0;
        font-family: "Poppins", sans-serif;
        color: #1f3b73;
    }

    .user-details p {
        margin: 0.25rem 0 0;
        color: #666;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #1f3b73;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #a3a3a3;
        border-radius: 0.375rem;
        font-family: "Inter", ui-sans-serif, system-ui, sans-serif;
        font-size: 1rem;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: #1f3b73;
        box-shadow: 0 0 0 3px rgba(31, 59, 115, 0.1);
    }

    .form-button {
        background-color: #e25822;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 0.375rem;
        font-family: "Inter", ui-sans-serif, system-ui, sans-serif;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .form-button:hover {
        background-color: #d24812;
    }

    .form-button.secondary {
        background-color: #f4f4f4;
        color: #424242;
        border: 1px solid #a3a3a3;
    }

    .form-button.secondary:hover {
        background-color: #e4e4e4;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .success-message {
        background-color: rgba(46, 125, 50, 0.1);
        border-left: 4px solid #2e7d32;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border-radius: 0 0.25rem 0.25rem 0;
        display: none;
    }

    .error-message {
        background-color: rgba(220, 38, 38, 0.1);
        border-left: 4px solid #dc2626;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border-radius: 0 0.25rem 0.25rem 0;
        display: none;
    }

    .last-login {
        font-size: 0.875rem;
        color: #666;
        margin-top: 0.5rem;
        font-style: italic;
    }
</style>
@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- User Profile Section -->
            <div class="profile-container">
                <div class="profile-header">
                    <h2 style="margin: 0; font-size: 1.25rem;">Your Profile</h2>
                </div>

                <div class="tab-navigation">
                    <div class="tab-button active" onclick="switchTab('profileTab')">Profile</div>
                    <div class="tab-button" onclick="switchTab('passwordTab')">Change Password</div>
                    <div class="tab-button" onclick="switchTab('settingsTab')">Edit Details</div>
                </div>

                <div class="profile-body">
                    <!-- Profile Tab -->
                    <div id="profileTab" class="tab-content active">
                        <div class="profile-card">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <span id="userInitials"></span>
                                </div>
                                <div class="user-details">
                                    <h3 id="displayName">{{ $user->name }}</h3>
                                    <p id="displayEmail">{{ $user->email }}</p>
                                    <p class="last-login">
                                        Last login:
                                        {{ $lastLogin ? $lastLogin->format('F d, Y, h:i A') : 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <h4 class="font-heading text-primary">Account Activity</h4>
                                <div class="flex gap-4 flex-wrap mt-4">
                                    <div class="flex-1 min-w-[120px] bg-light p-4 rounded text-center">
                                        <div class="text-3xl font-heading text-primary">{{ $totalPosts }}</div>
                                        <div class="text-sm text-border">Total Posts</div>
                                    </div>
                                    <div class="flex-1 min-w-[120px] bg-light p-4 rounded text-center">
                                        <div class="text-3xl font-heading text-primary">{{ $published }}</div>
                                        <div class="text-sm text-border">Published</div>
                                    </div>
                                    <div class="flex-1 min-w-[120px] bg-light p-4 rounded text-center">
                                        <div class="text-3xl font-heading text-primary">{{ $drafts }}</div>
                                        <div class="text-sm text-border">Drafts</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-card">
                            <h4 class="font-heading text-primary">Recent Activity</h4>
                            @php use Illuminate\Support\Str; @endphp
                            <ul class="mt-4 space-y-4">
                                @forelse($recentActivities as $act)
                                    <li class="flex items-start border-b border-gray-200 pb-4">
                                        {{-- Icon based on activity type --}}
                                        <div class="bg-light p-2 rounded-full mr-4 z-10">
                                            @if ($act->log_name === 'post')
                                                @if (Str::contains($act->description, 'created'))
                                                    {{-- “+” created icon --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                @else
                                                    {{-- ✎ edit icon --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                                               m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828
                                                               l8.586-8.586z" />
                                                    </svg>
                                                @endif
                                            @elseif($act->log_name === 'category')
                                                {{-- 🏷️ category icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586
                                                             l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0
                                                             l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            @elseif($act->log_name === 'tag')
                                                {{-- 🔖 tag icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                                </svg>
                                            @elseif(Str::contains($act->description, 'logged in'))
                                                {{-- ▶️ login icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14
                                                             m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7
                                                             a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                            @elseif(Str::contains($act->description, 'logged out'))
                                                {{-- ⏹️ logout icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7
                                                             m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7
                                                             a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                            @else
                                                {{-- ℹ️ fallback info icon --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-dark"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01
                                                             M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            {{ $act->description }}
                                            <div class="text-xs text-border mt-1">
                                                {{ $act->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center text-border">No recent activity</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Password Tab -->
                    <div id="passwordTab" class="tab-content">
                        <div class="profile-card">
                            <h4
                                style="font-family: 'Poppins', sans-serif; color: #1f3b73; margin-top: 0; margin-bottom: 1.5rem;">
                                Change Your Password</h4>

                            <form id="passwordForm" action="{{ route('profile.password.update') }}" method="POST"
                                class="space-y-4">
                                @csrf

                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-primary mb-1">
                                        Current Password
                                    </label>
                                    <input type="password" name="current_password" id="current_password" required
                                        class="form-input w-full">
                                    @error('current_password')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-primary mb-1">
                                        New Password
                                    </label>
                                    <input type="password" name="password" id="password" required minlength="8"
                                        class="form-input w-full">
                                    @error('password')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-primary mb-1">
                                        Confirm New Password
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        required class="form-input w-full">
                                </div>

                                <div class="text-sm text-border">
                                    <p>Password requirements:</p>
                                    <ul class="list-disc list-inside space-y-1 mt-2">
                                        <li>At least 8 characters long</li>
                                        <li>Include uppercase, lowercase, number & special character</li>
                                    </ul>
                                </div>

                                <div class="flex justify-end gap-4 mt-6">
                                    <button type="button" onclick="resetPasswordForm()"
                                        class="py-2 px-4 bg-light text-dark border border-default rounded-md hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="py-2 px-6 bg-accent text-white rounded-md hover:bg-accent/90">
                                        Update Password
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <!-- Settings Tab -->
                    <div id="settingsTab" class="tab-content">
                        <div class="profile-card">
                            <h4
                                style="font-family: 'Poppins', sans-serif; color: #1f3b73; margin-top: 0; margin-bottom: 1.5rem;">
                                Edit Profile Details</h4>

                            <form id="profileForm" action="{{ route('profile.update') }}" method="POST"
                                class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="userName" class="form-label">Full Name</label>
                                    <input type="text" name="name" id="userName"
                                        value="{{ old('name', $user->name) }}" required class="form-input w-full">
                                    @error('name')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="userEmail" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="userEmail"
                                        value="{{ old('email', $user->email) }}" required class="form-input w-full">
                                    @error('email')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end gap-4 mt-6">
                                    <button type="button" onclick="resetProfileForm()"
                                        class="py-2 px-4 bg-light text-dark border border-default rounded-md hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="py-2 px-6 bg-accent text-white rounded-md hover:bg-accent/90">
                                        Save Changes
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x.admin-admin-wrapper>


    <script>
        // Generate user initials for avatar
        window.onload = function() {
            const name = document.getElementById('displayName').innerText;
            const initials = name.split(' ').map(word => word[0]).join('');
            document.getElementById('userInitials').innerText = initials;
        }

        // Tab switching functionality
        function switchTab(tabId) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tab => {
                tab.classList.remove('active');
            });

            // Deactivate all tab buttons
            const tabButtons = document.querySelectorAll('.tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            // Show the selected tab content and activate its button
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Password form handling
        function resetPasswordForm() {
            document.getElementById('passwordForm').reset();
        }

        // Profile form handling
        function resetProfileForm() {
            document.getElementById('userName').value = @json($user->name);
            document.getElementById('userEmail').value = @json($user->email);
        }
    </script>
@endsection
