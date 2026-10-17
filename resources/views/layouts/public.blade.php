<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Biblioteca de Trabalhos')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <main class="container">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">© {{ date('Y') }} · Mica</div>
    </footer>
</body>
</html>