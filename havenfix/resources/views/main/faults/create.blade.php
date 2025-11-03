@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4">Report a Fault</h4>

                        <form action="{{ route('faults.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="item" class="form-label">Item*</label>
                                <input type="text" name="item" id="item" class="form-control"
                                    value="{{ old('item') }}" required>
                                @error('item')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Fault Image*</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description*</label>
                                <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label for="location" class="form-label">Location*</label>
                                <input type="text" name="location" id="location" class="form-control"
                                    value="{{ old('location') }}" required>
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="block" class="form-label">Block</label>
                                    <select name="block" id="block" class="form-select">
                                        <option value="">-- Select Block --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="level" class="form-label">Level</label>
                                    <select name="level" id="level" class="form-select">
                                        <option value="">-- Select Level --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

                                    </select>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary w-100">Submit Fault Report</button>
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
