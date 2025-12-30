<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConsultantController extends Controller
{
    public function index()
    {
        $consultants = Consultant::latest()->paginate(15);
        return view('admin.consultants.index', compact('consultants'));
    }

    public function create()
    {
        return view('admin.consultants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:consultants,slug',
            'title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'price_text' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'booking_url' => 'nullable|url',
            'consultation_packages' => 'nullable|json',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('consultants', 'public');
        }

        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        Consultant::create($validated);

        return redirect()->route('admin.consultants.index')
            ->with('success', 'Consultant created successfully.');
    }

    public function show(Consultant $consultant)
    {
        return view('admin.consultants.show', compact('consultant'));
    }

    public function edit(Consultant $consultant)
    {
        return view('admin.consultants.edit', compact('consultant'));
    }

    public function update(Request $request, Consultant $consultant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:consultants,slug,' . $consultant->id,
            'title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'price_text' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'bio' => 'nullable|string',
            'expertise' => 'nullable|string',
            'booking_url' => 'nullable|url',
            'consultation_packages' => 'nullable|json',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($consultant->avatar && Storage::disk('public')->exists($consultant->avatar)) {
                Storage::disk('public')->delete($consultant->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('consultants', 'public');
        }

        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        $consultant->update($validated);

        return redirect()->route('admin.consultants.index')
            ->with('success', 'Consultant updated successfully.');
    }

    public function destroy(Consultant $consultant)
    {
        // Delete avatar
        if ($consultant->avatar && Storage::disk('public')->exists($consultant->avatar)) {
            Storage::disk('public')->delete($consultant->avatar);
        }

        $consultant->delete();

        return redirect()->route('admin.consultants.index')
            ->with('success', 'Consultant deleted successfully.');
    }
}
