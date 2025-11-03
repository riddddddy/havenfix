@extends('layouts.app')

@section('content')
    <div class="container my-5" style="max-width: 800px;">
        <h2 class="mb-4">Create Work Summary</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>There were some issues with your input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('work-summary.store') }}" method="POST">
            @csrf

            {{-- Item --}}
            <div class="mb-3">
                <label for="item" class="form-label">Item</label>
                <input type="text" class="form-control" id="item" name="item" value="{{$fault->item}}" disabled>
            </div>

            {{-- Fault id --}}
            <div>
                <input type="hidden" name="fault_id" value="{{$fault->id}}">
            </div>

            {{-- Remarks --}}
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="4" required></textarea>
            </div>

            {{-- Date --}}
            <div class="mb-3">
                <label for="work_date" class="form-label">Date</label>
                <input type="date" class="form-control" id="work_date" name="work_date" value="{{now()->format('Y-m-d')}}"  required disabled>
            </div>

            {{-- Submit --}}
            <div class="d-flex justify-content-end">
                <a href="{{ route('work-summary.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
