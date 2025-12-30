<?php

namespace Database\Seeders;

use App\Models\CtaSection;
use Illuminate\Database\Seeder;

class ConsultationCtaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing home CTA
        CtaSection::where('id', 1)->update([
            'page' => 'home',
        ]);

        // Create consultation CTA
        CtaSection::create([
            'page' => 'consultation',
            'title' => 'Siap Memulai Transformasi Bisnis Anda?',
            'description' => 'Hubungi kami untuk konsultasi gratis dan diskusikan kebutuhan bisnis Anda dengan tim expert kami',
            'button_text' => 'Mulai Konsultasi',
            'button_link' => '/menu/request-consultation',
            'show_consultation_button' => true,
            'show_whatsapp_button' => true,
            'background_color' => '#1e5a96',
            'is_active' => true,
            'order' => 1,
        ]);
    }
}
