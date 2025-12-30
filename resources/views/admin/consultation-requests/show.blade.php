@extends('layouts.admin')

@section('title', 'Consultation Request Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Consultation Request #{{ $consultationRequest->id }}</h3>
                    <div>
                        <a href="{{ route('admin.consultation-requests.index') }}" class="btn btn-secondary">
                            Back to List
                        </a>
                        <form action="{{ route('admin.consultation-requests.destroy', $consultationRequest) }}" 
                              method="POST" 
                              class="d-inline ms-2"
                              onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Delete Request
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Personal Information -->
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-user me-2"></i>
                                        Personal Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="fw-bold" style="width: 140px;">Full Name:</td>
                                            <td>{{ $consultationRequest->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Position:</td>
                                            <td>{{ $consultationRequest->position }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Email:</td>
                                            <td>
                                                <a href="mailto:{{ $consultationRequest->email }}" class="text-decoration-none">
                                                    {{ $consultationRequest->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Phone:</td>
                                            <td>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $consultationRequest->phone) }}" 
                                                   target="_blank" 
                                                   class="text-decoration-none">
                                                    {{ $consultationRequest->phone }}
                                                    <i class="fab fa-whatsapp text-success ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Company:</td>
                                            <td>{{ $consultationRequest->company_name }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Service Information -->
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-briefcase me-2"></i>
                                        Service Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="fw-bold" style="width: 180px;">Service Needs:</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $consultationRequest->service_needs }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Implementation Time:</td>
                                            <td>
                                                <span class="badge bg-info">{{ $consultationRequest->estimated_implementation_time }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Submitted:</td>
                                            <td>
                                                {{ $consultationRequest->created_at->format('l, d F Y') }}<br>
                                                <small class="text-muted">{{ $consultationRequest->created_at->format('H:i') }} WIB</small>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Scope Details -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-file-alt me-2"></i>
                                        Scope Details
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $consultationRequest->scope_details }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-rocket me-2"></i>
                                        Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <a href="mailto:{{ $consultationRequest->email }}?subject=Re: Consultation Request - {{ $consultationRequest->company_name }}&body=Dear {{ $consultationRequest->full_name }},%0D%0A%0D%0AThank you for your consultation request. We have reviewed your requirements and would like to discuss your project further.%0D%0A%0D%0ABest regards,%0D%0A{{ config('app.name') }} Team" 
                                               class="btn btn-primary w-100">
                                                <i class="fas fa-envelope me-2"></i>
                                                Send Email
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $consultationRequest->phone) }}?text=Hello {{ $consultationRequest->full_name }}, thank you for your consultation request. We would like to discuss your project requirements further." 
                                               target="_blank" 
                                               class="btn btn-success w-100">
                                                <i class="fab fa-whatsapp me-2"></i>
                                                WhatsApp
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <button type="button" 
                                                    class="btn btn-info w-100" 
                                                    onclick="window.print()">
                                                <i class="fas fa-print me-2"></i>
                                                Print Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        .card-header .btn,
        .card .btn {
            display: none !important;
        }
        
        .card {
            border: none !important;
            box-shadow: none !important;
        }
        
        .bg-light {
            background-color: #f8f9fa !important;
        }
    }
    
    .table td {
        padding: 0.5rem 0.75rem;
        border: none;
    }
</style>
@endpush