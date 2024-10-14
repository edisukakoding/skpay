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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('nik')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('phone2')->after('phone')->default(null)->unique()->nullable();
            $table->string('rt')->after('address')->nullable();
            $table->string('group')->after('rt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('nik')->unique()->change();
            $table->string('email')->unique()->change();
            $table->string('address')->nullable(false)->change();
            $table->dropColumn('phone2');
            $table->dropColumn('rt');
            $table->dropColumn('group');
        });
    }
};
