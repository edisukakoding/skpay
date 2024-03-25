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
        Schema::create('meters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('rate_id');
            $table->string('meter_type');
            $table->string('meter_number');
            $table->date('installation_date');
            $table->string('brand');
            $table->string('location');
            $table->float('previous_reading')->default(0);
            $table->float('current_reading')->default(0);
            $table->boolean('status')->default(true);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('rate_id')->references('id')->on('rates');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meters');
    }
};
