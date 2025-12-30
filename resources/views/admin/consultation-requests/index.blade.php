@extends('layouts.admin')

@section('title', 'Consultation Requests')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Consultation Requests</h3>
                    <span class="badge bg-primary">{{ $consultationRequests->total() }} Total</span>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($consultationRequests->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Service Needs</th>
                                        <th>Submitted At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($consultationRequests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>
                                                <strong>{{ $request->full_name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $request->position }}</small>
                                            </td>
                                            <td>{{ $request->company_name }}</td>
                                            <td>
                                                <a href="mailto:{{ $request->email }}" class="text-decoration-none">
                                                    {{ $request->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $request->phone) }}" target="_blank" class="text-decoration-none">
                                                    {{ $request->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $request->service_needs }}</span>
                                            </td>
                                            <td>
                                                <small>
                                                    {{ $request->created_at->format('d M Y') }}<br>
                                                    {{ $request->created_at->format('H:i') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.consultation-requests.show', $request) }}" 
                                                       class="btn btn-sm btn-primary">
                                                        View Details
                                                    </a>
                                                    <form action="{{ route('admin.consultation-requests.destroy', $request) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this request?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $consultationRequests->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No consultation requests found</h5>
                            <p class="text-muted">Consultation requests will appear here once submitted.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .table td {
        vertical-align: middle;
        font-size: 0.9rem;
    }
    
    .btn-group .btn {
        border-radius: 0;
    }
    
    .btn-group .btn:first-child {
        border-radius: 0.375rem 0 0 0.375rem;
    }
    
    .btn-group .btn:last-child {
        border-radius: 0 0.375rem 0.375rem 0;
    }
</style>
@endpush