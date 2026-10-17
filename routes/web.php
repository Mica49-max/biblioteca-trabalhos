<?php

use App\Http\Controllers\PublicProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicProjectController::class, 'index'])->name('projects.index');
Route::get('/projetos/{project}', [PublicProjectController::class, 'show'])->name('projects.show');