<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::getTreeStructure();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Disable creating new menus
        abort(403, 'Creating new menus is disabled. Only editing existing menus is allowed.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Disable storing new menus
        abort(403, 'Creating new menus is disabled. Only editing existing menus is allowed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->orWhere('level', '<', 3)
            ->where('id', '!=', $menu->id)
            ->orderBy('sort_order')
            ->get();
        
        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug,' . $menu->id,
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'type' => 'required|in:page,link,dropdown',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'nullable|boolean'
        ]);

        // Handle hero background upload
        if ($request->hasFile('hero_background')) {
            // Delete old file if exists
            if ($menu->hero_background && Storage::disk('public')->exists('hero_backgrounds/' . $menu->hero_background)) {
                Storage::disk('public')->delete('hero_backgrounds/' . $menu->hero_background);
            }
            
            $file = $request->file('hero_background');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            // Store using public disk
            $path = $file->storeAs('hero_backgrounds', $filename, 'public');
            
            if ($path) {
                $validatedData['hero_background'] = $filename;
                Log::info('Hero background uploaded successfully: ' . $path);
            } else {
                Log::error('Failed to upload hero background');
                return redirect()->back()->withErrors(['hero_background' => 'Failed to upload image']);
            }
        }

        // Update level based on parent
        $level = 0;
        if ($validatedData['parent_id']) {
            $parent = Menu::find($validatedData['parent_id']);
            $level = $parent->level + 1;
        }

        $validatedData['level'] = $level;
        
        // Handle checkbox value (checkbox not sent when unchecked)
        $validatedData['is_featured'] = $request->has('is_featured') ? true : false;

        $menu->update($validatedData);

        // Tidak menggunakan cache lagi, jadi tidak perlu clear cache

        return redirect()->route('admin.menus.index')
            ->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Disable deleting menus
        abort(403, 'Deleting menus is disabled. Only editing existing menus is allowed.');
    }

    /**
     * Clear all menu cache (not used anymore since we removed caching)
     */
    public function clearCache()
    {
        // Tidak menggunakan cache lagi, tapi route masih ada untuk compatibility
        return redirect()->route('admin.menus.index')
            ->with('success', 'Cache menu berhasil dihapus! (Aplikasi sudah tidak menggunakan cache)');
    }
}
