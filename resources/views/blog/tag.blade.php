@extends('layouts.spa')

@section('title', $tag->name)

@section('content')
    <div class="mx-auto py-8 font-body px-4 sm:px-6 max-w-5xl pt-24 min-h-[70vh]">
        <div class="mt-8">
            <h1 class="text-2xl font-heading mb-6 flex items-center text-primary">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </span>
                Posts tagged "<span class="text-accent font-medium">{{ $tag->name }}</span>"
            </h1>

            @if ($posts->isEmpty())
                <div class="bg-light rounded-lg p-8 text-center shadow-sm border border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-xl font-heading mb-2 text-primary">No posts found with this tag yet</h2>
                    <p class="text-gray-600 mb-6">We're working on creating content for this topic. Check back soon!</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4 items-center">
                        <a href="/#blog" class="inline-flex items-center text-accent hover:text-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to all posts
                        </a>
                        <a href="/#contact"
                            class="inline-flex items-center px-4 py-2 bg-accent text-white rounded-md hover:bg-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            Get in touch
                        </a>
                    </div>
                </div>
            @else
                <ul class="space-y-8">
                    @foreach ($posts as $post)
                        <li class="border-b pb-6">
                            <h2 class="text-xl font-heading text-primary">
                                <a href="{{ route('blog.show', $post->slug) }}" class="hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="text-sm text-border mb-2">
                                {{ $post->published_at->format('M d, Y') }} • {{ $post->category->name }}
                            </div>
                            <p class="text-dark mb-2">{{ Str::limit($post->excerpt, 150) }}</p>
                            <div class="flex flex-wrap gap-2 text-xs">
                                @foreach ($post->tags as $t)
                                    <a href="{{ route('blog.tag', $t->slug) }}"
                                        class="bg-light hover:bg-gray-200 px-2 py-1 rounded-full text-dark transition-colors">
                                        {{ $t->name }}
                                    </a>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
