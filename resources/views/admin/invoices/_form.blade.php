@php
    $rows = old('items', $invoice->exists
        ? $invoice->items->map(fn ($i) => [
            'description' => $i->description,
            'quantity' => rtrim(rtrim(number_format($i->quantity, 2, '.', ''), '0'), '.'),
            'unit_price' => number_format($i->unit_price, 2, '.', ''),
        ])->all()
        : [['description' => '', 'quantity' => 1, 'unit_price' => '']]
    );
    $inputClass = 'block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm';
@endphp

<div class="space-y-8">
    {{-- Client Details --}}
    <div>
        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">Client Details</h3>
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 font-body">
            <div class="sm:col-span-3">
                <label for="client_name" class="block text-sm font-medium text-gray-700 mb-1">
                    Client Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="client_name" id="client_name"
                    value="{{ old('client_name', $invoice->client_name) }}" required class="{{ $inputClass }}">
                @error('client_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-3">
                <label for="client_email" class="block text-sm font-medium text-gray-700 mb-1">
                    Client Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="client_email" id="client_email"
                    value="{{ old('client_email', $invoice->client_email) }}" required class="{{ $inputClass }}">
                @error('client_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-3">
                <label for="client_phone" class="block text-sm font-medium text-gray-700 mb-1">Client Phone</label>
                <input type="text" name="client_phone" id="client_phone"
                    value="{{ old('client_phone', $invoice->client_phone) }}" class="{{ $inputClass }}">
                @error('client_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-3">
                <label for="client_address" class="block text-sm font-medium text-gray-700 mb-1">Client Address</label>
                <textarea name="client_address" id="client_address" rows="1"
                    class="{{ $inputClass }}">{{ old('client_address', $invoice->client_address) }}</textarea>
                @error('client_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Invoice Details --}}
    <div>
        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">Invoice Details</h3>
        <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6 font-body">
            <div class="sm:col-span-2">
                <label for="issue_date" class="block text-sm font-medium text-gray-700 mb-1">
                    Issue Date <span class="text-red-500">*</span>
                </label>
                <input type="date" name="issue_date" id="issue_date"
                    value="{{ old('issue_date', optional($invoice->issue_date)->toDateString()) }}" required
                    class="{{ $inputClass }}">
                @error('issue_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    value="{{ old('due_date', optional($invoice->due_date)->toDateString()) }}" class="{{ $inputClass }}">
                @error('due_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Currency</label>
                <input type="text" name="currency" id="currency"
                    value="{{ old('currency', $invoice->currency ?? 'KES') }}" class="{{ $inputClass }}">
                @error('currency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            @if($invoice->exists)
                <div class="sm:col-span-2">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="{{ $inputClass }}">
                        @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ old('status', $invoice->status) === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            @endif

            <div class="sm:col-span-2">
                <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-1">Tax Rate (%)</label>
                <input type="number" step="0.01" min="0" max="100" name="tax_rate" id="tax_rate"
                    value="{{ old('tax_rate', $invoice->tax_rate) }}" class="{{ $inputClass }} invoice-tax-rate">
                @error('tax_rate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Line Items --}}
    <div>
        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">Items / Quotes</h3>
        @error('items') <p class="text-red-500 text-xs mb-2">{{ $message }}</p> @enderror

        <div class="overflow-x-auto border border-gray-200 rounded-md">
            <table class="w-full text-sm font-body" id="invoice-items-table">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="py-2 px-3">Description</th>
                        <th class="py-2 px-3 w-28">Qty</th>
                        <th class="py-2 px-3 w-36">Unit Price</th>
                        <th class="py-2 px-3 w-36 text-right">Amount</th>
                        <th class="py-2 px-3 w-10"></th>
                    </tr>
                </thead>
                <tbody id="invoice-items-body">
                    @foreach($rows as $row)
                        <tr class="invoice-item-row border-t border-gray-100">
                            <td class="py-2 px-3">
                                <input type="text" name="items[][description]" value="{{ $row['description'] ?? '' }}"
                                    class="item-description w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                            </td>
                            <td class="py-2 px-3">
                                <input type="number" step="0.01" min="0.01" name="items[][quantity]" value="{{ $row['quantity'] ?? 1 }}"
                                    class="item-quantity w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                            </td>
                            <td class="py-2 px-3">
                                <input type="number" step="0.01" min="0" name="items[][unit_price]" value="{{ $row['unit_price'] ?? '' }}"
                                    class="item-unit-price w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                            </td>
                            <td class="item-amount py-2 px-3 text-right font-medium text-gray-700">0.00</td>
                            <td class="py-2 px-3 text-center">
                                <button type="button" class="invoice-remove-item text-red-500 hover:text-red-700" aria-label="Remove item">&times;</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="button" id="invoice-add-item"
            class="mt-3 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-primary hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Item
        </button>

        <template id="invoice-item-row-template">
            <tr class="invoice-item-row border-t border-gray-100">
                <td class="py-2 px-3">
                    <input type="text" name="items[][description]" value=""
                        class="item-description w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                </td>
                <td class="py-2 px-3">
                    <input type="number" step="0.01" min="0.01" name="items[][quantity]" value="1"
                        class="item-quantity w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                </td>
                <td class="py-2 px-3">
                    <input type="number" step="0.01" min="0" name="items[][unit_price]" value=""
                        class="item-unit-price w-full px-2 py-1.5 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm" required>
                </td>
                <td class="item-amount py-2 px-3 text-right font-medium text-gray-700">0.00</td>
                <td class="py-2 px-3 text-center">
                    <button type="button" class="invoice-remove-item text-red-500 hover:text-red-700" aria-label="Remove item">&times;</button>
                </td>
            </tr>
        </template>

        {{-- Live totals preview (server recalculates authoritatively on save) --}}
        <div class="flex justify-end mt-4">
            <div class="w-full sm:w-64 text-sm font-body">
                <div class="flex justify-between py-1 text-gray-600">
                    <span>Subtotal</span>
                    <span id="invoice-subtotal-display">0.00</span>
                </div>
                <div class="flex justify-between py-1 text-gray-600">
                    <span>Tax</span>
                    <span id="invoice-tax-display">0.00</span>
                </div>
                <div class="flex justify-between py-2 border-t border-gray-200 font-bold text-primary">
                    <span>Total</span>
                    <span id="invoice-total-display">0.00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Notes --}}
    <div>
        <h3 class="text-lg font-medium text-primary border-b border-gray-200 pb-2 mb-4 font-heading">Notes / Payment Instructions</h3>
        <textarea name="notes" id="notes" rows="3"
            class="{{ $inputClass }}" placeholder="e.g. bank account details, payment terms...">{{ old('notes', $invoice->notes) }}</textarea>
        @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>
