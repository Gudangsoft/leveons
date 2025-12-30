<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InsightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insights = Insight::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.insights.index', compact('insights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $users = User::all();
        
        return view('admin.insights.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:insights,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'seo_settings' => 'nullable|json'
        ]);

        // Generate slug if not provided
        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['title']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('insights', $filename, 'public');
            
            if ($path) {
                $validatedData['featured_image'] = 'insights/' . $filename;
            }
        }

        // Handle checkbox values
        $validatedData['is_featured'] = $request->has('is_featured');
        $validatedData['sort_order'] = $validatedData['sort_order'] ?? 0;
        
        // Set published_at if status is published and not set
        if ($validatedData['status'] === 'published' && empty($validatedData['published_at'])) {
            $validatedData['published_at'] = now();
        }

        Insight::create($validatedData);

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Insight $insight)
    {
        $insight->load(['user', 'category']);
        
        return view('admin.insights.show', compact('insight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insight $insight)
    {
        $categories = Category::active()->get();
        $users = User::all();
        
        return view('admin.insights.edit', compact('insight', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Insight $insight)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:insights,slug,' . $insight->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
            'seo_settings' => 'nullable|json'
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($insight->featured_image && Storage::disk('public')->exists($insight->featured_image)) {
                Storage::disk('public')->delete($insight->featured_image);
            }
            
            $file = $request->file('featured_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('insights', $filename, 'public');
            
            if ($path) {
                $validatedData['featured_image'] = 'insights/' . $filename;
            }
        }

        // Handle checkbox values
        $validatedData['is_featured'] = $request->has('is_featured');
        $validatedData['sort_order'] = $validatedData['sort_order'] ?? 0;
        
        // Set published_at if status changed to published and not set
        if ($validatedData['status'] === 'published' && 
            $insight->status !== 'published' && 
            empty($validatedData['published_at'])) {
            $validatedData['published_at'] = now();
        }

        $insight->update($validatedData);

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insight $insight)
    {
        // Delete featured image if exists
        if ($insight->featured_image && Storage::disk('public')->exists($insight->featured_image)) {
            Storage::disk('public')->delete($insight->featured_image);
        }

        $insight->delete();

        return redirect()->route('admin.insights.index')
            ->with('success', 'Insight berhasil dihapus!');
    }
}
