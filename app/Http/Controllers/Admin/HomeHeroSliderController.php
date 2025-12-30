<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeHeroSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = HomeHeroSlider::ordered()->get();
        return view('admin.home-hero-sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if we already have 5 sliders (maximum limit)
        if (HomeHeroSlider::count() >= 5) {
            return redirect()->route('admin.home-hero-sliders.index')
                ->with('error', 'Maksimal hanya 5 hero slider yang diperbolehkan.');
        }

        return view('admin.home-hero-sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check limit
        if (HomeHeroSlider::count() >= 5) {
            return redirect()->route('admin.home-hero-sliders.index')
                ->with('error', 'Maksimal hanya 5 hero slider yang diperbolehkan.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle hero background upload
        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/hero_backgrounds', $filename);
            $validatedData['hero_background'] = $filename;
        }

        $validatedData['is_active'] = $request->has('is_active');

        HomeHeroSlider::create($validatedData);

        return redirect()->route('admin.home-hero-sliders.index')
            ->with('success', 'Hero slider berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeHeroSlider $homeHeroSlider)
    {
        return view('admin.home-hero-sliders.show', compact('homeHeroSlider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeHeroSlider $homeHeroSlider)
    {
        return view('admin.home-hero-sliders.edit', compact('homeHeroSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeHeroSlider $homeHeroSlider)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        // Handle hero background upload
        if ($request->hasFile('hero_background')) {
            // Delete old file if exists
            if ($homeHeroSlider->hero_background && Storage::exists('public/hero_backgrounds/' . $homeHeroSlider->hero_background)) {
                Storage::delete('public/hero_backgrounds/' . $homeHeroSlider->hero_background);
            }
            
            $file = $request->file('hero_background');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/hero_backgrounds', $filename);
            $validatedData['hero_background'] = $filename;
        }

        $validatedData['is_active'] = $request->has('is_active');

        $homeHeroSlider->update($validatedData);

        return redirect()->route('admin.home-hero-sliders.index')
            ->with('success', 'Hero slider berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeHeroSlider $homeHeroSlider)
    {
        // Delete associated file
        if ($homeHeroSlider->hero_background && Storage::exists('public/hero_backgrounds/' . $homeHeroSlider->hero_background)) {
            Storage::delete('public/hero_backgrounds/' . $homeHeroSlider->hero_background);
        }

        $homeHeroSlider->delete();

        return redirect()->route('admin.home-hero-sliders.index')
            ->with('success', 'Hero slider berhasil dihapus!');
    }
}
