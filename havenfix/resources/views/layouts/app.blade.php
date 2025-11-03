<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HavenFix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- bootstrap icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



</head>

<body style="background-color:#fefae0";>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg bg-dark sticky-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-white" href="{{ route('/') }}">HavenFix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-1 rounded {{ request()->is('/') ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                            href="{{ route('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-1 rounded {{ request()->is('about') ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                            href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-1 rounded {{ request()->is('contact-us') ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                            href="{{ route('contact-us') }}">Contact Us</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link px-3 py-1 rounded {{ request()->is('faults') ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                                href="{{ route('faults.index') }}">Faults List</a>
                        </li>
                    @endauth


                </ul>

                @guest
                    <div class="d-flex">
                        <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-light text-dark" href="{{ route('register.create') }}">Register</a>
                    </div>
                @endguest

                @auth
                    <div class="d-flex align-items-center">

                        <div>
                            <img class="me-2" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;"
                                src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                alt="{{ auth()->user()->first_name }}">

                        </div>
                        <div class="text-white me-2">Hello, {{ ucfirst(auth()->user()->first_name) }}!</div>

                        @if (auth()->user()->role_id === 1)
                            {
                            <a class="me-2 nav-link px-3 py-1 rounded {{ request()->is('user/' . auth()->user()->id) ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                                href="{{ route('user.show', auth()->user()) }}">My Dashboard</a>
                            }
                        @endif

                        @if (auth()->user()->role_id === 3)
                            {
                            <a class="me-2 nav-link px-3 py-1 rounded {{ request()->is('user/' . auth()->user()->id) ? 'bg-light text-dark fw-semibold' : 'text-white' }}"
                                href="{{ route('user.show', auth()->user()) }}">Admin Dashboard</a>
                            }
                        @endif

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="btn btn-secondary">Logout</button>
                        </form>
                    </div>
                @endauth


            </div>
        </div>
    </nav>




    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>

    @yield('modals')

    @yield('js')



</body>

</html>
