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
        Schema::create('consultation_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultant_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., "Konsultasi 30 Menit"
            $table->string('duration'); // e.g., "30 menit"
            $table->decimal('price', 15, 2); // e.g., 1500000.00
            $table->string('price_display'); // e.g., "Rp1.500.000"
            $table->text('description')->nullable();
            $table->string('platform')->default('Google Meet'); // e.g., "Google Meet", "Zoom"
            $table->integer('order')->default(0); // For sorting
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false); // Badge "Popular"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_packages');
    }
};
