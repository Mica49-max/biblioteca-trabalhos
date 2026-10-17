<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PublicProjectController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

// ---------- Parte pública ----------
Route::get('/', [PublicProjectController::class, 'index'])->name('projects.index');
Route::get('/projetos/{project}', [PublicProjectController::class, 'show'])->name('projects.show');

// ---------- Área privada (endereço secreto vem do .env) ----------
$adminPath = trim((string) config('admin.path'), '/');

if ($adminPath !== '') {
    Route::prefix($adminPath)->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])
            ->middleware('throttle:5,1')
            ->name('admin.login.submit');

        Route::middleware(EnsureAdmin::class)->group(function () {
            Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
            Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
        });
    });
}