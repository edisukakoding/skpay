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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('customer_id');
            $table->string('title');
            $table->date('bill_date');
            $table->date('due_date');
            $table->float('other_charges')->default(0);
            $table->float('late')->default(0);
            $table->float('total_amount')->default(0);
            $table->float('discount')->default(0);
            $table->enum('status', [
                'authorize',
                'capture',
                'settlement',
                'deny',
                'pending',
                'cancel',
                'refund',
                'partial_refund',
                'chargeback',
                'partial_chargeback',
                'expire',
                'failure'
            ]);
            $table->text('token')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
