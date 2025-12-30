<?php

namespace Database\Seeders;

use App\Models\Consultant;
use Illuminate\Database\Seeder;

class UpdateConsultantPackagesSeeder extends Seeder
{
    public function run(): void
    {
        // Update Dedy Sidarta
        Consultant::where('slug', 'dedy-sidarta')->update([
            'expertise' => 'People Development, Wealth Management, Business Development, Merger, Akuisisi, Tax Planning, IPO',
            'booking_url' => 'https://www.dconsulting.id/?fluent-booking=calendar&host=dedy-sidarta',
            'consultation_packages' => [
                [
                    'name' => 'Konsultasi 30 Menit',
                    'duration' => '30 Minutes',
                    'price' => 'Rp1500000',
                    'price_display' => 'Rp 1.5 jt',
                    'description' => 'Book a meeting with me for 30 minutes',
                    'platform' => 'Google Meet',
                ],
                [
                    'name' => 'Konsultasi 60 Menit',
                    'duration' => '60 Minutes',
                    'price' => 'Rp2500000',
                    'price_display' => 'Rp 2.5 jt',
                    'description' => 'Book a meeting with me for 60 minutes',
                    'platform' => 'Google Meet',
                ],
            ],
        ]);

        // Update Rio Kristiantoro
        Consultant::where('slug', 'rio-kristiantoro')->update([
            'expertise' => 'Tax Planning, Business Advisory, Financial Management, Compliance, Business Strategy',
            'consultation_packages' => [
                [
                    'name' => 'Konsultasi 30 Menit',
                    'duration' => '30 Minutes',
                    'price' => 'Rp1000000',
                    'price_display' => 'Rp 1 jt',
                    'description' => 'Book a meeting with me for 30 minutes',
                    'platform' => 'Google Meet',
                ],
                [
                    'name' => 'Konsultasi 60 Menit',
                    'duration' => '60 Minutes',
                    'price' => 'Rp1800000',
                    'price_display' => 'Rp 1.8 jt',
                    'description' => 'Book a meeting with me for 60 minutes',
                    'platform' => 'Google Meet',
                ],
            ],
        ]);

        // Update Alif Imraan
        Consultant::where('slug', 'alif-imraan-muhammed')->update([
            'expertise' => 'Digital Transformation, Marketing Strategy, Business Process Improvement, Data Analytics',
            'consultation_packages' => [
                [
                    'name' => 'Konsultasi 30 Menit',
                    'duration' => '30 Minutes',
                    'price' => 'Rp500000',
                    'price_display' => 'Rp 500 rb',
                    'description' => 'Book a meeting with me for 30 minutes',
                    'platform' => 'Google Meet',
                ],
                [
                    'name' => 'Konsultasi 60 Menit',
                    'duration' => '60 Minutes',
                    'price' => 'Rp900000',
                    'price_display' => 'Rp 900 rb',
                    'description' => 'Book a meeting with me for 60 minutes',
                    'platform' => 'Google Meet',
                ],
            ],
        ]);

        // Update Alviana
        Consultant::where('slug', 'alviana-d-insani')->update([
            'expertise' => 'Organizational Development, Human Capital Management, Change Management, Training & Development',
            'consultation_packages' => [
                [
                    'name' => 'Konsultasi 30 Menit',
                    'duration' => '30 Minutes',
                    'price' => 'Rp500000',
                    'price_display' => 'Rp 500 rb',
                    'description' => 'Book a meeting with me for 30 minutes',
                    'platform' => 'Google Meet',
                ],
                [
                    'name' => 'Konsultasi 60 Menit',
                    'duration' => '60 Minutes',
                    'price' => 'Rp900000',
                    'price_display' => 'Rp 900 rb',
                    'description' => 'Book a meeting with me for 60 minutes',
                    'platform' => 'Google Meet',
                ],
            ],
        ]);
    }
}
