@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with background accent -->
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2 font-heading">Activity Log</h1>
                        <p class="font-body text-white/80 font-tertiary">Keep track of all your activities</p>
                    </div>
                    <div class="flex space-x-2 font-body">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                {{-- Filters --}}
                <div class="mb-6">
                    <h3 class="font-heading text-lg font-medium text-primary mb-4">Filter Activities</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 font-body">
                        <div>
                            <label for="type" class="block text-sm font-medium text-dark mb-1">Activity Type</label>
                            <select name="type" id="type"
                                class="w-full border-border rounded-full shadow-sm focus:ring-accent focus:border-accent text-sm px-4 py-3">
                                <option value="">All Types</option>
                                <option value="post" {{ request('type') == 'post' ? 'selected' : '' }}>Posts</option>
                                <option value="category" {{ request('type') == 'category' ? 'selected' : '' }}>Categories
                                </option>
                                <option value="tag" {{ request('type') == 'tag' ? 'selected' : '' }}>Tags</option>
                                <option value="auth" {{ request('type') == 'auth' ? 'selected' : '' }}>Authentication
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-dark mb-1">User</label>
                            <select name="user_id" id="user_id"
                                class="w-full border-border rounded-full shadow-sm focus:ring-accent focus:border-accent text-sm px-4 py-3">
                                <option value="">All Users</option>
                                @foreach (\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}"
                                        {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-dark mb-1">Date From</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                class="w-full border-border rounded-full shadow-sm focus:ring-accent focus:border-accent text-sm px-4 py-3">
                        </div>
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-dark mb-1">Date To</label>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                class="w-full border-border rounded-full shadow-sm focus:ring-accent focus:border-accent text-sm px-4 py-3">
                        </div>
                    </div>

                    <!-- Clear filters button - initially hidden, shown via JS when filters are active -->
                    <div class="mt-4">
                        <button type="button" id="clear-filters"
                            class="px-4 py-2 bg-light text-dark rounded-full hover:bg-gray-200 text-sm font-medium hidden">
                            Clear All Filters
                        </button>
                    </div>
                </div>

                <div id="activities-container">
                    @include('admin.activities.partials.activities-list', ['activities' => $activities])
                </div>
            </div>
        </div>
    </x.admin-admin-wrapper>

    <script>
        (() => {
            document.addEventListener('DOMContentLoaded', function() {
                const typeSelect = document.getElementById('type');
                const userSelect = document.getElementById('user_id');
                const dateFrom = document.getElementById('date_from');
                const dateTo = document.getElementById('date_to');
                const clearFiltersBtn = document.getElementById('clear-filters');
                const container = document.getElementById('activities-container');

                // Check if any filters are active and show/hide clear button
                function updateClearButtonVisibility() {
                    const hasActiveFilters =
                        typeSelect.value ||
                        userSelect.value ||
                        dateFrom.value ||
                        dateTo.value;

                    if (hasActiveFilters) {
                        clearFiltersBtn.classList.remove('hidden');
                    } else {
                        clearFiltersBtn.classList.add('hidden');
                    }
                }

                // Build the query string from current filter values
                function buildQuery() {
                    const params = new URLSearchParams();
                    if (typeSelect.value) params.set('type', typeSelect.value);
                    if (userSelect.value) params.set('user_id', userSelect.value);
                    if (dateFrom.value) params.set('date_from', dateFrom.value);
                    if (dateTo.value) params.set('date_to', dateTo.value);
                    return params.toString();
                }

                // Fetch HTML and swap in, update URL
                function loadUrl(url, push = true) {
                    container.style.opacity = 0.5;
                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.ok ? res.text() : Promise.reject(res.statusText))
                        .then(html => {
                            container.innerHTML = html;
                            container.style.opacity = 1;
                            if (push) window.history.pushState({}, '', url);
                            updateClearButtonVisibility();
                        })
                        .catch(err => {
                            console.error('Activity filter error:', err);
                            container.style.opacity = 1;
                        });
                }

                // Handler when any filter changes
                function applyFilters() {
                    const base = window.location.pathname;
                    const q = buildQuery();
                    const url = q ? `${base}?${q}` : base;
                    loadUrl(url);
                }

                // Clear all filters
                function clearAllFilters() {
                    typeSelect.value = '';
                    userSelect.value = '';
                    dateFrom.value = '';
                    dateTo.value = '';
                    loadUrl(window.location.pathname);
                    clearFiltersBtn.classList.add('hidden');
                }

                // Listen to filter inputs
                [typeSelect, userSelect, dateFrom, dateTo].forEach(el => {
                    el.addEventListener('change', function() {
                        applyFilters();
                        updateClearButtonVisibility();
                    });
                });

                // Clear filters button
                clearFiltersBtn.addEventListener('click', clearAllFilters);

                // Intercept pagination link clicks
                container.addEventListener('click', function(e) {
                    const link = e.target.closest('.pagination a');
                    if (!link) return;
                    e.preventDefault();
                    loadUrl(link.href);
                });

                // Back/forward support
                window.addEventListener('popstate', function() {
                    // repopulate form values from URL
                    const params = new URLSearchParams(window.location.search);
                    typeSelect.value = params.get('type') || '';
                    userSelect.value = params.get('user_id') || '';
                    dateFrom.value = params.get('date_from') || '';
                    dateTo.value = params.get('date_to') || '';
                    // reload container without pushing new history
                    loadUrl(window.location.href, false);
                    updateClearButtonVisibility();
                });

                // Apply initial filters if there are URL parameters
                const params = new URLSearchParams(window.location.search);
                if (params.toString()) {
                    loadUrl(window.location.href, false);
                }

                // Check if clear button should be visible on page load
                updateClearButtonVisibility();
            });
        })();
    </script>
@endsection
