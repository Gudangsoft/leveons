<?php

namespace Database\Seeders;

use App\Models\Consultant;
use Illuminate\Database\Seeder;

class ConsultantSeeder extends Seeder
{
    public function run(): void
    {
        $consultants = [
            [
                'name' => 'Dedy Sidarta, BKP, CFP, PFM.',
                'slug' => 'dedy-sidarta',
                'title' => 'CEO',
                'company' => "D'Consulting",
                'price_text' => 'Start from Rp 1.5 jt',
                'bio' => "Seorang profesional berpengalaman dengan sertifikasi BKP (Brevet Konsultan Pajak), CFP (Certified Financial Planner), dan PFM (Personal Financial Manager). Sebagai CEO D'Consulting, beliau memimpin tim konsultan dalam memberikan solusi bisnis strategis dan transformasi organisasi.\n\nDengan pengalaman lebih dari 15 tahun di bidang konsultasi bisnis, finance, dan perpajakan, Dedy telah membantu ratusan perusahaan dalam meningkatkan performa dan mencapai tujuan bisnis mereka.",
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
                'is_published' => true,
            ],
            [
                'name' => 'Rio Kristiantoro, SE, BKP.',
                'slug' => 'rio-kristiantoro',
                'title' => 'Manager',
                'company' => "D'Consulting",
                'price_text' => 'Start from Rp 1 jt',
                'bio' => "Lulusan Sarjana Ekonomi dengan sertifikasi Brevet Konsultan Pajak (BKP). Sebagai Manager di D'Consulting, Rio fokus pada konsultasi perpajakan, perencanaan keuangan, dan strategi bisnis untuk UKM dan perusahaan menengah.\n\nRio memiliki keahlian khusus dalam tax planning, compliance, dan business advisory. Beliau dikenal dengan pendekatannya yang praktis dan berorientasi pada hasil untuk membantu klien mengoptimalkan operasional bisnis mereka.",
                'expertise' => 'Tax Planning, Business Advisory, Financial Management, Compliance, Business Strategy',
                'booking_url' => null,
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
                'is_published' => true,
            ],
            [
                'name' => 'Alif Imraan Muhammed',
                'slug' => 'alif-imraan-muhammed',
                'title' => 'Senior Executive Consultant',
                'company' => "D'Consulting",
                'price_text' => 'Start from Rp 500 rb',
                'bio' => "Senior Executive Consultant dengan spesialisasi dalam digital transformation, marketing strategy, dan business process improvement. Alif memiliki track record yang solid dalam membantu startup dan bisnis yang sedang berkembang untuk mencapai pertumbuhan eksponensial.\n\nDengan pendekatan yang inovatif dan data-driven, Alif membantu klien mengidentifikasi peluang pertumbuhan, mengoptimalkan proses bisnis, dan mengimplementasikan strategi marketing yang efektif.",
                'expertise' => 'Digital Transformation, Marketing Strategy, Business Process Improvement, Data Analytics',
                'booking_url' => null,
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
                'is_published' => true,
            ],
            [
                'name' => 'Alviana D. Insani',
                'slug' => 'alviana-d-insani',
                'title' => 'Senior Executive Consultant',
                'company' => "D'Consulting",
                'price_text' => 'Start from Rp 500 rb',
                'bio' => "Senior Executive Consultant dengan expertise dalam organizational development, human capital management, dan change management. Alviana berfokus pada pengembangan people strategy yang mendukung pertumbuhan bisnis jangka panjang.\n\nBeliau memiliki pengalaman luas dalam merancang dan mengimplementasikan program training & development, performance management system, dan organization restructuring untuk berbagai industri.",
                'expertise' => 'Organizational Development, Human Capital Management, Change Management, Training & Development',
                'booking_url' => null,
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
                'is_published' => true,
            ],
        ];

        foreach ($consultants as $consultant) {
            Consultant::create($consultant);
        }
    }
}
