<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeHeroSlider extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'hero_background',
        'button_text',
        'button_url',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope untuk slider aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
