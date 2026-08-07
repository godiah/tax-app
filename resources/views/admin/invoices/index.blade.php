@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
    <x.admin-admin-wrapper>
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="relative rounded-lg mb-8 overflow-hidden bg-blog-paper-accent">
                <div class="absolute inset-0 bg-primary opacity-95 rounded-lg"></div>
                <div class="relative z-10 px-6 py-8 flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="font-heading text-3xl font-bold text-white mb-2">Invoices</h1>
                        <p class="font-body text-white/80 font-tertiary">Raise and manage client invoices</p>
                    </div>
                    <a href="{{ route('invoices.create') }}"
                        class="font-body mt-4 md:mt-0 inline-flex items-center px-5 py-3 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow-lg transition-all duration-200 transform hover:translate-y-[-2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Raise Invoice
                    </a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-primary">
                    <p class="text-sm text-dark/60 font-body">Total Invoices</p>
                    <p class="text-2xl font-bold text-dark font-heading">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-accent">
                    <p class="text-sm text-dark/60 font-body">Outstanding</p>
                    <p class="text-2xl font-bold text-dark font-heading">{{ number_format($stats['outstanding'], 2) }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-secondary">
                    <p class="text-sm text-dark/60 font-body">Paid This Month</p>
                    <p class="text-2xl font-bold text-dark font-heading">{{ number_format($stats['paidThisMonth'], 2) }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 border-b-4 border-gray-300">
                    <p class="text-sm text-dark/60 font-body">Drafts</p>
                    <p class="text-2xl font-bold text-dark font-heading">{{ $stats['draftCount'] }}</p>
                </div>
            </div>

            {{-- Filters --}}
            <form method="GET" action="{{ route('invoices.index') }}" class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col sm:flex-row gap-3 font-body">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search client or invoice #"
                    class="flex-1 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                <select name="status" class="px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                    <option value="">All Statuses</option>
                    @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md text-sm font-medium hover:bg-opacity-90">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('invoices.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">Clear</a>
                @endif
            </form>

            {{-- Table --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm font-body">
                        <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Invoice #</th>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3">Issue Date</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($invoices as $invoice)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-primary">{{ $invoice->invoice_number }}</td>
                                    <td class="px-6 py-4">{{ $invoice->client_name }}</td>
                                    <td class="px-6 py-4">{{ $invoice->issue_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4">{{ $invoice->currency }} {{ number_format($invoice->total, 2) }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badgeColors = [
                                                'draft' => 'bg-gray-100 text-gray-700',
                                                'sent' => 'bg-blue-100 text-blue-700',
                                                'paid' => 'bg-green-100 text-green-700',
                                                'overdue' => 'bg-red-100 text-red-700',
                                                'cancelled' => 'bg-gray-100 text-gray-400 line-through',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badgeColors[$invoice->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                        <a href="{{ route('invoices.show', $invoice) }}" class="text-primary hover:underline">View</a>
                                        <a href="{{ route('invoices.edit', $invoice) }}" class="text-accent hover:underline">Edit</a>
                                        <a href="{{ route('invoices.pdf', $invoice) }}" class="text-gray-600 hover:underline">PDF</a>
                                        <a href="{{ route('invoices.word', $invoice) }}" class="text-gray-600 hover:underline">Word</a>
                                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Delete invoice {{ $invoice->invoice_number }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">No invoices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($invoices->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>
        </div>
    </x.admin-admin-wrapper>
@endsection
