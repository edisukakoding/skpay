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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id');
            $table->unsignedBigInteger('meter_id');
            $table->float('fixed_fee')->default(0);
            $table->float('previous_reading')->default(0);
            $table->float('current_reading')->default(0);
            $table->float('consumption');
            $table->float('subtotal')->default(0);
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('meter_id')->references('id')->on('meters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
