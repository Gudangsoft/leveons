<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationRequest;

class ConsultationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultationRequests = ConsultationRequest::latest()->paginate(15);
        return view('admin.consultation-requests.index', compact('consultationRequests'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ConsultationRequest $consultationRequest)
    {
        return view('admin.consultation-requests.show', compact('consultationRequest'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationRequest $consultationRequest)
    {
        $consultationRequest->delete();
        return redirect()->route('admin.consultation-requests.index')
            ->with('success', 'Consultation request deleted successfully.');
    }
}
