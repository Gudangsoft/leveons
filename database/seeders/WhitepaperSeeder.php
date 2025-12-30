<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Whitepaper;

class WhitepaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $whitepapers = [
            [
                'title' => 'Digital Transformation Guide 2024',
                'slug' => 'digital-transformation-guide-2024',
                'description' => 'Panduan lengkap transformasi digital untuk perusahaan modern. Termasuk strategi, implementasi, dan best practices yang telah terbukti meningkatkan efisiensi operasional hingga 40%.',
                'image_path' => null,
                'file_path' => null,
                'file_name' => 'digital-transformation-guide-2024.pdf',
                'file_size' => '2048000', // 2MB
                'is_featured' => true,
                'is_active' => true,
                'download_count' => 156,
                'meta_title' => 'Digital Transformation Guide 2024 - Download Gratis',
                'meta_description' => 'Download panduan transformasi digital terlengkap 2024. Strategi dan implementasi yang terbukti meningkatkan efisiensi perusahaan.',
                'meta_keywords' => ['digital transformation', 'panduan', 'teknologi', 'bisnis'],
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(15),
            ],
            [
                'title' => 'Cybersecurity Best Practices',
                'slug' => 'cybersecurity-best-practices',
                'description' => 'Panduan keamanan siber untuk melindungi bisnis Anda dari ancaman modern. Mencakup protokol keamanan, training karyawan, dan sistem monitoring yang efektif.',
                'image_path' => null,
                'file_path' => null,
                'file_name' => 'cybersecurity-best-practices.pdf',
                'file_size' => '1536000', // 1.5MB
                'is_featured' => true,
                'is_active' => true,
                'download_count' => 89,
                'meta_title' => 'Cybersecurity Best Practices - Panduan Keamanan Siber',
                'meta_description' => 'Download panduan keamanan siber terlengkap. Proteksi bisnis dari ancaman cyber dengan strategi yang telah teruji.',
                'meta_keywords' => ['cybersecurity', 'keamanan', 'cyber', 'bisnis'],
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(10),
            ],
            [
                'title' => 'Cloud Migration Strategy',
                'slug' => 'cloud-migration-strategy', 
                'description' => 'Strategi migrasi ke cloud yang aman dan efisien. Panduan step-by-step untuk memindahkan infrastruktur IT ke cloud dengan minimal downtime dan maksimal benefit.',
                'image_path' => null,
                'file_path' => null,
                'file_name' => 'cloud-migration-strategy.pdf',
                'file_size' => '1792000', // 1.75MB
                'is_featured' => false,
                'is_active' => true,
                'download_count' => 67,
                'meta_title' => 'Cloud Migration Strategy - Panduan Migrasi Cloud',
                'meta_description' => 'Panduan lengkap migrasi ke cloud. Strategi aman dan efisien untuk transformasi infrastruktur IT perusahaan.',
                'meta_keywords' => ['cloud migration', 'cloud computing', 'infrastruktur', 'IT'],
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Data Analytics Implementation',
                'slug' => 'data-analytics-implementation',
                'description' => 'Implementasi data analytics untuk business intelligence. Panduan praktis mengimplementasikan sistem analitik data untuk pengambilan keputusan berbasis data.',
                'image_path' => null,
                'file_path' => null,
                'file_name' => 'data-analytics-implementation.pdf',
                'file_size' => '2304000', // 2.25MB
                'is_featured' => false,
                'is_active' => true,
                'download_count' => 43,
                'meta_title' => 'Data Analytics Implementation - Panduan Business Intelligence',
                'meta_description' => 'Panduan implementasi data analytics untuk BI. Transformasi data menjadi insight bisnis yang actionable.',
                'meta_keywords' => ['data analytics', 'business intelligence', 'big data', 'analysis'],
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'IT Infrastructure Modernization',
                'slug' => 'it-infrastructure-modernization',
                'description' => 'Modernisasi infrastruktur IT untuk mendukung pertumbuhan bisnis. Panduan upgrade sistem legacy ke teknologi modern dengan ROI yang terukur.',
                'image_path' => null,
                'file_path' => null,
                'file_name' => 'it-infrastructure-modernization.pdf',
                'file_size' => '1920000', // 1.875MB
                'is_featured' => false,
                'is_active' => true,
                'download_count' => 31,
                'meta_title' => 'IT Infrastructure Modernization - Panduan Upgrade Sistem',
                'meta_description' => 'Panduan modernisasi infrastruktur IT. Upgrade sistem legacy ke teknologi modern dengan ROI optimal.',
                'meta_keywords' => ['infrastructure', 'modernization', 'IT', 'upgrade'],
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(1),
            ],
        ];

        foreach ($whitepapers as $whitepaper) {
            Whitepaper::create($whitepaper);
        }
    }
}
