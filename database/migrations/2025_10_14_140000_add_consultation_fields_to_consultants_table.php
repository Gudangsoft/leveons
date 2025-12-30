<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            $table->text('expertise')->nullable()->after('bio'); // Comma-separated or JSON
            $table->string('booking_url')->nullable()->after('expertise'); // External booking URL
            $table->json('consultation_packages')->nullable()->after('booking_url'); // JSON array of packages
        });
    }

    public function down(): void
    {
        Schema::table('consultants', function (Blueprint $table) {
            $table->dropColumn(['expertise', 'booking_url', 'consultation_packages']);
        });
    }
};
