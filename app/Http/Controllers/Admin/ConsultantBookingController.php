<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultantBooking;
use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = ConsultantBooking::with('consultant');
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by consultant
        if ($request->has('consultant_id') && $request->consultant_id != '') {
            $query->where('consultant_id', $request->consultant_id);
        }
        
        // Search by name, email, or phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }
        
        // Order by latest
        $bookings = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get all consultants for filter
        $consultants = Consultant::orderBy('name')->get();
        
        return view('admin.bookings.index', compact('bookings', 'consultants'));
    }
    
    public function show($id)
    {
        $booking = ConsultantBooking::with('consultant')->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $booking = ConsultantBooking::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'meeting_url' => 'nullable|url|max:500',
        ]);
        
        $booking->update($validated);
        
        return redirect()->route('admin.bookings.show', $id)
            ->with('success', 'Status booking berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $booking = ConsultantBooking::findOrFail($id);
        $booking->delete();
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus!');
    }
}
