@extends('layouts.admin')

@section('title', 'Consultant Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Consultant Details</h2>
                <div>
                    <a href="{{ route('admin.consultants.edit', $consultant) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.consultants.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Avatar</h5>
                        </div>
                        <div class="card-body text-center">
                            @if($consultant->avatar)
                                <img src="{{ asset('storage/' . $consultant->avatar) }}" 
                                     alt="{{ $consultant->name }}" 
                                     class="img-fluid rounded"
                                     style="max-width: 100%;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 300px;">
                                    <i class="bi bi-person" style="font-size: 5rem; color: #ccc;"></i>
                                </div>
                                <p class="text-muted mt-3">No avatar uploaded</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Status</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Publication Status:</strong><br>
                                @if($consultant->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <strong>Created:</strong><br>
                                {{ $consultant->created_at->format('M d, Y H:i') }}
                            </div>
                            <div>
                                <strong>Last Updated:</strong><br>
                                {{ $consultant->updated_at->format('M d, Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Consultant Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="text-muted small">NAME</label>
                                <h4>{{ $consultant->name }}</h4>
                            </div>

                            <div class="mb-4">
                                <label class="text-muted small">SLUG</label>
                                <p class="mb-0">
                                    <code>{{ $consultant->slug }}</code>
                                    @if($consultant->is_published)
                                        <a href="{{ route('consultant.show', $consultant->slug) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-primary ms-2">
                                            <i class="bi bi-box-arrow-up-right"></i> View Profile
                                        </a>
                                    @endif
                                </p>
                            </div>

                            @if($consultant->title)
                                <div class="mb-4">
                                    <label class="text-muted small">TITLE/POSITION</label>
                                    <p class="mb-0">{{ $consultant->title }}</p>
                                </div>
                            @endif

                            @if($consultant->company)
                                <div class="mb-4">
                                    <label class="text-muted small">COMPANY</label>
                                    <p class="mb-0">{{ $consultant->company }}</p>
                                </div>
                            @endif

                            @if($consultant->price_text)
                                <div class="mb-4">
                                    <label class="text-muted small">PRICE</label>
                                    <p class="mb-0">{{ $consultant->price_text }}</p>
                                </div>
                            @endif

                            @if($consultant->bio)
                                <div class="mb-4">
                                    <label class="text-muted small">BIO</label>
                                    <div class="border-start border-3 ps-3">
                                        {!! nl2br(e($consultant->bio)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Danger Zone</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Once you delete this consultant, there is no going back. Please be certain.</p>
                            <form method="POST" 
                                  action="{{ route('admin.consultants.destroy', $consultant) }}"
                                  onsubmit="return confirm('Are you absolutely sure you want to delete this consultant? This action cannot be undone!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-2"></i>Delete This Consultant
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
