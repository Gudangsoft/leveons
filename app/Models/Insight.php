<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Insight extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'status',
        'featured_image',
        'is_featured',
        'views_count',
        'sort_order',
        'seo_settings',
        'category_id',
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
        static::saving(function ($insight) {
            if (empty($insight->slug)) {
                $insight->slug = Str::slug($insight->title);
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Accessors
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?: $this->title,
        );
    }

    protected function excerptText(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->excerpt ?: Str::limit(strip_tags($this->content), 200),
        );
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    // Cache helpers
    public static function getPublished($limit = null)
    {
        $query = static::published()->orderBy('published_at', 'desc');
        return $limit ? $query->limit($limit)->get() : $query->get();
    }

    public static function getFeatured($limit = null)
    {
        $query = static::published()->featured()->orderBy('published_at', 'desc');
        return $limit ? $query->limit($limit)->get() : $query->get();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->published()->with(['user', 'category'])->first();
    }

    public static function getByCategoryId($categoryId, $limit = null)
    {
        $query = static::published()->byCategory($categoryId)->orderBy('published_at', 'desc');
        return $limit ? $query->limit($limit)->get() : $query->get();
    }
}
