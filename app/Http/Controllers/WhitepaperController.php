<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whitepaper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class WhitepaperController extends Controller
{
    public function index()
    {
        $whitepapers = Whitepaper::active()
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $featuredWhitepapers = Whitepaper::active()
            ->featured()
            ->orderBy('download_count', 'desc')
            ->limit(3)
            ->get();

        // Get company data for CTA section
        $company = \App\Models\Company::first();

        return view('frontend.whitepapers.index', compact('whitepapers', 'featuredWhitepapers', 'company'));
    }

    public function show(Whitepaper $whitepaper)
    {
        if (!$whitepaper->is_active) {
            abort(404);
        }

        $relatedWhitepapers = Whitepaper::active()
            ->where('id', '!=', $whitepaper->id)
            ->orderBy('download_count', 'desc')
            ->limit(3)
            ->get();

        // Get company data for CTA section
        $company = \App\Models\Company::first();

        return view('frontend.whitepapers.show', compact('whitepaper', 'relatedWhitepapers', 'company'));
    }

    public function download(Whitepaper $whitepaper)
    {
        if (!$whitepaper->is_active) {
            abort(404);
        }

        // Increment download count
        $whitepaper->incrementDownloadCount();

        // Check if file exists in storage
        if (!$whitepaper->file_path || !Storage::disk('public')->exists($whitepaper->file_path)) {
            // For demo purposes, create a placeholder response when file doesn't exist
            return response()->json([
                'message' => 'File download akan segera dimulai (Demo Mode)',
                'filename' => $whitepaper->file_name ?: $whitepaper->slug . '.pdf',
                'size' => $whitepaper->formatted_file_size,
                'note' => 'Ini adalah mode demo. File belum di-upload ke server.',
                'download_count' => $whitepaper->download_count
            ]);
        }

        // Return file download
        $filePath = storage_path('app/public/' . $whitepaper->file_path);
        
        return response()->download($filePath, $whitepaper->file_name);
    }
}
