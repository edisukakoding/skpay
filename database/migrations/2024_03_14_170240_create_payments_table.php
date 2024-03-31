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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->dateTime('payment_date');
            $table->float('payment_amount');
            $table->string('payment_method');
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->text('remarks')->nullable();
            $table->dateTime('record_date');
            $table->boolean('verification')->default(false);
            $table->unsignedBigInteger('user_verification_id')->nullable();
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_verification_id')->references('id')->on('users');

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
