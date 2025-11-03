@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero text-black text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to HavenFix</h1>
            <p class="lead mb-4">Your go-to platform for reporting and resolving building maintenance issues.</p>
            <a href="{{route('faults.create')}}" class="btn btn-light btn-lg">Report a Fault</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5 bg-dark text-white">
        <div class="container text-center">
            <h2 class="display-5 mb-4">How HavenFix Helps You</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-light rounded shadow-sm text-black">
                        <i class="bi bi-clipboard-check fs-1 mb-3"></i>
                        <h3>Easy Fault Reporting</h3>
                        <p>Submit your maintenance issues quickly and easily. Just describe the problem, and our team will take care of the rest.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-light rounded shadow-sm text-black">
                        <i class="bi bi-chat-left-text fs-1 mb-3"></i>
                        <h3>Track Your Requests</h3>
                        <p>Stay updated on the status of your fault report. Receive notifications and communicate directly with the management team.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box p-4 bg-light rounded shadow-sm text-black">
                        <i class="bi bi-person-check fs-1 mb-3"></i>
                        <h3>Resident Interaction</h3>
                        <p>Engage with other residents by commenting on reports, and collaborate to solve common issues in your building.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="display-4 mb-4">Ready to get started?</h2>
            <p class="lead mb-4">Join us today and help improve your living space by reporting faults and issues that matter to you!</p>
            <a href="#" class="btn btn-light btn-lg">Start Reporting</a>
        </div>
    </section>
@endsection
