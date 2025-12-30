<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ctaSections = CtaSection::orderBy('page')->orderBy('order')->get();
        return view('admin.cta-sections.index', compact('ctaSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cta-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:100',
            'button_link' => 'required|string|max:500',
            'background_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
        ]);

        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['show_consultation_button'] = $request->has('show_consultation_button') ? 1 : 0;
        $validated['show_whatsapp_button'] = $request->has('show_whatsapp_button') ? 1 : 0;
        $validated['background_color'] = $validated['background_color'] ?? '#1e5a96';
        $validated['order'] = $validated['order'] ?? 0;

        CtaSection::create($validated);

        return redirect()->route('admin.cta-sections.index')
            ->with('success', 'CTA Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CtaSection $ctaSection)
    {
        return view('admin.cta-sections.show', compact('ctaSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CtaSection $ctaSection)
    {
        return view('admin.cta-sections.edit', compact('ctaSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CtaSection $ctaSection)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:50',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:100',
            'button_link' => 'required|string|max:500',
            'background_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer',
        ]);

        // Handle checkboxes
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['show_consultation_button'] = $request->has('show_consultation_button') ? 1 : 0;
        $validated['show_whatsapp_button'] = $request->has('show_whatsapp_button') ? 1 : 0;
        $validated['background_color'] = $validated['background_color'] ?? '#1e5a96';

        $ctaSection->update($validated);

        return redirect()->route('admin.cta-sections.index')
            ->with('success', 'CTA Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CtaSection $ctaSection)
    {
        $ctaSection->delete();

        return redirect()->route('admin.cta-sections.index')
            ->with('success', 'CTA Section deleted successfully.');
    }
}
