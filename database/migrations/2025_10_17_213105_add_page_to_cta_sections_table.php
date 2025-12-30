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
        Schema::table('cta_sections', function (Blueprint $table) {
            $table->string('page')->default('home')->after('id'); // home, consultation, etc
            $table->boolean('show_consultation_button')->default(true)->after('button_link');
            $table->boolean('show_whatsapp_button')->default(true)->after('show_consultation_button');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cta_sections', function (Blueprint $table) {
            $table->dropColumn(['page', 'show_consultation_button', 'show_whatsapp_button']);
        });
    }
};
