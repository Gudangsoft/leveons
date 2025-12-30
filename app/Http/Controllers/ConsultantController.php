<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Company;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index()
    {
        $consultants = Consultant::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $company = Company::getSettings();
        $ctaSection = CtaSection::getActive('consultation');

        return view('frontend.consultants.index', compact('consultants', 'company', 'ctaSection'));
    }

    public function show($slug)
    {
        $consultant = Consultant::where('slug', $slug)
            ->where('is_published', true)
            ->with('packages') // Load active packages from database
            ->firstOrFail();
        
        $company = Company::getSettings();

        return view('frontend.consultant.show', compact('consultant', 'company'));
    }
}
