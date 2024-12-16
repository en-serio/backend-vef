<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registroCtrl;
use App\Http\Controllers\dashboardCtrl;
use App\Http\Controllers\loginCtrl;
use App\Http\Controllers\perfilCtrl;
use App\Http\Controllers\settingsCtrl;
use App\Http\Controllers\transferCtrl;
use App\Http\Controllers\vehiculoCtrl;
use TransferCtrl as GlobalTransferCtrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Vistas específicas
Route::get('/gestion-transfers', function () {
    return view('gestionTransfers');
})->name('gestionTransfers');

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/conductor', function () {
    return view('conductor');
})->name('conductor');

Route::get('/hotel', function () {
    return view('hotel');
})->name('hotel');

Route::get('/estadisticas', function () {
    return view('precios');
})->name('estadisticas');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/gestion-transfers', [TransferCtrl::class, 'gestionTransfers'])->name('transfer.gestionTransfers');




//RUTAS DE LOS CONTROLADORES
Route::get('/login', [loginCtrl::class, 'index'])->name('login');
Route::get('/logout', [loginCtrl::class, 'logout'])->name('logout');
Route::get('/dashboard', [dashboardCtrl::class, 'index'])->name('dashboard');
Route::get('/perfil', [perfilCtrl::class, 'index'])->name('perfil');


Route::post('/register', [RegistroCtrl::class, 'procesaPost'])->name('register.post');
Route::post('/login', [LoginCtrl::class, 'procesaPost'])->name('login.post');
Route::post('/perfil/update', [perfilCtrl::class, 'update'])->name('perfil.update');
Route::post('/dashboard/procesa', [dashboardCtrl::class, 'procesaPost'])->name('dashboard.procesa');