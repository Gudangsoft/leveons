<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\ConsultantBooking;
use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function calendar($slug, Request $request)
    {
        $consultant = Consultant::where('slug', $slug)
            ->with('packages')
            ->where('is_published', true)
            ->firstOrFail();
        
        $company = Company::getSettings();
        
        // Get packages from database or JSON
        $packagesFromDB = $consultant->packages->count() > 0;
        $packages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? []);
        
        // Get package from query parameter
        $packageIndex = $request->get('event');
        $selectedPackage = null;
        
        if ($packageIndex !== null && count($packages) > 0) {
            // Map event names to package indices
            $eventMap = [
                '30min' => 0,
                '60min' => 1,
            ];
            
            $index = $eventMap[$packageIndex] ?? 0;
            
            if ($packagesFromDB) {
                $selectedPackage = $packages[$index] ?? null;
            } else {
                $selectedPackage = $packages[$index] ?? null;
            }
        }
        
        // If no package selected, use first one
        if (!$selectedPackage && count($packages) > 0) {
            $selectedPackage = $packages[0];
        }
        
        return view('frontend.booking.calendar', compact('consultant', 'company', 'selectedPackage'));
    }
    
    public function details($slug, Request $request)
    {
        $consultant = Consultant::where('slug', $slug)
            ->with('packages')
            ->where('is_published', true)
            ->firstOrFail();
        
        $company = Company::getSettings();
        
        // Get packages from database or JSON
        $packagesFromDB = $consultant->packages->count() > 0;
        $packages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? []);
        
        // Get booking data from query parameters
        $packageIndex = $request->get('package', 0);
        $bookingDate = $request->get('date');
        $bookingTime = $request->get('time');
        
        // Get selected package
        if (count($packages) > 0) {
            $selectedPackage = $packages[$packageIndex] ?? $packages[0];
        } else {
            abort(404, 'No consultation packages available');
        }
        
        return view('frontend.booking.details', compact('consultant', 'company', 'selectedPackage', 'bookingDate', 'bookingTime', 'packagesFromDB'));
    }
    
    public function invoice($slug, Request $request)
    {
        $consultant = Consultant::where('slug', $slug)
            ->with('packages')
            ->where('is_published', true)
            ->firstOrFail();
        
        $validated = $request->validate([
            'package' => 'required|integer',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);
        
        $company = Company::getSettings();
        
        // Get packages from database or JSON
        $packagesFromDB = $consultant->packages->count() > 0;
        $packages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? []);
        
        $packageIndex = $validated['package'];
        $selectedPackage = $packages[$packageIndex] ?? $packages[0];
        
        // Store data in session for invoice page
        session([
            'booking_data' => $validated,
            'consultant_slug' => $slug,
            'package_index' => $packageIndex,
            'packages_from_db' => $packagesFromDB
        ]);
        
        return view('frontend.booking.invoice', compact('consultant', 'company', 'selectedPackage', 'validated', 'packagesFromDB'));
    }
    
    public function store(Request $request, $slug)
    {
        $consultant = Consultant::where('slug', $slug)
            ->with('packages')
            ->where('is_published', true)
            ->firstOrFail();
        
        // Get data from session
        $bookingData = session('booking_data');
        $packageIndex = session('package_index');
        $packagesFromDB = session('packages_from_db', false);
        
        if (!$bookingData) {
            return redirect()->route('consultant.show', $slug)
                ->with('error', 'Session expired. Please try again.');
        }
        
        // Get packages from database or JSON
        $packages = $packagesFromDB ? $consultant->packages : ($consultant->consultation_packages ?? []);
        $package = $packages[$packageIndex] ?? $packages[0];
        
        // Extract package data based on source (database object or JSON array)
        if ($packagesFromDB) {
            $packageName = $package->name;
            $packageDuration = $package->duration;
            $packagePrice = $package->price_display;
        } else {
            $packageName = $package['name'];
            $packageDuration = $package['duration'];
            $packagePrice = $package['price_display'];
        }
        
        $booking = ConsultantBooking::create([
            'consultant_id' => $consultant->id,
            'package_name' => $packageName,
            'duration' => $packageDuration,
            'price' => $packagePrice,
            'booking_date' => $bookingData['booking_date'],
            'booking_time' => $bookingData['booking_time'],
            'full_name' => $bookingData['full_name'],
            'email' => $bookingData['email'],
            'phone' => $bookingData['phone'],
            'company' => $bookingData['company'] ?? null,
            'notes' => $bookingData['notes'] ?? null,
            'status' => 'pending',
        ]);
        
        // Clear session
        session()->forget(['booking_data', 'consultant_slug', 'package_index', 'packages_from_db']);
        
        return redirect()->route('booking.confirmation', $booking->id)
            ->with('success', 'Booking berhasil! Kami akan menghubungi Anda segera.');
    }
    
    public function confirmation($id)
    {
        $booking = ConsultantBooking::with('consultant')->findOrFail($id);
        $company = Company::getSettings();
        
        return view('frontend.booking.confirmation', compact('booking', 'company'));
    }
}
