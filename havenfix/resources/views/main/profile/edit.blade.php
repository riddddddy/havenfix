@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0 rounded-4">
                    <div class="card-body p-5">
                        <h4 class="text-center mb-4">Edit Profile</h4>

                        <div class="d-flex justify-content-center align-items-center mb-4">
                            @if ($user->profile_picture)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                        class="img-thumbnail" style="width: 100px;">
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                        value="{{ old('first_name', $user->first_name) }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        value="{{ old('last_name', $user->last_name) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" class="form-control">

                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" disabled readonly>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password <small class="text-muted">(leave blank
                                        to keep current)</small></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                        </form>

                        <p class="mt-3 text-center">
                            <a href="#">← Back to Dashboard</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
