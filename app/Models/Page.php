<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'status',
        'featured_image',
        'is_featured',
        'sort_order',
        'seo_settings',
        'user_id',
        'published_at'
    ];

    protected $casts = [
        'seo_settings' => 'array',
        'is_featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    protected static function booted()
    {
        static::saving(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        // Tidak menggunakan cache lagi
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Accessors
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?: $this->title,
        );
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit(strip_tags($this->content), 200),
        );
    }

    // Cache helpers
    public static function getPublished()
    {
        return static::published()->orderBy('sort_order')->get();
    }

    public static function getFeatured()
    {
        return static::published()->featured()->orderBy('sort_order')->get();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->published()->first();
    }
}
