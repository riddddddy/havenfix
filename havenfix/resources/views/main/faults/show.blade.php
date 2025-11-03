@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card shadow-sm rounded-4 border-0">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h3 class="mb-0 text-center">Fault Report Details</h3>
                </div>

                <div class="card-body p-4">
                    {{-- Image --}}
                    @if ($fault->image)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $fault->image) }}" alt="Fault Image"
                                class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: contain;">
                        </div>
                    @endif

                    {{-- Item --}}
                    <div class="mb-3">
                        <h6 class="text-muted text-uppercase mb-1">Item</h6>
                        <p class="fs-5 fw-semibold">{{ $fault->item }}</p>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <h6 class="text-muted text-uppercase mb-1">Description</h6>
                        <p class="fs-6">{{ $fault->description }}</p>
                    </div>

                    <div class="row g-3">
                        {{-- Block --}}
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase mb-1">Block</h6>
                            <p class="mb-0 fs-6 fw-medium">{{ $fault->block ?? '-' }}</p>
                        </div>

                        {{-- Level --}}
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase mb-1">Level</h6>
                            <p class="mb-0 fs-6 fw-medium">{{ $fault->level ?? '-' }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase mb-1">Status</h6>
                            <span class="badge
                                {{ $fault->status === 'Pending' ? 'bg-warning text-dark' : '' }}
                                {{ $fault->status === 'In Process' ? 'bg-info text-white' : '' }}
                                {{ $fault->status === 'Completed' ? 'bg-success' : '' }}
                            ">
                                {{ $fault->status }}
                            </span>
                        </div>

                        {{-- Reported By --}}
                        <div class="col-6">
                            <h6 class="text-muted text-uppercase mb-1">Reported By</h6>
                            <p class="mb-0 fs-6 fw-medium">{{ $fault->user->first_name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center border-0 bg-white">
                    <a href="{{ route('faults.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        ← Back to Fault List
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
