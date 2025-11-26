<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thibitisha Website')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Thibitisha</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            @auth
            <div class="col-md-2 bg-light vh-100 p-3 border-end">
                <h5 class="mb-4">Menu</h5>
                <ul class="nav flex-column">

                    <li class="nav-item"><a class="nav-link" href="{{ route('doctors.index') }}">Doctors</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>

                </ul>
            </div>
            @endauth

            <!-- Main Content -->
            <div class="@auth col-md-10 @else col-md-12 @endauth p-4">
                @yield('content')
            </div>

        </div>
    </div>

</body>
</html>
