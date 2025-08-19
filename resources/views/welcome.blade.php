<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel Collective Form')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="antialiased d-flex flex-column min-vh-100">
    <header class="text-center">
        <h5>Laravel Collective Form</h5>
    </header>

    <main class="flex-grow-1" style="padding:20px;">
        @yield('content')
    </main>

    <footer class="text-center bg-light">
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
