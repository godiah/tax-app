@extends('layouts.app')

@section('title', 'Edit Invoice ' . $invoice->invoice_number)

@section('content')
    <x.admin-admin-wrapper>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-blog-paper-accent py-6 mb-6 border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-white p-3 rounded-full shadow-md mr-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-accent font-tertiary">Edit Invoice</span>
                            <p class="text-xl font-bold text-primary font-heading">{{ $invoice->invoice_number }}</p>
                        </div>
                    </div>
                    <a href="{{ route('invoices.show', $invoice) }}"
                        class="inline-flex items-center px-4 py-2 btn-secondary rounded-lg shadow-sm text-sm font-medium font-body">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Invoice
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
                    <h2 class="font-heading text-lg font-semibold text-gray-800">Invoice Details</h2>
                    <p class="text-sm text-gray-500 font-tertiary">Fields marked with an asterisk (*) are required</p>
                </div>

                <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    @include('admin.invoices._form')

                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-accent hover:bg-opacity-90 text-white text-sm font-medium rounded-md shadow-lg transition-all duration-200 font-body">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x.admin-admin-wrapper>
@endsection
