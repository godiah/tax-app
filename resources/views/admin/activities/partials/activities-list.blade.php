@if (count($activities) > 0)
    {{-- Activity Timeline --}}
    <div class="space-y-6 relative">
        {{-- Vertical timeline line --}}
        <div class="absolute left-4 top-0 w-0.5 h-full bg-light"></div>

        @foreach ($activities as $act)
            <div class="flex items-start relative">
                {{-- Icon based on activity type --}}
                <div class="bg-light p-2 rounded-full mr-4 z-10">
                    @if ($act->log_name == 'post')
                        @if (str_contains($act->description, 'created'))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        @endif
                    @elseif($act->log_name == 'category')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    @elseif($act->log_name == 'tag')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                    @elseif(str_contains($act->description, 'logged in'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    @elseif(str_contains($act->description, 'logged out'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-dark" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                </div>

                {{-- Activity content --}}
                <div class="flex-grow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h5 class="font-medium text-dark">
                                @if (str_contains($act->description, 'created'))
                                    Added New {{ ucfirst($act->log_name) }}
                                @elseif(str_contains($act->description, 'updated'))
                                    Updated {{ ucfirst($act->log_name) }}
                                @elseif(str_contains($act->description, 'deleted'))
                                    Deleted {{ ucfirst($act->log_name) }}
                                @else
                                    {{ ucfirst(str_replace(['_', '-'], ' ', $act->description)) }}
                                @endif

                                {{-- Item name in quotes and colored --}}
                                @if (strpos($act->description, '"') !== false)
                                    <span
                                        class="text-accent">"{{ preg_replace('/.*\"(.*)\".*/', '$1', $act->description) }}"</span>
                                @elseif($act->subject)
                                    <span class="text-accent">
                                        "@if ($act->log_name == 'post')
                                            {{ $act->subject->title }}@else{{ $act->subject->name }}
                                            @endif"
                                    </span>
                                @endif
                            </h5>
                            <p class="text-xs text-border mt-1">{{ $act->created_at->format('M d, Y') }} at
                                {{ $act->created_at->format('g:i A') }}</p>
                        </div>

                        {{-- Username to the right --}}
                        @if ($act->causer)
                            <div class="text-sm text-primary font-medium">
                                {{ $act->causer->name }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $activities->links() }}
    </div>
@else
    <div class="py-16 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        @if (request()->has('type') || request()->has('user_id') || request()->has('date_from') || request()->has('date_to'))
            <h3 class="text-lg font-medium text-dark mb-1">No matching activities found</h3>
            <p class="text-gray-500">Try adjusting your filters to see more results</p>
        @else
            <h3 class="text-lg font-medium text-dark mb-1">No activity logs yet</h3>
            <p class="text-gray-500">Activity logs will appear here as users interact with the system</p>
        @endif
    </div>
@endif
