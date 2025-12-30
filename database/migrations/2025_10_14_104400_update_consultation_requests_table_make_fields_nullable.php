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
        Schema::table('consultation_requests', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
            $table->string('company_name')->nullable()->change();
            $table->string('position')->nullable()->change();
            $table->string('estimated_implementation_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultation_requests', function (Blueprint $table) {
            $table->string('phone')->nullable(false)->change();
            $table->string('company_name')->nullable(false)->change();
            $table->string('position')->nullable(false)->change();
            $table->string('estimated_implementation_time')->nullable(false)->change();
        });
    }
};
