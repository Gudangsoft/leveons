<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Insight;
use App\Models\User;
use App\Models\Category;

class InsightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing insights
        Insight::truncate();
        
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@cms.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Create business category if not exists
        $businessCategory = Category::firstOrCreate([
            'slug' => 'business'
        ], [
            'name' => 'Business',
            'description' => 'Business related insights',
            'is_active' => true,
            'sort_order' => 1
        ]);
        
        echo "🚀 Creating insight articles...\n";
        
        $insights = [
            [
                'title' => 'RSPO & ISPO: Standar Sertifikasi untuk Industri Sawit Berkelanjutan',
                'slug' => 'rspo-ispo-standar-sertifikasi-industri-sawit-berkelanjutan',
                'excerpt' => 'Minyak kelapa sawit adalah salah satu komoditas paling penting di dunia. Hampir semua orang menggunakannya setiap hari...',
                'content' => '<p>Minyak kelapa sawit adalah salah satu komoditas paling penting di dunia. Hampir semua orang menggunakannya setiap hari dalam berbagai produk, mulai dari makanan hingga kosmetik. Namun, industri kelapa sawit juga menghadapi tantangan besar terkait keberlanjutan lingkungan dan sosial.</p>

<p>Di sinilah peran penting standar sertifikasi seperti RSPO (Roundtable on Sustainable Palm Oil) dan ISPO (Indonesian Sustainable Palm Oil) menjadi krusial. Kedua standar ini bertujuan untuk memastikan produksi minyak kelapa sawit yang berkelanjutan dan bertanggung jawab.</p>

<h2>Apa itu RSPO?</h2>
<p>RSPO adalah organisasi global yang didirikan pada tahun 2004 untuk mempromosikan pertumbuhan dan penggunaan produk kelapa sawit berkelanjutan melalui standar kredibel dan keterlibatan stakeholder.</p>

<h2>Apa itu ISPO?</h2>
<p>ISPO adalah sistem sertifikasi kelapa sawit berkelanjutan Indonesia yang ditetapkan oleh pemerintah Indonesia untuk memastikan perkebunan kelapa sawit di Indonesia memenuhi standar keberlanjutan nasional.</p>

<p>Implementasi kedua standar ini sangat penting untuk masa depan industri kelapa sawit yang berkelanjutan dan bertanggung jawab.</p>',
                'meta_title' => 'RSPO & ISPO: Standar Sertifikasi untuk Industri Sawit Berkelanjutan',
                'meta_description' => 'Pelajari tentang standar sertifikasi RSPO dan ISPO untuk industri kelapa sawit berkelanjutan dan dampaknya terhadap lingkungan.',
                'featured_image' => 'insights/rspo-ispo-palm-oil.jpg',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Apa Itu Sertifikasi ISO? Jenis dan Penerapannya di Perusahaan',
                'slug' => 'apa-itu-sertifikasi-iso-jenis-penerapan-perusahaan',
                'excerpt' => 'Di dunia bisnis modern, kepercayaan dan efisiensi adalah kunci. Perusahaan tidak hanya dituntut menghasilkan produk atau...',
                'content' => '<p>Di dunia bisnis modern, kepercayaan dan efisiensi adalah kunci utama kesuksesan. Perusahaan tidak hanya dituntut menghasilkan produk atau layanan berkualitas, tetapi juga harus membuktikan komitmen mereka terhadap standar internasional yang diakui secara global.</p>

<p>Sertifikasi ISO (International Organization for Standardization) menjadi salah satu cara paling efektif untuk mencapai tujuan tersebut. ISO adalah organisasi internasional yang mengembangkan dan menerbitkan standar internasional untuk berbagai aspek bisnis dan industri.</p>

<h2>Jenis-jenis Sertifikasi ISO</h2>
<h3>ISO 9001 - Sistem Manajemen Mutu</h3>
<p>Standar ini fokus pada kepuasan pelanggan dan peningkatan berkelanjutan dalam sistem manajemen mutu organisasi.</p>

<h3>ISO 14001 - Sistem Manajemen Lingkungan</h3>
<p>Membantu organisasi mengelola tanggung jawab lingkungan mereka secara sistematis yang berkontribusi pada pilar lingkungan keberlanjutan.</p>

<h3>ISO 45001 - Sistem Manajemen Keselamatan dan Kesehatan Kerja</h3>
<p>Memberikan kerangka kerja untuk meningkatkan keselamatan karyawan, mengurangi risiko tempat kerja, dan menciptakan kondisi kerja yang lebih baik dan aman.</p>

<h2>Manfaat Penerapan ISO</h2>
<ul>
<li>Meningkatkan kredibilitas dan reputasi perusahaan</li>
<li>Memperbaiki efisiensi operasional</li>
<li>Meningkatkan kepuasan pelanggan</li>
<li>Membuka akses ke pasar internasional</li>
<li>Mengurangi risiko operasional</li>
</ul>

<p>Implementasi sertifikasi ISO memerlukan komitmen penuh dari manajemen dan seluruh karyawan, namun manfaat jangka panjangnya sangat signifikan untuk pertumbuhan dan keberlanjutan bisnis.</p>',
                'meta_title' => 'Sertifikasi ISO: Pengertian, Jenis, dan Manfaat untuk Perusahaan',
                'meta_description' => 'Pelajari tentang sertifikasi ISO, jenis-jenisnya, dan manfaat penerapannya untuk meningkatkan kualitas dan kredibilitas perusahaan.',
                'featured_image' => 'insights/iso-certification.jpg',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Levner Consulting, Konsultan Bisnis UMKM & Korporasi Terpercaya',
                'slug' => 'levner-consulting-konsultan-bisnis-umkm-korporasi-terpercaya',
                'excerpt' => 'Di tengah persaingan bisnis yang semakin komplek, UMKM sering terkendala memahami regulasi, sementara korporasi...',
                'content' => '<p>Di tengah persaingan bisnis yang semakin kompleks, UMKM sering terkendala dalam memahami regulasi yang kompleks, sementara korporasi besar membutuhkan strategi yang lebih canggih untuk mempertahankan posisi mereka di pasar. Inilah mengapa keberadaan konsultan bisnis profesional menjadi sangat penting.</p>

<p>Levner Consulting hadir sebagai mitra terpercaya yang memahami kebutuhan unik setiap klien, mulai dari UMKM yang baru berkembang hingga korporasi multinasional yang sudah mapan.</p>

<h2>Mengapa Memilih Levner Consulting?</h2>

<h3>1. Pengalaman dan Keahlian Terbukti</h3>
<p>Tim konsultan kami terdiri dari profesional berpengalaman dengan latar belakang yang beragam dalam berbagai industri. Kami memahami tantangan spesifik yang dihadapi setiap sektor bisnis.</p>

<h3>2. Pendekatan yang Disesuaikan</h3>
<p>Tidak ada solusi satu-untuk-semua dalam bisnis. Kami mengembangkan strategi yang disesuaikan dengan kebutuhan, budaya, dan tujuan spesifik setiap klien.</p>

<h3>3. Fokus pada Hasil Terukur</h3>
<p>Setiap rekomendasi dan strategi yang kami berikan didasarkan pada data dan analisis mendalam, dengan target pencapaian yang jelas dan terukur.</p>

<h2>Layanan Kami</h2>

<h3>Untuk UMKM</h3>
<ul>
<li>Pengembangan strategi bisnis dan rencana pertumbuhan</li>
<li>Optimalisasi operasional dan manajemen keuangan</li>
<li>Pendampingan dalam compliance dan regulasi</li>
<li>Pengembangan sistem dan proses bisnis</li>
</ul>

<h3>Untuk Korporasi</h3>
<ul>
<li>Strategic planning dan business transformation</li>
<li>Organizational development dan change management</li>
<li>Market research dan competitive analysis</li>
<li>Risk management dan compliance</li>
</ul>

<h2>Komitmen Kami</h2>
<p>Levner Consulting berkomitmen untuk menjadi partner jangka panjang bagi klien. Kami tidak hanya memberikan solusi sesaat, tetapi juga membangun kapabilitas internal organisasi untuk mencapai kemandirian dan pertumbuhan berkelanjutan.</p>

<p>Hubungi kami hari ini untuk konsultasi awal dan temukan bagaimana Levner Consulting dapat membantu mengakselerasi pertumbuhan bisnis Anda.</p>',
                'meta_title' => 'Levner Consulting - Konsultan Bisnis UMKM & Korporasi Terpercaya',
                'meta_description' => 'Levner Consulting menyediakan layanan konsultasi bisnis profesional untuk UMKM dan korporasi dengan solusi yang disesuaikan dan hasil terukur.',
                'featured_image' => 'insights/levner-consulting.jpg',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Strategi Digital Marketing untuk UMKM di Era Modern',
                'slug' => 'strategi-digital-marketing-umkm-era-modern',
                'excerpt' => 'Era digital telah mengubah landscape bisnis secara fundamental. Bagi UMKM, adaptasi terhadap perubahan ini...',
                'content' => '<p>Era digital telah mengubah landscape bisnis secara fundamental. Bagi UMKM, adaptasi terhadap perubahan ini bukan lagi pilihan, melainkan keharusan untuk bertahan dan berkembang di pasar yang semakin kompetitif.</p>

<p>Digital marketing menawarkan peluang besar bagi UMKM untuk bersaing dengan perusahaan besar dengan biaya yang relatif terjangkau dan targeting yang lebih presisi.</p>

<h2>Mengapa Digital Marketing Penting untuk UMKM?</h2>

<h3>1. Jangkauan yang Lebih Luas</h3>
<p>Dengan digital marketing, UMKM dapat menjangkau pasar yang tidak terbatas secara geografis, bahkan hingga ke tingkat internasional.</p>

<h3>2. Biaya yang Efektif</h3>
<p>Dibandingkan dengan marketing tradisional, digital marketing menawarkan ROI yang lebih tinggi dengan budget yang lebih kecil.</p>

<h3>3. Targeting yang Presisi</h3>
<p>Platform digital memungkinkan UMKM untuk menargetkan audience yang sangat spesifik berdasarkan demografi, perilaku, dan minat.</p>

<h2>Strategi Digital Marketing untuk UMKM</h2>

<h3>1. Membangun Presence Online yang Kuat</h3>
<ul>
<li>Website yang responsive dan user-friendly</li>
<li>Profil media sosial yang konsisten</li>
<li>Listing di Google My Business</li>
</ul>

<h3>2. Content Marketing yang Engaging</h3>
<ul>
<li>Blog posts yang informatif dan relevan</li>
<li>Video content yang menarik</li>
<li>Infografis yang mudah dipahami</li>
</ul>

<h3>3. Social Media Marketing</h3>
<ul>
<li>Pilih platform yang sesuai dengan target audience</li>
<li>Posting secara konsisten dengan konten berkualitas</li>
<li>Engage dengan followers secara aktif</li>
</ul>

<h3>4. Search Engine Optimization (SEO)</h3>
<ul>
<li>Riset keyword yang relevan</li>
<li>Optimasi on-page dan off-page</li>
<li>Local SEO untuk bisnis lokal</li>
</ul>

<h3>5. Email Marketing</h3>
<ul>
<li>Build mailing list yang engaged</li>
<li>Personalisasi pesan sesuai segmen</li>
<li>Automated email sequences</li>
</ul>

<h2>Tips Implementasi</h2>

<h3>1. Mulai dari yang Kecil</h3>
<p>Tidak perlu mengimplementasikan semua strategi sekaligus. Mulai dengan 1-2 channel yang paling relevan dengan bisnis Anda.</p>

<h3>2. Konsistensi adalah Kunci</h3>
<p>Lebih baik posting secara konsisten dengan frekuensi yang realistis daripada sporadis dengan volume tinggi.</p>

<h3>3. Measure dan Analyze</h3>
<p>Gunakan tools analytics untuk mengukur performa dan terus optimasi strategi berdasarkan data.</p>

<h3>4. Stay Updated</h3>
<p>Dunia digital terus berkembang. Ikuti tren dan update algoritma platform digital.</p>

<h2>Kesimpulan</h2>
<p>Digital marketing bukan hanya tentang teknologi, tetapi tentang memahami customer journey di era digital dan memberikan value di setiap touchpoint. UMKM yang dapat beradaptasi dan mengimplementasikan strategi digital marketing yang tepat akan memiliki keunggulan kompetitif yang signifikan.</p>

<p>Ingat, digital marketing adalah marathon, bukan sprint. Konsistensi, kesabaran, dan continuous improvement adalah kunci sukses jangka panjang.</p>',
                'meta_title' => 'Strategi Digital Marketing Efektif untuk UMKM di Era Modern',
                'meta_description' => 'Pelajari strategi digital marketing yang efektif untuk UMKM, mulai dari social media marketing hingga SEO untuk meningkatkan bisnis online.',
                'featured_image' => 'insights/digital-marketing-umkm.jpg',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ]
        ];

        foreach ($insights as $insightData) {
            Insight::create(array_merge($insightData, [
                'user_id' => $admin->id,
                'category_id' => $businessCategory->id,
                'views_count' => rand(100, 1000),
                'sort_order' => 0
            ]));
        }
        
        echo "✅ Insight articles berhasil dibuat!\n";
        echo "📊 Total: " . count($insights) . " insight articles created\n";
        echo "🎉 InsightSeeder completed!\n";
    }
}
