<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@cms.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create Sample Categories
        $categories = [
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Artikel tentang teknologi terbaru dan inovasi',
                'color' => '#007bff',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Bisnis',
                'slug' => 'bisnis',
                'description' => 'Tips dan strategi bisnis modern',
                'color' => '#28a745',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Gaya hidup, kesehatan, dan kebahagiaan',
                'color' => '#ffc107',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Edukasi',
                'slug' => 'edukasi',
                'description' => 'Pembelajaran dan pengembangan diri',
                'color' => '#17a2b8',
                'is_active' => true,
                'sort_order' => 4,
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Get created categories
        $techCategory = Category::where('slug', 'teknologi')->first();
        $businessCategory = Category::where('slug', 'bisnis')->first();
        $lifestyleCategory = Category::where('slug', 'lifestyle')->first();
        $eduCategory = Category::where('slug', 'edukasi')->first();

        // Create Sample Articles
        $articles = [
            [
                'title' => 'Perkembangan AI di Indonesia 2025',
                'slug' => 'perkembangan-ai-indonesia-2025',
                'excerpt' => 'Artificial Intelligence semakin berkembang pesat di Indonesia dengan berbagai inovasi terbaru.',
                'content' => '<p>Artificial Intelligence (AI) telah menjadi salah satu teknologi yang paling berkembang pesat di Indonesia pada tahun 2025. Berbagai perusahaan mulai mengadopsi teknologi AI untuk meningkatkan efisiensi dan produktivitas.</p><p>Perkembangan ini didukung oleh investasi besar-besaran dari pemerintah dan sektor swasta dalam bidang teknologi digital. Beberapa startup Indonesia juga mulai mengembangkan solusi AI yang inovatif.</p><p>Dengan potensi yang besar ini, Indonesia diproyeksikan menjadi salah satu pusat pengembangan AI di Asia Tenggara dalam beberapa tahun ke depan.</p>',
                'status' => 'published',
                'is_featured' => true,
                'category_id' => $techCategory->id,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Tips Memulai Bisnis Online untuk Pemula',
                'slug' => 'tips-memulai-bisnis-online-pemula',
                'excerpt' => 'Panduan lengkap untuk memulai bisnis online dengan modal minimal dan strategi yang tepat.',
                'content' => '<p>Memulai bisnis online tidak sesulit yang dibayangkan. Dengan strategi yang tepat dan modal yang minimal, siapa saja bisa memulai bisnis online yang sukses.</p><p>Langkah pertama adalah menentukan produk atau jasa yang akan dijual. Pilih sesuatu yang Anda pahami dan minati. Kemudian, lakukan riset pasar untuk memahami kebutuhan target audience.</p><p>Platform media sosial seperti Instagram, Facebook, dan TikTok bisa menjadi sarana promosi yang efektif dan gratis untuk bisnis Anda.</p>',
                'status' => 'published',
                'is_featured' => true,
                'category_id' => $businessCategory->id,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Gaya Hidup Sehat di Era Digital',
                'slug' => 'gaya-hidup-sehat-era-digital',
                'excerpt' => 'Bagaimana menjaga kesehatan fisik dan mental di tengah perkembangan teknologi digital.',
                'content' => '<p>Era digital membawa banyak kemudahan, namun juga tantangan baru untuk kesehatan kita. Screen time yang berlebihan, kurang gerak, dan stress digital menjadi masalah umum.</p><p>Penting untuk menjaga keseimbangan antara dunia digital dan kehidupan nyata. Luangkan waktu untuk olahraga, berinteraksi langsung dengan orang lain, dan melakukan aktivitas offline.</p><p>Atur jadwal penggunaan gadget, lakukan digital detox secara berkala, dan prioritaskan kualitas tidur yang baik.</p>',
                'status' => 'published',
                'is_featured' => false,
                'category_id' => $lifestyleCategory->id,
                'user_id' => $admin->id,
                'published_at' => now()->subHours(12),
            ],
            [
                'title' => 'Pentingnya Pembelajaran Berkelanjutan di Era Modern',
                'slug' => 'pentingnya-pembelajaran-berkelanjutan',
                'excerpt' => 'Mengapa continuous learning menjadi kunci sukses di dunia kerja yang terus berubah.',
                'content' => '<p>Dunia berkembang dengan cepat, teknologi baru bermunculan, dan skill yang dibutuhkan pasar kerja terus berubah. Di era ini, pembelajaran berkelanjutan bukan lagi pilihan, tetapi kebutuhan.</p><p>Continuous learning membantu kita tetap relevan dan kompetitif. Platform online seperti Coursera, Udemy, dan YouTube menyediakan akses mudah ke berbagai materi pembelajaran.</p><p>Kembangkan growth mindset, jadilah curious, dan jangan takut untuk keluar dari zona nyaman. Investasi terbaik adalah investasi pada diri sendiri.</p>',
                'status' => 'published',
                'is_featured' => false,
                'category_id' => $eduCategory->id,
                'user_id' => $admin->id,
                'published_at' => now()->subHours(6),
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }

        // Create Sample Pages
        $pages = [
            [
                'title' => 'Tentang Kami',
                'slug' => 'tentang-kami',
                'content' => '<p>Selamat datang di website CMS kami. Kami adalah platform digital yang menyediakan informasi terkini, artikel berkualitas, dan konten edukatif untuk membantu Anda berkembang.</p><p>Visi kami adalah menjadi sumber informasi terpercaya yang menginspirasi dan memberdayakan masyarakat Indonesia melalui konten-konten berkualitas tinggi.</p><p>Tim kami terdiri dari para profesional berpengalaman di bidang teknologi, bisnis, dan konten digital yang berkomitmen untuk memberikan yang terbaik.</p>',
                'status' => 'published',
                'is_featured' => true,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => '<p>Kami menghormati privasi pengunjung website kami. Halaman ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p><h3>Informasi yang Dikumpulkan</h3><p>Kami dapat mengumpulkan informasi berikut: nama, alamat email, dan data penggunaan website.</p><h3>Penggunaan Informasi</h3><p>Informasi yang dikumpulkan digunakan untuk meningkatkan layanan kami dan memberikan konten yang relevan.</p><h3>Keamanan Data</h3><p>Kami menggunakan berbagai langkah keamanan untuk melindungi informasi pribadi Anda.</p>',
                'status' => 'published',
                'is_featured' => false,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Kontak',
                'slug' => 'kontak',
                'content' => '<p>Hubungi kami jika Anda memiliki pertanyaan, saran, atau ingin bekerja sama.</p><h3>Informasi Kontak</h3><ul><li>Email: info@cms-website.com</li><li>WhatsApp: +62 812-3456-7890</li><li>Alamat: Jakarta, Indonesia</li></ul><h3>Jam Operasional</h3><p>Senin - Jumat: 09.00 - 17.00 WIB<br>Sabtu - Minggu: Libur</p><p>Tim kami akan merespons pesan Anda dalam waktu 1x24 jam pada hari kerja.</p>',
                'status' => 'published',
                'is_featured' => false,
                'user_id' => $admin->id,
                'published_at' => now()->subDays(3),
            ]
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }

        echo "✅ Sample data berhasil dibuat!\n";
        echo "👤 Admin Login:\n";
        echo "   Email: admin@cms.com\n";
        echo "   Password: password\n";
        echo "📄 Data yang dibuat:\n";
        echo "   - 4 Kategori\n";
        echo "   - 4 Artikel\n";
        echo "   - 3 Halaman\n";
    }
}
