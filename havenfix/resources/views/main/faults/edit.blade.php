@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4">Edit Fault Report</h4>

                        <form action="{{ route('faults.update', $fault) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="item" class="form-label">Item*</label>
                                <input type="text" name="item" id="item" class="form-control"
                                    value="{{ old('item', $fault->item) }}" required>
                                @error('item')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Fault Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @if ($fault->image)
                                    <small class="text-muted">Current: <a href="{{ asset('storage/' . $fault->image) }}"
                                            target="_blank">View Image</a></small>
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description*</label>
                                <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $fault->description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="location" class="form-label">Location*</label>
                                <input type="text" name="location" id="location" class="form-control"
                                    value="{{ old('location', $fault->location) }}" required>
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="block" class="form-label">Block</label>
                                    <select name="block" id="block" class="form-select">
                                        <option value="">-- Select Block --</option>
                                        <option value="A" {{ $fault->block === 'A' ? 'selected' : '' }}>
                                            A
                                        </option>
                                        <option value="B" {{ $fault->block === 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ $fault->block === 'C' ? 'selected' : '' }}>C</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="level" class="form-label">Level</label>
                                    <select name="level" id="level" class="form-select">
                                        <option value="">-- Select Level --</option>
                                        <option value="1" {{ $fault->level === 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $fault->level === 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $fault->level === 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $fault->level === 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $fault->level === 5 ? 'selected' : '' }}>5</option>

                                    </select>
                                </div>

                                @if (auth()->user()->role->type === 'admin')
                                    <div class="mb-3 col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select mb-2">
                                            <option value="pending" {{ $fault->status === 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="in process"
                                                {{ $fault->status === 'in process' ? 'selected' : '' }}>
                                                In Process
                                            </option>
                                            <option value="completed"
                                                {{ $fault->status === 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                        </select>
                                    </div>
                                @endif


                            </div>



                            <button type="submit" class="btn btn-primary w-100">Update Fault Report</button>
                        </form>

                        <p class="mt-3 text-center">
                            <a href="{{ route('faults.index') }}">← Back to Fault List</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
