@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- @if (session('message'))
            <div class=" text-center alert alert-success">
                {{ session('message') }}
            </div>
        @endif --}}
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ auth()->user()->profile_picture
                                ? (Str::startsWith(auth()->user()->profile_picture, 'profile_pictures/')
                                    ? asset('storage/' . auth()->user()->profile_picture)
                                    : asset(auth()->user()->profile_picture))
                                : asset('images/avatar.png') }}"
                                alt="Profile picture" class="rounded-circle me-3"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <h4 class="mb-1">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                                <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-outline-dark rounded-pill">Edit
                                    Profile</a>

                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">About</h5>
                        <p class="text-muted">You can add user-specific bio, address, or other profile information here.</p>
                        <div>
                            <strong>Role</strong>: {{ ucfirst(auth()->user()->role->type) }}
                        </div>
                        @if (auth()->user()->role->type === 'user')
                            <div>
                                <strong>Total number of faults reported</strong>: {{ $countFaults }}
                            </div>
                        @endif

                        @if (auth()->user()->role->type === 'admin')
                            <div>
                                <div>
                                    <strong>Pending faults: </strong> {{ $pendingFaultsCount }}
                                </div>
                                <div>
                                    <strong>Total fault reported for the month:</strong> {{ $faultsMonthCount }}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if (auth()->user()->role_id === 1)
            <div class="mt-5 mb-3">
                <h3 class="mb-3">My Recent Fault Reports</h3>
                @if ($faultsReported->count() > 0)
                    @foreach ($faultsReported as $fault)
                        <div class="list-group-item list-group-item-action mb-3 rounded-4 shadow-sm p-3 d-flex text-dark position-relative"
                            style="background-color: white">

                            {{-- Dropdown positioned top-right --}}
                            <div class="dropdown position-absolute top-0 end-0 m-2">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ route('faults.edit', $fault) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ route('faults.show', $fault) }}"><i class="bi bi-eye"></i> View</a>
                                    </li>
                                    {{-- <li>
                                        <form action="{{ route('faults.destroy', $fault) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this fault?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center gap-2 text-danger w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </li> --}}

                                </ul>
                            </div>

                            @if ($fault->image)
                                <img src="{{ asset('storage/' . $fault->image) }}" alt="Fault Image" class="rounded-3 me-4"
                                    style="width: 200px; height: 150px; object-fit: cover; flex-shrink: 0;">
                            @endif

                            <div>
                                <h4 class="text-primary">{{ $fault->item }}</h4>
                                <label for="">Location</label>
                                <p class="mb-1"><strong>Block {{ $fault->block }} Level {{ $fault->level }}</strong></p>
                                <label class="mt-1" for="">Description:</label>
                                <p class="mb-2"><strong>{{ $fault->description }}</strong></p>
                                <label class="mt-1" for="">Status:</label>
                                <p class="mb-2"><strong>{{ $fault->status }}</strong></p>
                                <small>
                                    Reported by: {{ $fault->user->first_name }} |
                                    {{ $fault->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>No faults have been reported.</div>
                @endif
            </div>
        @endif

        @if (auth()->user()->role_id === 3)
            <div class="mt-5 mb-3">
                <h3 class="mb-3">All Fault Reports</h3>
                @if ($allFaultsReported->count() > 0)
                    @foreach ($allFaultsReported as $fault)
                        <div class="list-group-item list-group-item-action mb-3 rounded-4 shadow-sm p-3 d-flex text-dark position-relative"
                            style="background-color: white">

                            {{-- Dropdown positioned top-right --}}
                            <div class="dropdown position-absolute top-0 end-0 m-2">
                                <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"
                                    style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ route('faults.edit', $fault) }}">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item d-flex align-items-center gap-2"
                                            href="{{ route('faults.show', $fault) }}">
                                            <i class="bi bi-eye"></i>
                                            View
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('work-summary.create', ['fault_id' => $fault->id]) }}">
                                            <i class="bi bi-wrench"></i>Create Work Summary
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('faults.destroy', $fault) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this fault?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center gap-2 text-danger w-100">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            @if ($fault->image)
                                <img src="{{ asset('storage/' . $fault->image) }}" alt="Fault Image" class="rounded-3 me-4"
                                    style="width: 200px; height: 150px; object-fit: cover; flex-shrink: 0;">
                            @endif

                            <div>
                                <h4 class="text-primary"><a class="" style="text-decoration: none"
                                        href="{{ route('faults.show', $fault) }}">{{ $fault->item }}</a></h4>
                                <label for="">Location</label>
                                <p class="mb-1"><strong>Block {{ $fault->block }} Level {{ $fault->level }}</strong></p>
                                <label class="mt-1" for="">Description:</label>
                                <p class="mb-2"><strong>{{ $fault->description }}</strong></p>
                                <label class="mt-1" for="">Status:</label>
                                <p class="mb-2"><strong>{{ $fault->status }}</strong></p>
                                <small>
                                    Reported by: {{ $fault->user->first_name }} |
                                    {{ $fault->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>No faults have been reported.</div>
                @endif
            </div>
        @endif

    </div>
@endsection

@section('js')
    <script>
        $(function() {


        })
    </script>
@endsection
