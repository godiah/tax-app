<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'issue_date',
        'due_date',
        'status',
        'currency',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'total',
        'notes',
        'sent_at',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'sent_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Invoice $invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = static::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber(): string
    {
        $year = now()->year;
        $count = static::whereYear('created_at', $year)->count() + 1;

        return sprintf('INV-%d-%04d', $year, $count);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class)->orderBy('sort_order');
    }

    /**
     * Recompute subtotal/tax/total from the current items and tax_rate.
     * Always the authority for totals — client-submitted values are ignored.
     */
    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('amount');
        $taxAmount = $this->tax_rate ? round($subtotal * ($this->tax_rate / 100), 2) : 0;

        $this->subtotal = $subtotal;
        $this->tax_amount = $taxAmount;
        $this->total = $subtotal + $taxAmount;
        $this->save();
    }
}
