<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone')->nullable();
            $table->text('client_address')->nullable();

            $table->date('issue_date');
            $table->date('due_date')->nullable();
            $table->string('status')->default('draft'); // draft, sent, paid, overdue, cancelled
            $table->string('currency', 8)->default('KES');

            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->text('notes')->nullable();
            $table->timestamp('sent_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
