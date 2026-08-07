@extends('layouts.app')

@section('title', 'Invoice ' . $invoice->invoice_number)

@section('content')
    <x.admin-admin-wrapper>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Action bar (not part of the printable letterhead) --}}
            <div class="no-print flex flex-wrap items-center justify-between gap-3 mb-6">
                <div class="flex items-center gap-3">
                    <a href="{{ route('invoices.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Invoices
                    </a>
                    @php
                        $badgeColors = [
                            'draft' => 'bg-gray-100 text-gray-700',
                            'sent' => 'bg-blue-100 text-blue-700',
                            'paid' => 'bg-green-100 text-green-700',
                            'overdue' => 'bg-red-100 text-red-700',
                            'cancelled' => 'bg-gray-100 text-gray-400 line-through',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $badgeColors[$invoice->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
                <div class="flex items-center gap-2 font-body">
                    <a href="{{ route('invoices.edit', $invoice) }}"
                        class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium">
                        Edit
                    </a>
                    <a href="{{ route('invoices.pdf', $invoice) }}"
                        class="inline-flex items-center px-4 py-2 bg-primary hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow">
                        Download PDF
                    </a>
                    <a href="{{ route('invoices.word', $invoice) }}"
                        class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium"
                        title="Download an editable Word document">
                        Download Word
                    </a>
                    <form action="{{ route('invoices.send', $invoice) }}" method="POST"
                        onsubmit="return confirm('Email this invoice to {{ $invoice->client_email }}?');">
                        @csrf
                        <button type="submit" data-loading-text="Sending..."
                            class="js-loading-btn inline-flex items-center px-4 py-2 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                            Send to Client
                        </button>
                    </form>
                </div>
            </div>

            @if($invoice->sent_at)
                <p class="no-print text-xs text-gray-500 mb-4">Last emailed to client on {{ $invoice->sent_at->format('d M Y, H:i') }}.</p>
            @endif

            {{-- Printable letterhead document --}}
            <x-letterhead title="Invoice" :reference="$invoice->invoice_number" :date="$invoice->issue_date->format('d F Y')">
                <div class="mb-6">
                    <div style="font-size: 10px; color: #777; text-transform: uppercase; letter-spacing: 0.5px;">Bill To</div>
                    <div style="font-size: 15px; font-weight: bold; color: #1f3b73; margin-top: 3px;">{{ $invoice->client_name }}</div>
                    @if($invoice->client_address)
                        <div style="margin-top: 2px; white-space: pre-line;">{{ $invoice->client_address }}</div>
                    @endif
                    <div style="margin-top: 2px;">{{ $invoice->client_email }}</div>
                    @if($invoice->client_phone)
                        <div>{{ $invoice->client_phone }}</div>
                    @endif
                    @if($invoice->due_date)
                        <div style="margin-top: 8px; color: #777;">Due: <strong style="color:#333;">{{ $invoice->due_date->format('d F Y') }}</strong></div>
                    @endif
                </div>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #1f3b73; color: #fff; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <th style="padding: 8px 10px; text-align: left;">Description</th>
                            <th style="padding: 8px 10px; text-align: right;">Qty</th>
                            <th style="padding: 8px 10px; text-align: right;">Unit Price</th>
                            <th style="padding: 8px 10px; text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 8px 10px;">{{ $item->description }}</td>
                                <td style="padding: 8px 10px; text-align: right;">{{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}</td>
                                <td style="padding: 8px 10px; text-align: right;">{{ number_format($item->unit_price, 2) }}</td>
                                <td style="padding: 8px 10px; text-align: right;">{{ number_format($item->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="display: flex; justify-content: flex-end; margin-top: 14px;">
                    <div style="width: 260px;">
                        <div style="display: flex; justify-content: space-between; padding: 4px 10px; color: #555;">
                            <span>Subtotal</span>
                            <span>{{ $invoice->currency }} {{ number_format($invoice->subtotal, 2) }}</span>
                        </div>
                        @if($invoice->tax_rate)
                            <div style="display: flex; justify-content: space-between; padding: 4px 10px; color: #555;">
                                <span>Tax ({{ rtrim(rtrim(number_format($invoice->tax_rate, 2), '0'), '.') }}%)</span>
                                <span>{{ $invoice->currency }} {{ number_format($invoice->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        <div style="display: flex; justify-content: space-between; padding: 8px 10px; background-color: #1f3b73; color: #fff; font-weight: bold; margin-top: 4px;">
                            <span>Total</span>
                            <span>{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                @if($invoice->notes)
                    <div style="margin-top: 20px;">
                        <div style="font-size: 10px; color: #777; text-transform: uppercase; letter-spacing: 0.5px;">Notes</div>
                        <div style="margin-top: 4px; white-space: pre-line;">{{ $invoice->notes }}</div>
                    </div>
                @endif
            </x-letterhead>
        </div>
    </x.admin-admin-wrapper>
@endsection
