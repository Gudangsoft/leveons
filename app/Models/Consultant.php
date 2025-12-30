<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'company',
        'price_text',
        'avatar',
        'bio',
        'expertise',
        'booking_url',
        'consultation_packages',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'consultation_packages' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
        });
    }

    public function packages()
    {
        return $this->hasMany(ConsultationPackage::class)->where('is_active', true)->orderBy('order');
    }

    public function allPackages()
    {
        return $this->hasMany(ConsultationPackage::class)->orderBy('order');
    }
}
