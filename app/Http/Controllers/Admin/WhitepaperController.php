<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Whitepaper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WhitepaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whitepapers = Whitepaper::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.whitepapers.index', compact('whitepapers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.whitepapers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:whitepapers',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'file', 'meta_keywords']);
        
        // Handle slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Handle meta keywords
        if ($request->filled('meta_keywords')) {
            $data['meta_keywords'] = array_map('trim', explode(',', $request->meta_keywords));
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('whitepapers/images', 'public');
            $data['image_path'] = $imagePath;
        }
        
        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('whitepapers/files', 'public');
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }
        
        Whitepaper::create($data);
        
        return redirect()->route('admin.whitepapers.index')
            ->with('success', 'Whitepaper berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Whitepaper $whitepaper)
    {
        return view('admin.whitepapers.show', compact('whitepaper'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Whitepaper $whitepaper)
    {
        return view('admin.whitepapers.edit', compact('whitepaper'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Whitepaper $whitepaper)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:whitepapers,slug,' . $whitepaper->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
        ]);

        $data = $request->except(['image', 'file', 'meta_keywords']);
        
        // Handle slug
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Handle meta keywords
        if ($request->filled('meta_keywords')) {
            $data['meta_keywords'] = array_map('trim', explode(',', $request->meta_keywords));
        } else {
            $data['meta_keywords'] = null;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($whitepaper->image_path) {
                Storage::disk('public')->delete($whitepaper->image_path);
            }
            $imagePath = $request->file('image')->store('whitepapers/images', 'public');
            $data['image_path'] = $imagePath;
        }
        
        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file
            if ($whitepaper->file_path) {
                Storage::disk('public')->delete($whitepaper->file_path);
            }
            $file = $request->file('file');
            $filePath = $file->store('whitepapers/files', 'public');
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_size'] = $file->getSize();
        }
        
        $whitepaper->update($data);
        
        return redirect()->route('admin.whitepapers.index')
            ->with('success', 'Whitepaper berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whitepaper $whitepaper)
    {
        // Delete associated files
        if ($whitepaper->image_path) {
            Storage::disk('public')->delete($whitepaper->image_path);
        }
        if ($whitepaper->file_path) {
            Storage::disk('public')->delete($whitepaper->file_path);
        }
        
        $whitepaper->delete();
        
        return redirect()->route('admin.whitepapers.index')
            ->with('success', 'Whitepaper berhasil dihapus.');
    }
}
