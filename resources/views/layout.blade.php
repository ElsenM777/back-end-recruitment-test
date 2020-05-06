<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Back-End</title>
    <link rel="stylesheet" href="{{ url('/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/custom.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">Back-End</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @yield('queries')">
                        <a class="nav-link" href="{{ url('') }}"><i class="fas fa-list"></i> Sorğular</a>
                    </li>
                    <li class="nav-item @yield('new-query')">
                        <a class="nav-link" href="{{ url('/new-query') }}"><i class="fas fa-plus text-success"></i> Yeni Sorğu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        @yield('content')
    </div>
    <script src="{{ url('/js/jquery.min.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/custom.js') }}"></script>
</body>
</html>