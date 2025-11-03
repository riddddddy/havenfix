@extends('layouts.app')

@section('content')
    <div class="container my-5" style="max-width: 1000px">

        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center mb-2">
            <h2 class="">Reported Faults</h2>
            <a class="btn btn-dark ms-auto" href={{ route('faults.create') }}>Report a fault</a>
        </div>

        <div class="list-group">
            @forelse ($faults as $fault)
                <div
                    class="list-group-item list-group-item-action mb-3 rounded-4 shadow-sm p-3 d-flex align-items-center text-dark">
                    @if ($fault->image)
                        <img src="{{ asset('storage/' . $fault->image) }}" alt="Fault Image" class="rounded-3 me-4"
                            style="width: 200px; height: 150px; object-fit: cover; flex-shrink: 0;">
                    @endif

                    <div class="">
                        <h4 class="text-primary"><a style="text-decoration-line: none"
                                href="{{ route('faults.show', $fault) }}">{{ $fault->item }}</a></h4>
                        <label for="">Location</label>
                        <p class="mb-1"><strong>Block {{ $fault->block }} Level {{ $fault->level }}</strong></p>
                        <label class="mt-1 " for="">Description:</label>
                        <p class="mb-2" id=""><strong>{{ $fault->description }}</strong></p>
                        <label class="mt-1 " for="">Status:</label>
                        <p class="mb-2" id=""><strong>{{ $fault->status }}</strong></p>

                        <div>
                            <button type="button" class="btn btn-light my-2" data-bs-toggle="modal"
                                data-bs-target="#work-summary-modal-{{ $fault->id }}">
                                Work Summary Details
                            </button>
                        </div>

                        <small class="">
                            Reported by: {{ $fault->user->first_name }} | {{ $fault->created_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No faults reported yet.</p>
            @endforelse
        </div>
    </div>
@endsection

@section('modals')
    @foreach ($faults as $fault)
        @include('main.faults.modals.work-summary')
    @endforeach
@endsection
