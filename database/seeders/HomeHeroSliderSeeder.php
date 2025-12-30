<?php

namespace Database\Seeders;

use App\Models\HomeHeroSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeHeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing sliders
        HomeHeroSlider::truncate();

        $sliders = [
            [
                'title' => 'Transform Your Business Strategy',
                'description' => 'Expert consulting services to accelerate your company growth and optimize operational excellence in today\'s competitive market.',
                'hero_background' => null, // Will use picsum fallback
                'button_text' => 'Start Your Journey',
                'button_url' => '/menu/consulting',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Executive Leadership Training',
                'description' => 'Comprehensive academy programs designed to develop world-class leaders and build high-performance teams.',
                'hero_background' => null, // Will use picsum fallback
                'button_text' => 'Explore Academy',
                'button_url' => '/menu/academy',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Market Intelligence & Analytics',
                'description' => 'Data-driven insights and strategic market analysis to help you make informed decisions and stay ahead of competition.',
                'hero_background' => null, // Will use picsum fallback
                'button_text' => 'Learn More',
                'button_url' => '/menu/market-analysis',
                'sort_order' => 3,
                'is_active' => true,
            ]
        ];

        foreach ($sliders as $slider) {
            HomeHeroSlider::create($slider);
        }
    }
}
