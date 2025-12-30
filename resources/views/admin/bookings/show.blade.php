@extends('layouts.admin')

@section('title', 'Booking Detail')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm mb-2">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
            <h1 class="h3 mb-0">Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</h1>
        </div>
        <div>
            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this booking?')"
                  class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-1"></i> Delete Booking
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Left Column: Booking Details -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Full Name</label>
                            <p class="fw-bold mb-0">{{ $booking->full_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Email</label>
                            <p class="mb-0">
                                <i class="bi bi-envelope me-1"></i>
                                <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Phone</label>
                            <p class="mb-0">
                                <i class="bi bi-telephone me-1"></i>
                                <a href="tel:{{ $booking->phone }}">{{ $booking->phone }}</a>
                            </p>
                        </div>
                        @if($booking->company)
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Company</label>
                            <p class="mb-0">{{ $booking->company }}</p>
                        </div>
                        @endif
                    </div>
                    
                    @if($booking->notes)
                    <div class="mt-3">
                        <label class="text-muted small">Notes</label>
                        <div class="border rounded p-3 bg-light">
                            {{ $booking->notes }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Booking Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Consultant</label>
                            <div class="d-flex align-items-center">
                                @if($booking->consultant->avatar)
                                    <img src="{{ asset('storage/' . $booking->consultant->avatar) }}" 
                                         alt="{{ $booking->consultant->name }}" 
                                         class="rounded-circle me-3"
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @endif
                                <div>
                                    <p class="fw-bold mb-0">{{ $booking->consultant->name }}</p>
                                    <small class="text-muted">{{ $booking->consultant->title }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Package</label>
                            <p class="fw-bold mb-0">{{ $booking->package_name }}</p>
                            <small class="text-muted">Duration: {{ $booking->duration }}</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Date</label>
                            <p class="mb-0">
                                <i class="bi bi-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, d F Y') }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Time</label>
                            <p class="mb-0">
                                <i class="bi bi-clock me-1"></i>
                                {{ $booking->booking_time }} WIB
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Price</label>
                            <p class="fw-bold text-success mb-0" style="font-size: 1.2rem;">{{ $booking->price }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small">Booking Created</label>
                            <p class="mb-0">{{ $booking->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    
                    @if($booking->meeting_url)
                    <div class="mt-3">
                        <label class="text-muted small">Meeting URL</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $booking->meeting_url }}" readonly>
                            <a href="{{ $booking->meeting_url }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-box-arrow-up-right"></i> Open
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Status & Actions -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Current Status</label>
                            <div class="p-3 rounded text-center" style="background: #f8f9fa;">
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark fs-6">
                                        <i class="bi bi-clock-history me-1"></i>Pending
                                    </span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="badge bg-success fs-6">
                                        <i class="bi bi-check-circle me-1"></i>Confirmed
                                    </span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge bg-primary fs-6">
                                        <i class="bi bi-check-all me-1"></i>Completed
                                    </span>
                                @else
                                    <span class="badge bg-danger fs-6">
                                        <i class="bi bi-x-circle me-1"></i>Cancelled
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Change Status To</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Meeting URL</label>
                            <input type="url" 
                                   name="meeting_url" 
                                   class="form-control" 
                                   placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                   value="{{ old('meeting_url', $booking->meeting_url) }}">
                            <small class="text-muted">Add Google Meet, Zoom, or other meeting link</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <i class="bi bi-plus-circle text-primary"></i>
                            <div>
                                <strong>Booking Created</strong>
                                <br>
                                <small class="text-muted">{{ $booking->created_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                        
                        @if($booking->updated_at != $booking->created_at)
                        <div class="timeline-item">
                            <i class="bi bi-pencil-square text-info"></i>
                            <div>
                                <strong>Last Updated</strong>
                                <br>
                                <small class="text-muted">{{ $booking->updated_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                        @endif
                        
                        <div class="timeline-item">
                            <i class="bi bi-calendar-event text-success"></i>
                            <div>
                                <strong>Scheduled Date</strong>
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }} at {{ $booking->booking_time }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 20px;
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-item i {
    font-size: 1.3rem;
    flex-shrink: 0;
}
</style>
@endsection
