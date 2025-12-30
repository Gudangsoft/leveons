<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'tagline', 'description', 'phone', 'email', 'address', 
        'website', 'logo', 'favicon', 'social_media', 'business_hours',
        'meta_title', 'meta_description', 'google_analytics', 'footer_text',
        'whatsapp'
    ];

    protected $casts = [
        'social_media' => 'array',
        'business_hours' => 'array'
    ];

    /**
     * Get whatsapp attribute (handle if column doesn't exist)
     */
    public function getWhatsappAttribute($value)
    {
        // Check if column exists in database
        if (!\Schema::hasColumn('companies', 'whatsapp')) {
            return null;
        }
        return $value;
    }

    public static function getSettings()
    {
        return static::first() ?? new static([
            'name' => 'Your Company Name',
            'tagline' => 'Your Company Tagline',
            'description' => 'Your company description goes here.',
            'whatsapp' => '',
            'social_media' => [
                'facebook' => '',
                'threads' => '',
                'instagram' => '',
                'linkedin' => '',
                'youtube' => ''
            ],
            'business_hours' => [
                'monday' => '09:00 - 17:00',
                'tuesday' => '09:00 - 17:00',
                'wednesday' => '09:00 - 17:00',
                'thursday' => '09:00 - 17:00',
                'friday' => '09:00 - 17:00',
                'saturday' => 'Closed',
                'sunday' => 'Closed'
            ]
        ]);
    }
}
