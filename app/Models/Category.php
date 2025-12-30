<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'color',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected static function booted()
    {
        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        // Tidak menggunakan cache lagi
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function publishedArticles()
    {
        return $this->articles()->published();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessors
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?: $this->name,
        );
    }

    protected function articlesCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publishedArticles()->count(),
        );
    }

    // Cache helpers
    public static function getActive()
    {
        return static::active()->orderBy('sort_order')->get();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->active()->first();
    }

    public static function getWithArticleCounts()
    {
        return static::active()
            ->withCount(['articles' => function($query) {
                $query->published();
            }])
            ->orderBy('sort_order')
            ->get();
    }
}
