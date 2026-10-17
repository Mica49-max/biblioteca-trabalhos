<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Área privada') · Biblioteca de Trabalhos</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    @if (session('is_admin'))
        <nav class="admin-bar">
            <div class="container admin-bar-inner">
                <strong>Área privada</strong>
                <div class="admin-bar-links">
                    <a href="{{ route('projects.index') }}" target="_blank" rel="noopener">Ver site ↗</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="link-button">Sair</button>
                    </form>
                </div>
            </div>
        </nav>
    @endif

    <main class="container">
        @yield('content')
    </main>
</body>
</html>