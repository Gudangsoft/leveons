<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function index()
    {
        $company = Company::getSettings();
        return view('consultation.form', compact('company'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'service_needs' => 'required|string|max:255',
            'scope_details' => 'required|string',
        ], [
            'full_name.required' => 'Nama lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'service_needs.required' => 'Jenis layanan harus dipilih',
            'scope_details.required' => 'Deskripsi kebutuhan harus diisi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Set default value for estimated_implementation_time if not provided
        $data = $request->all();
        $data['estimated_implementation_time'] = $request->input('estimated_implementation_time', 'Not specified');

        ConsultationRequest::create($data);

        return redirect()->back()->with('success', 'Terima kasih! Permintaan konsultasi Anda telah dikirim. Tim kami akan menghubungi Anda dalam 1×24 jam.');
    }
}
