<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::getSettings();
        return view('admin.company.index', compact('company'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'google_analytics' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string',
            'social_media.facebook' => 'nullable|url',
            'social_media.threads' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
        ]);

        $company = Company::first() ?? new Company();
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $logoPath = $request->file('logo')->store('company', 'public');
            $company->logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($company->favicon && Storage::disk('public')->exists($company->favicon)) {
                Storage::disk('public')->delete($company->favicon);
            }
            $faviconPath = $request->file('favicon')->store('company', 'public');
            $company->favicon = $faviconPath;
        }

        // Fill data dengan pengecekan kolom yang ada
        $fillData = $request->except(['logo', 'favicon', 'social_media', 'business_hours']);
        
        // Check if whatsapp column exists before trying to save
        if (\Schema::hasColumn('companies', 'whatsapp')) {
            $company->fill($fillData);
        } else {
            // If whatsapp column doesn't exist, exclude it
            $company->fill(collect($fillData)->except('whatsapp')->toArray());
        }
        
        $company->social_media = $request->input('social_media', []);
        $company->business_hours = $request->input('business_hours', []);
        $company->save();

        // Tidak menggunakan cache lagi, data langsung diambil dari database

        return redirect()->route('admin.company.index')
            ->with('success', 'Company settings updated successfully!');
    }
}
