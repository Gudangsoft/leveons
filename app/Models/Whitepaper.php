<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Whitepaper extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'file_path',
        'file_name',
        'file_size',
        'is_featured',
        'is_active',
        'download_count',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'download_count' => 'integer',
    ];

    // Boot method to auto-generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($whitepaper) {
            if (empty($whitepaper->slug)) {
                $whitepaper->slug = Str::slug($whitepaper->title);
            }
        });

        static::updating(function ($whitepaper) {
            if ($whitepaper->isDirty('title') && empty($whitepaper->slug)) {
                $whitepaper->slug = Str::slug($whitepaper->title);
            }
        });
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Accessors
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    public function getFormattedFileSizeAttribute(): ?string
    {
        if (!$this->file_size) {
            return null;
        }

        $bytes = (int) $this->file_size;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        
        return $bytes . ' bytes';
    }

    public function getFileExtensionAttribute(): ?string
    {
        return $this->file_name ? pathinfo($this->file_name, PATHINFO_EXTENSION) : null;
    }

    // Methods
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
