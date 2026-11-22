<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get('/movies/filter/{genre?}', function ($genre = null) {
    if ($genre) {
        return redirect()->route('movies.index', ['genre' => $genre]);
    }
    return redirect()->route('movies.index');
});

Route::resource('movies', MoviesController::class)
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register',  [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login',   [LoginController::class, 'create'])->name('login');
Route::post('/login',  [loginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');



