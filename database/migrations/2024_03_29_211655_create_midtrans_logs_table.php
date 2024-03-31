<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('midtrans_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('transaction_time')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status_message')->nullable();
            $table->integer('status_code')->nullable();
            $table->text('signature_key')->nullable();
            $table->dateTime('settlement_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('order_id')->nullable();
            $table->string('merchant_id')->nullable();
            $table->float('gross_amount')->nullable();
            $table->string('fraud_status')->nullable();
            $table->dateTime('expiry_time')->nullable();
            $table->string('currency')->nullable();
            $table->string('biller_code')->nullable();
            $table->string('bill_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans_logs');
    }
};
