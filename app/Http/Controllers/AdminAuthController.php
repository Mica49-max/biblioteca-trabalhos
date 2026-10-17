<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminAuthController extends Controller
{
    public function showLogin(Request $request)
    {
        if ($request->session()->get('is_admin')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $username = (string) config('admin.username');
        $hash = (string) config('admin.password_hash');

        $userOk = $username !== '' && hash_equals($username, $data['username']);

        try {
            $passOk = $hash !== '' && Hash::check($data['password'], $hash);
        } catch (RuntimeException) {
            $passOk = false; // hash mal copiado para o .env
        }

        if ($userOk && $passOk) {
            $request->session()->regenerate();
            $request->session()->put('is_admin', true);

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors(['username' => 'Utilizador ou palavra-passe incorretos.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('projects.index');
    }
}