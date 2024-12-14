<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Preloved')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase" href="{{ url('/') }}">CHERISHED</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Wanita</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pria</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Branded</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Anak</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="#">Sale</a></li>
                    @guest
                        <li class="nav-item"><a class="btn btn-outline-dark ms-3" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn btn-dark ms-2" href="{{ route('register') }}">Sign up</a></li>
                    @else
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p class="mb-0">© 2024 Preloved. All rights reserved.</p>
        </div>
    </footer>

</body>


</html>
