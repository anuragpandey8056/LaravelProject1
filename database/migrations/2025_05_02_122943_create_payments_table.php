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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // If your tenant uses UUIDs (as the error suggests)
            // Use uuid() or char(36) for the tenant_id column
            $table->uuid('tenant_id')->index();
            
            // For the payment details
            $table->string('razorpay_payment_id');
            $table->string('razorpay_order_id');
            
            // For storing just the numeric amount
            $table->decimal('amount', 10, 2);
            
            $table->string('status');
            $table->timestamps();
            
            // Add foreign key if needed
            // $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};