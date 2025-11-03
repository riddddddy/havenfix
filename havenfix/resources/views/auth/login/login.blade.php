@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body py-4 px-4">
                        <h4 class="text-center mb-4">Login</h4>

                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100">Login</button>
                        </form>

                        <p class="mt-3 text-center">Don't have an account? <a href="{{ route('register.create') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection