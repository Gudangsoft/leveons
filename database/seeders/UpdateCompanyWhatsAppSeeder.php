<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class UpdateCompanyWhatsAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = Company::first();
        
        if ($company) {
            $company->whatsapp = '6281234567890';
            
            // Update social media to include threads instead of twitter
            $socialMedia = $company->social_media ?? [];
            
            // Remove twitter if exists and add threads
            if (isset($socialMedia['twitter'])) {
                $socialMedia['threads'] = $socialMedia['twitter'];
                unset($socialMedia['twitter']);
            }
            
            $company->social_media = $socialMedia;
            $company->save();
            
            $this->command->info('Company WhatsApp and social media updated successfully!');
        } else {
            $this->command->info('No company found in database.');
        }
    }
}
