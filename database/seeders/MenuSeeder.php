<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\User;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        Menu::truncate();
        
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@cms.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }
        
        echo "🚀 Creating menu structure sesuai gambar yang diberikan...\n";
        
        // Structure: Service > Consulting > 8 main areas
        $menuStructure = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'type' => 'page',
                'sort_order' => 1,
                'description' => 'Halaman utama perusahaan consulting',
                'content' => '<h1>Welcome to Our Professional Consulting Services</h1>'
            ],
            [
                'title' => 'Service',
                'slug' => 'service',
                'type' => 'dropdown',
                'sort_order' => 2,
                'description' => 'Layanan konsultasi bisnis komprehensif',
                'content' => '<h1>Our Services</h1>',
                'children' => [
                    [
                        'title' => 'Consulting',
                        'slug' => 'consulting',
                        'type' => 'dropdown',
                        'sort_order' => 1,
                        'description' => 'Strategic business consulting services',
                        'content' => '<h1>CONSULTING</h1>',
                        'children' => [
                            // 1. Marketing Strategy & Planning
                            [
                                'title' => 'Marketing Strategy & Planning',
                                'slug' => 'marketing-strategy-planning',
                                'type' => 'dropdown',
                                'sort_order' => 1,
                                'description' => 'Strategic marketing planning services',
                                'content' => '<h1>Marketing Strategy & Planning</h1>',
                                'children' => [
                                    ['title' => 'Growth Strategy', 'slug' => 'growth-strategy', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Growth Strategy</h1>'],
                                    ['title' => 'Strategic Planning', 'slug' => 'strategic-planning', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Strategic Planning</h1>'],
                                    ['title' => 'Corporate & BU Strategy', 'slug' => 'corporate-bu-strategy', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Corporate & BU Strategy</h1>'],
                                    ['title' => 'Marketing Effectiveness', 'slug' => 'marketing-effectiveness', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Marketing Effectiveness</h1>'],
                                    ['title' => 'Marketing Practice', 'slug' => 'marketing-practice', 'type' => 'page', 'sort_order' => 5, 'content' => '<h1>Marketing Practice</h1>'],
                                    ['title' => 'Marketing Organization', 'slug' => 'marketing-organization', 'type' => 'page', 'sort_order' => 6, 'content' => '<h1>Marketing Organization</h1>']
                                ]
                            ],
                            // 2. Marketing Advisory
                            [
                                'title' => 'Marketing Advisory',
                                'slug' => 'marketing-advisory',
                                'type' => 'dropdown',
                                'sort_order' => 2,
                                'description' => 'Strategic marketing advisory services',
                                'content' => '<h1>Marketing Advisory</h1>',
                                'children' => [
                                    ['title' => 'Tactical Advisory', 'slug' => 'tactical-advisory', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Tactical Advisory</h1>'],
                                    ['title' => 'Strategic Advisory', 'slug' => 'strategic-advisory', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Strategic Advisory</h1>']
                                ]
                            ],
                            // 3. Product & Pricing
                            [
                                'title' => 'Product & Pricing',
                                'slug' => 'product-pricing',
                                'type' => 'dropdown',
                                'sort_order' => 3,
                                'description' => 'Product development and pricing strategy',
                                'content' => '<h1>Product & Pricing</h1>',
                                'children' => [
                                    ['title' => 'Business Modelling', 'slug' => 'business-modelling', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Business Modelling</h1>'],
                                    ['title' => 'Price Optimalization', 'slug' => 'price-optimalization', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Price Optimalization</h1>'],
                                    ['title' => 'Product Positioning', 'slug' => 'product-positioning', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Product Positioning</h1>']
                                ]
                            ],
                            // 4. Go To Market
                            [
                                'title' => 'Go To Market',
                                'slug' => 'go-to-market',
                                'type' => 'dropdown',
                                'sort_order' => 4,
                                'description' => 'Go-to-market strategy and execution',
                                'content' => '<h1>Go To Market</h1>',
                                'children' => [
                                    ['title' => 'Sales Force Management', 'slug' => 'sales-force-management', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Sales Force Management</h1>'],
                                    ['title' => 'Organization Design for Channel Management', 'slug' => 'organization-design-for-channel-management', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Organization Design for Channel Management</h1>'],
                                    ['title' => 'Channel Tiering', 'slug' => 'channel-tiering', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Channel Tiering</h1>'],
                                    ['title' => 'Distribution Channel Design', 'slug' => 'distribution-channel-design', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Distribution Channel Design</h1>']
                                ]
                            ],
                            // 5. Service Design
                            [
                                'title' => 'Service Design',
                                'slug' => 'service-design',
                                'type' => 'dropdown',
                                'sort_order' => 5,
                                'description' => 'Customer service design and optimization',
                                'content' => '<h1>Service Design</h1>',
                                'children' => [
                                    ['title' => 'Loyalty & Retention Program', 'slug' => 'loyalty-retention-program', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Loyalty & Retention Program</h1>'],
                                    ['title' => 'Customer Value Tiering', 'slug' => 'customer-value-tiering', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Customer Value Tiering</h1>'],
                                    ['title' => 'Service Organization Design', 'slug' => 'service-organization-design', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Service Organization Design</h1>'],
                                    ['title' => 'Service Blueprinting', 'slug' => 'service-blueprinting', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Service Blueprinting</h1>'],
                                    ['title' => 'Service Values', 'slug' => 'service-values', 'type' => 'page', 'sort_order' => 5, 'content' => '<h1>Service Values</h1>']
                                ]
                            ],
                            // 6. Business Process
                            [
                                'title' => 'Business Process',
                                'slug' => 'business-process',
                                'type' => 'dropdown',
                                'sort_order' => 6,
                                'description' => 'Business process optimization',
                                'content' => '<h1>Business Process</h1>',
                                'children' => [
                                    ['title' => 'Business Scale Up', 'slug' => 'business-scale-up', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Business Scale Up</h1>'],
                                    ['title' => 'Penyusunan SOP & IK', 'slug' => 'penyusunan-sop-ik', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Penyusunan SOP & IK</h1>'],
                                    ['title' => 'Transformasi Organisasi', 'slug' => 'transformasi-organisasi', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Transformasi Organisasi</h1>'],
                                    ['title' => 'Product Development', 'slug' => 'product-development', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Product Development</h1>']
                                ]
                            ],
                            // 7. Finance
                            [
                                'title' => 'Finance',
                                'slug' => 'finance',
                                'type' => 'dropdown',
                                'sort_order' => 7,
                                'description' => 'Financial consulting services',
                                'content' => '<h1>Finance</h1>',
                                'children' => [
                                    ['title' => 'Financial Report Analysis', 'slug' => 'financial-report-analysis', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Financial Report Analysis</h1>'],
                                    ['title' => 'Annual Report', 'slug' => 'annual-report', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Annual Report</h1>'],
                                    ['title' => 'Rancangan Anggaran', 'slug' => 'rancangan-anggaran', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Rancangan Anggaran</h1>'],
                                    ['title' => 'Rancangan Anggaran Jangka Panjang', 'slug' => 'rancangan-anggaran-jangka-panjang', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Rancangan Anggaran Jangka Panjang</h1>']
                                ]
                            ],
                            // 8. Konsultasi Online (single page)
                            [
                                'title' => 'Konsultasi Online',
                                'slug' => 'konsultasi-online',
                                'type' => 'page',
                                'sort_order' => 8,
                                'description' => 'Online consultation services',
                                'content' => '<h1>Konsultasi Online</h1>'
                            ]
                        ]
                    ],
                    [
                        'title' => 'Research',
                        'slug' => 'research',
                        'type' => 'dropdown',
                        'sort_order' => 2,
                        'description' => 'Market research services',
                        'content' => '<h1>Research Services</h1>',
                        'children' => [
                            ['title' => 'Blind Test', 'slug' => 'blind-test', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Blind Test</h1>'],
                            ['title' => 'Brand Research', 'slug' => 'brand-research', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Brand Research</h1>'],
                            ['title' => 'Consumer Research', 'slug' => 'consumer-research', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Consumer Research</h1>'],
                            ['title' => 'Customer Satisfaction Research', 'slug' => 'customer-satisfaction-research', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Customer Satisfaction Research</h1>'],
                            ['title' => 'Market Analysis', 'slug' => 'market-analysis', 'type' => 'page', 'sort_order' => 5, 'content' => '<h1>Market Analysis</h1>'],
                            ['title' => 'Product & Pricing Research', 'slug' => 'product-pricing-research', 'type' => 'page', 'sort_order' => 6, 'content' => '<h1>Product & Pricing Research</h1>'],
                            ['title' => 'Sales & Distribution Research', 'slug' => 'sales-distribution-research', 'type' => 'page', 'sort_order' => 7, 'content' => '<h1>Sales & Distribution Research</h1>'],
                            ['title' => 'Social & Opinion Research', 'slug' => 'social-opinion-research', 'type' => 'page', 'sort_order' => 8, 'content' => '<h1>Social & Opinion Research</h1>']
                        ]
                    ],
                    [
                        'title' => 'Academy',
                        'slug' => 'academy',
                        'type' => 'dropdown',
                        'sort_order' => 3,
                        'description' => 'Professional development programs',
                        'content' => '<h1>Academy Programs</h1>',
                        'children' => [
                            ['title' => 'Practical Leadership', 'slug' => 'practical-leadership', 'type' => 'page', 'sort_order' => 1, 'content' => '<h1>Practical Leadership</h1>'],
                            ['title' => 'Advance Leadership Programs', 'slug' => 'advance-leadership-programs', 'type' => 'page', 'sort_order' => 2, 'content' => '<h1>Advance Leadership Programs</h1>'],
                            ['title' => 'Pengembangan Organisasi', 'slug' => 'pengembangan-organisasi', 'type' => 'page', 'sort_order' => 3, 'content' => '<h1>Pengembangan Organisasi</h1>'],
                            ['title' => 'Operational Performance Improvement', 'slug' => 'operational-performance-improvement', 'type' => 'page', 'sort_order' => 4, 'content' => '<h1>Operational Performance Improvement</h1>']
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Insight',
                'slug' => 'insight',
                'type' => 'page',
                'sort_order' => 3,
                'description' => 'Industry insights',
                'content' => '<h1>Insights</h1>'
            ],
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'type' => 'page',
                'sort_order' => 4,
                'description' => 'About our company',
                'content' => '<h1>About Us</h1>'
            ]
        ];

        $this->createMenuItems($menuStructure, null, 0, $admin->id);
        
        echo "✅ Menu structure PERSIS sesuai gambar berhasil dibuat!\n";
        echo "📋 Hierarchy yang dibuat:\n";
        echo "   📁 Service → Consulting → 8 main areas:\n";
        echo "     1. Marketing Strategy & Planning (6 sub-items)\n";
        echo "     2. Marketing Advisory (2 sub-items)\n";  
        echo "     3. Product & Pricing (3 sub-items)\n";
        echo "     4. Go To Market (4 sub-items)\n";
        echo "     5. Service Design (5 sub-items)\n";
        echo "     6. Business Process (4 sub-items)\n";
        echo "     7. Finance (4 sub-items)\n";
        echo "     8. Konsultasi Online (single page)\n";
        echo "   📁 Research (8 items)\n";
        echo "   📁 Academy (4 items)\n";
        
        $totalMenus = Menu::count();
        echo "   📊 Total: {$totalMenus} menu items created\n";
        echo "🎉 MenuSeeder sesuai struktur gambar completed!\n";
    }

    private function createMenuItems($items, $parentId = null, $level = 0, $userId = 1)
    {
        foreach ($items as $item) {
            $children = $item['children'] ?? null;
            unset($item['children']);
            
            $menuItem = Menu::create(array_merge($item, [
                'parent_id' => $parentId,
                'level' => $level,
                'user_id' => $userId,
                'status' => 'active',
                'meta_title' => $item['title'],
                'meta_description' => $item['description'] ?? null
            ]));

            if ($children) {
                $this->createMenuItems($children, $menuItem->id, $level + 1, $userId);
            }
        }
    }
}
