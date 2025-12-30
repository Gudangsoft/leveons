<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'hero_background',
        'meta_title',
        'meta_description',
        'status',
        'type',
        'url',
        'icon',
        'sort_order',
        'parent_id',
        'level',
        'is_featured',
        'settings',
        'user_id'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_featured' => 'boolean'
    ];

    protected static function booted()
    {
        static::saving(function ($menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->title);
            }
            
            // Auto set level based on parent
            if ($menu->parent_id) {
                $parent = static::find($menu->parent_id);
                $menu->level = $parent ? $parent->level + 1 : 0;
            } else {
                $menu->level = 0;
            }
        });

        // Tidak menggunakan cache lagi, jadi tidak perlu cache clearing
    }

    // Relationships
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('status', 'active')->orderBy('sort_order');
    }

    public function allChildren()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMainMenu($query)
    {
        return $query->where('level', 0);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    // Accessors
    protected function metaTitle(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ?: $this->title,
        );
    }

    protected function fullUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type === 'link' ? $this->url : route('menu.show', $this->slug),
        );
    }

    // Methods
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    public function getBreadcrumbs()
    {
        $breadcrumbs = collect();
        $current = $this;
        
        while ($current) {
            $breadcrumbs->prepend([
                'title' => $current->title,
                'url' => $current->type === 'page' ? route('menu.show', $current->slug) : $current->url,
                'active' => $current->id === $this->id
            ]);
            $current = $current->parent;
        }
        
        return $breadcrumbs;
    }

    // Cache helpers
    public static function getMainMenu()
    {
        return static::active()
            ->mainMenu()
            ->with(['children' => function($query) {
                $query->with(['children' => function($subQuery) {
                    $subQuery->with(['children']);
                }]);
            }])
            ->orderBy('sort_order')
            ->get();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->active()->first();
    }

    public static function getHierarchy()
    {
        $menus = static::active()->orderBy('level')->orderBy('sort_order')->get();
        return static::buildTree($menus);
    }

    public static function buildTree($menus, $parentId = null)
    {
        $tree = collect();
        
        foreach ($menus->where('parent_id', $parentId) as $menu) {
            $menu->children_items = static::buildTree($menus, $menu->id);
            $tree->push($menu);
        }
        
        return $tree;
    }

    public static function getTreeStructure()
    {
        $menus = static::active()
            ->with(['children' => function($query) {
                $query->active()->orderBy('sort_order')->with(['children' => function($subQuery) {
                    $subQuery->active()->orderBy('sort_order')->with(['children' => function($deepQuery) {
                        $deepQuery->active()->orderBy('sort_order');
                    }]);
                }]);
            }])
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();
            
        return static::convertToArray($menus);
    }

    public static function convertToArray($menus)
    {
        $result = [];
        
        foreach ($menus as $menu) {
            $menuArray = [
                'id' => $menu->id,
                'title' => $menu->title,
                'slug' => $menu->slug,
                'description' => $menu->description,
                'content' => $menu->content,
                'type' => $menu->type,
                'url' => $menu->url,
                'parent_id' => $menu->parent_id,
                'sort_order' => $menu->sort_order,
                'level' => $menu->level,
                'status' => $menu->status,
                'meta_title' => $menu->meta_title,
                'meta_description' => $menu->meta_description,
                'hero_background' => $menu->hero_background,
                'user_id' => $menu->user_id,
                'created_at' => $menu->created_at,
                'updated_at' => $menu->updated_at,
            ];
            
            if ($menu->children && $menu->children->count() > 0) {
                $menuArray['children'] = static::convertToArray($menu->children);
            }
            
            $result[] = $menuArray;
        }
        
        return $result;
    }
}
