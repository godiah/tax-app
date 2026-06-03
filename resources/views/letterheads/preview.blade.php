@extends('layouts.app')

@section('title', 'Letterhead Designs — Taxgen Consultants LLP')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-8 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
        <div>
            <h1 class="font-heading text-2xl font-bold text-primary mb-1">Letterhead Designs</h1>
            <p class="font-secondary text-sm text-gray-500">
                Preview any design, download as <span class="font-medium text-accent">PDF</span>
                to send digitally, or as <span class="font-medium text-primary">Word (.docx)</span>
                to type your own message before printing.
            </p>
        </div>
        <a href="{{ route('letterheads.signature') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-primary text-primary
                  text-sm font-secondary font-medium rounded-lg shadow-sm hover:bg-primary hover:text-white
                  transition-colors whitespace-nowrap shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Get Email Signature Image
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach($designs as $id => $design)
        <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden flex flex-col">

            {{-- Scaled iframe thumbnail --}}
            <div class="bg-gray-50 border-b border-gray-100 overflow-hidden relative" style="height: 255px;">
                <iframe
                    src="{{ route('letterheads.show', $id) }}"
                    scrolling="no"
                    style="width: 210mm; height: 297mm; border: none;
                           transform-origin: top left;
                           transform: scale(0.355);
                           position: absolute; top: 0; left: 0;
                           pointer-events: none;">
                </iframe>
            </div>

            {{-- Card info --}}
            <div class="p-4 flex-1 flex flex-col gap-3">
                <div>
                    <span class="inline-block text-xs font-semibold text-white bg-primary rounded px-2 py-0.5 mb-1">
                        Design {{ $id }}
                    </span>
                    <h2 class="font-heading text-base font-semibold text-gray-800">{{ $design['name'] }}</h2>
                    <p class="font-secondary text-xs text-gray-500 mt-0.5">{{ $design['desc'] }}</p>
                </div>

                {{-- Action buttons --}}
                <div class="mt-auto space-y-2">

                    {{-- Preview --}}
                    <a href="{{ route('letterheads.show', $id) }}" target="_blank"
                       class="flex items-center justify-center gap-1.5 w-full text-xs font-secondary font-medium
                              border border-gray-300 text-gray-600 rounded px-3 py-2
                              hover:border-primary hover:text-primary transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                     -1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        Preview in browser
                    </a>

                    <div class="flex gap-2">
                        {{-- PDF --}}
                        <a href="{{ route('letterheads.pdf', $id) }}"
                           class="flex-1 flex items-center justify-center gap-1.5 text-xs font-secondary font-medium
                                  bg-accent text-white rounded px-3 py-2 hover:opacity-90 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414
                                         A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            PDF
                        </a>

                        {{-- Word --}}
                        <a href="{{ route('letterheads.word', $id) }}"
                           class="flex-1 flex items-center justify-center gap-1.5 text-xs font-secondary font-medium
                                  bg-primary text-white rounded px-3 py-2 hover:opacity-90 transition-opacity">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Word (.docx)
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-lg">
        <p class="text-xs text-blue-700 font-secondary leading-relaxed">
            <strong>Word download tip:</strong> Open the .docx file in Microsoft Word or Google Docs.
            The letterhead header and footer are locked &mdash; click inside the body area
            (where it says <em>"Type your message here..."</em>) to start writing your letter.
            The header and footer will appear on every page automatically.
        </p>
    </div>

</div>
@endsection
