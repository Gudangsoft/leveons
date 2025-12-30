<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationPackage;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultationPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = ConsultationPackage::with('consultant');
        
        // Filter by consultant
        if ($request->has('consultant_id') && $request->consultant_id != '') {
            $query->where('consultant_id', $request->consultant_id);
        }
        
        $packages = $query->orderBy('consultant_id')->orderBy('order')->paginate(20);
        $consultants = Consultant::orderBy('name')->get();
        
        return view('admin.packages.index', compact('packages', 'consultants'));
    }

    public function create()
    {
        $consultants = Consultant::where('is_published', true)->orderBy('name')->get();
        return view('admin.packages.create', compact('consultants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'price_display' => 'required|string|max:100',
            'description' => 'nullable|string',
            'platform' => 'required|string|max:100',
            'order' => 'nullable|integer',
            'is_popular' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $validated['order'] = $validated['order'] ?? 0;

        ConsultationPackage::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package created successfully.');
    }

    public function edit(ConsultationPackage $package)
    {
        $consultants = Consultant::orderBy('name')->get();
        return view('admin.packages.edit', compact('package', 'consultants'));
    }

    public function update(Request $request, ConsultationPackage $package)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'price_display' => 'required|string|max:100',
            'description' => 'nullable|string',
            'platform' => 'required|string|max:100',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $validated['order'] = $validated['order'] ?? 0;

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package updated successfully.');
    }

    public function destroy(ConsultationPackage $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package deleted successfully.');
    }
}
