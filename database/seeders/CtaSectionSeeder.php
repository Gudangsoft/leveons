<?php

namespace Database\Seeders;

use App\Models\CtaSection;
use Illuminate\Database\Seeder;

class CtaSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CtaSection::create([
            'title' => 'Ready to Transform Your Business?',
            'description' => 'Get in touch with our experts at Leveons to discuss how we can help accelerate your growth and achieve sustainable success.',
            'button_text' => 'Contact Us Today',
            'button_link' => '/menu/about-us',
            'background_color' => '#1e5a96',
            'is_active' => true,
            'order' => 1,
        ]);

        CtaSection::create([
            'title' => 'Butuh Konsultasi Bisnis?',
            'description' => 'Jadwalkan sesi konsultasi dengan expert kami dan dapatkan solusi terbaik untuk tantangan bisnis Anda.',
            'button_text' => 'Book Konsultasi Sekarang',
            'button_link' => '/menu/konsultasi-online',
            'background_color' => '#2c3e50',
            'is_active' => false,
            'order' => 2,
        ]);
    }
}
