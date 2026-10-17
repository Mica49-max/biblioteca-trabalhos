@extends('layouts.admin')

@section('title', 'Entrar')

@section('content')
    <div class="login-box">
        <h1>Entrar</h1>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="form">
            @csrf

            <label for="username">Utilizador</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}"
                   autocomplete="username" required autofocus>

            <label for="password">Palavra-passe</label>
            <input type="password" id="password" name="password"
                   autocomplete="current-password" required>

            @if ($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <button type="submit" class="btn btn-block">Entrar</button>
        </form>
    </div>
@endsection