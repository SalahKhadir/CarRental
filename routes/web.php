<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReservationController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/user', [AuthController::class, 'userInterface'])->name('user');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/managecars', function () {
    return view('managecars');
});
Route::prefix('managecars')->group(function () {
    Route::get('/', [VehicleController::class, 'index'])->name('managecars');
    Route::get('/filter', [VehicleController::class, 'show'])->name('managecars.filter');
    Route::get('/create', [VehicleController::class, 'create'])->name('managecars.create');
    Route::post('/store', [VehicleController::class, 'store'])->name('managecars.store');
    Route::get('/edit/{vehicle}', [VehicleController::class, 'edit'])->name('managecars.edit');
    Route::put('/update/{vehicle}', [VehicleController::class, 'update'])->name('managecars.update');
    Route::delete('/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('managecars.destroy');
});

Route::get('/user', [VehicleController::class, 'ndex'])->name('user'); // Routes to the index method
Route::get('/user/filter', [VehicleController::class, 'how'])->name('user.filter'); // Filter route

Route::get('/reservation/create/{vehicle_id}', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/managereservations', function () {
    return view('managereservations');
});
Route::get('/managereservations', [ReservationController::class, 'index'])->name('managereservations');
Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');


Route::get('/mesreservations', function () {
    return view('mesreservations');
});
Route::get('/mesreservations', [ReservationController::class, 'showReservations'])->name('reservations.index');
