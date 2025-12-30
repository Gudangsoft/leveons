<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'ComProf Solutions',
                'tagline' => 'Excellence in Professional Consulting',
                'description' => 'We are a professional consulting company dedicated to providing exceptional services to our clients. Our team of experts brings years of experience and innovative solutions to help businesses grow and succeed.',
                'phone' => '+62 21 1234-5678',
                'email' => 'info@comprof.com',
                'address' => 'Jakarta Business District, Indonesia',
                'website' => 'https://comprof.com',
                'social_media' => [
                    'facebook' => 'https://facebook.com/comprof',
                    'twitter' => 'https://twitter.com/comprof',
                    'instagram' => 'https://instagram.com/comprof',
                    'linkedin' => 'https://linkedin.com/company/comprof',
                    'youtube' => 'https://youtube.com/@comprof'
                ],
                'business_hours' => [
                    'monday' => '09:00 - 17:00',
                    'tuesday' => '09:00 - 17:00',
                    'wednesday' => '09:00 - 17:00',
                    'thursday' => '09:00 - 17:00',
                    'friday' => '09:00 - 17:00',
                    'saturday' => 'Closed',
                    'sunday' => 'Closed'
                ],
                'meta_title' => 'ComProf Solutions - Excellence in Professional Consulting',
                'meta_description' => 'Professional consulting services with experienced experts helping businesses grow and succeed through innovative solutions.',
                'footer_text' => '© 2025 ComProf Solutions. All rights reserved. Excellence in Professional Consulting.'
            ]
        );
    }
}
