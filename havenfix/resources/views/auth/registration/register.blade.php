@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4">Create an Account</h4>

                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name*</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{old('first_name')}}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Last Name*</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name')}}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address*</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password*</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark w-100">Register</button>
                        </form>

                        <p class="mt-3 text-center">Already have an account? <a href="#">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
