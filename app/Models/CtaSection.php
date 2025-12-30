<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page',
        'title',
        'description',
        'button_text',
        'button_link',
        'show_consultation_button',
        'show_whatsapp_button',
        'background_color',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_consultation_button' => 'boolean',
        'show_whatsapp_button' => 'boolean',
    ];

    /**
     * Get active CTA section for specific page
     */
    public static function getActive($page = 'home')
    {
        return self::where('is_active', true)
            ->where('page', $page)
            ->orderBy('order')
            ->first();
    }
}
