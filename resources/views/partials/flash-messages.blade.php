{{-- Flash Messages / Alerts Component --}}
<div class="fixed top-4 right-4 z-50 w-80 space-y-3">
    @php
        // List of all the types you might use
        $alertTypes = ['success', 'error', 'warning', 'info'];
    @endphp

    @foreach ($alertTypes as $type)
        @if (session()->has($type))
            <div x-data="{ show: true }" x-show="show" x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transform ease-in duration-300 transition"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
                class="relative rounded-lg shadow-md border overflow-hidden">

                <div
                    class="flex items-center p-4
                    @if ($type === 'success') bg-white border-l-4 border-l-secondary
                    @elseif($type === 'error')
                        bg-white border-l-4 border-l-red-500
                    @elseif($type === 'warning')
                        bg-white border-l-4 border-l-yellow-500
                    @elseif($type === 'info')
                        bg-white border-l-4 border-l-primary @endif
                ">
                    {{-- Icon --}}
                    <div class="flex-shrink-0 mr-3">
                        @if ($type === 'success')
                            <svg class="w-5 h-5 text-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        @elseif($type === 'error')
                            <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        @elseif($type === 'warning')
                            <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        @elseif($type === 'info')
                            <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow font-body text-dark text-sm">
                        {{ session($type) }}
                    </div>

                    {{-- Close button --}}
                    <div class="ml-3 flex-shrink-0">
                        <button @click="show = false" type="button"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Progress bar --}}
                <div x-data="{ width: '100%' }" x-init="setTimeout(() => { width = '0%' }, 100);
                setTimeout(() => { show = false }, 5000)" class="h-1 bg-gray-100">
                    <div class="h-full transition-all duration-5000 ease-linear 
                        @if ($type === 'success') bg-secondary
                        @elseif($type === 'error')
                            bg-red-500
                        @elseif($type === 'warning')
                            bg-yellow-500
                        @elseif($type === 'info')
                            bg-primary @endif
                    "
                        :style="{ width: width }"></div>
                </div>
            </div>
        @endif
    @endforeach

    {{-- Validation errors --}}
    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transform ease-in duration-300 transition"
            x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
            class="relative rounded-lg shadow-md border overflow-hidden">

            <div class="flex items-start p-4 bg-white border-l-4 border-l-red-500">
                {{-- Icon --}}
                <div class="flex-shrink-0 mr-3 pt-0.5">
                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                {{-- Content --}}
                <div class="flex-grow font-body text-dark text-sm">
                    <ul class="list-disc pl-5 mt-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                {{-- Close button --}}
                <div class="ml-3 flex-shrink-0">
                    <button @click="show = false" type="button"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Progress bar --}}
            <div x-data="{ width: '100%' }" x-init="setTimeout(() => { width = '0%' }, 100);
            setTimeout(() => { show = false }, 7000)" class="h-1 bg-gray-100">
                <div class="h-full transition-all duration-7000 ease-linear bg-red-500" :style="{ width: width }"></div>
            </div>
        </div>
    @endif
</div>
