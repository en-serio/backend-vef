<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ApiController;


Route::get('/producto3', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::redirect('/', '/producto3');

Route::get('producto3/test', function () {
    return "Ruta de prueba funcionando";
});

Route::get('producto3/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('producto3/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('producto3/profile', [ProfileController::class, 'updateN'])->name('profile.update');
    Route::delete('producto3/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('producto3/estadisticas', [DashboardController::class, 'estadisticas'])->middleware(['auth', 'verified'])->name('estadisticas');

Route::get('producto3/transfers', [DashboardController::class, 'gestionTransfers'])->middleware(['auth', 'verified'])->name('transfers');
Route::get('producto3/hoteles', [TransferController::class, 'obtenerHoteles'])->middleware(['auth', 'verified'])->name('hoteles');
Route::get('producto3/hotelesUsuario', [TransferController::class, 'obtenerHotelesUser'])->middleware(['auth', 'verified'])->name('hoteles.usuario');
Route::get('producto3/zonas', [DashboardController::class, 'cargarPrefer'])->middleware(['auth', 'verified'])->name('zonas');
Route::get('producto3/vehiculos', [DashboardController::class, 'vehiculos'])->middleware(['auth', 'verified'])->name('vehiculos');
Route::get('producto3/crearTransfer', [DashboardController::class, 'crearTransfer'])->middleware(['auth', 'verified'])->name('crearTransfer');
Route::get('producto3/debugTransfer', [TransferController::class, 'getReservas'])->middleware(['auth', 'verified'])->name('debug.transfer');
Route::get('producto3/calendario', [DashboardController::class, 'getCalendario'])->middleware(['auth', 'verified'])->name('calendario');
Route::get('producto3/usuarios', [DashboardController::class, 'getUsuarios'])->middleware(['auth', 'verified'])->name('usuarios');


Route::post('producto3/zonas', [TransferController::class, 'nuevaZona'])->middleware(['auth', 'verified'])->name('zonas.store');
Route::put('producto3/zonas', [TransferController::class, 'actualizarZona'])->middleware(['auth', 'verified'])->name('zonas.update');

Route::post('producto3/tipos', [TransferController::class, 'nuevoTipo'])->middleware(['auth', 'verified'])->name('tipos.store');
Route::put('producto3/tipos', [TransferController::class, 'actualizarTipo'])->middleware(['auth', 'verified'])->name('tipos.update');
Route::post('producto3/hoteles', [TransferController::class, 'nuevoHotel'])->middleware(['auth', 'verified'])->name('hoteles.store');
Route::put('producto3/hoteles', [TransferController::class, 'actualizarHotel'])->middleware(['auth', 'verified'])->name('hoteles.update');
Route::post('producto3/hotelesusuario', [TransferController::class, 'nuevoHotelUser'])->middleware(['auth', 'verified'])->name('hotelesuser.store');
Route::put('producto3/hotelesusuario', [TransferController::class, 'actualizarHotelUser'])->middleware(['auth', 'verified'])->name('hotelesuser.update');
Route::post('producto3/vehiculos', [TransferController::class, 'nuevoVehiculo'])->middleware(['auth', 'verified'])->name('vehiculo.store');
Route::put('producto3/vehiculos', [TransferController::class, 'actualizarVehiculo'])->middleware(['auth', 'verified'])->name('vehiculo.update');
Route::post('producto3/usuarios', [TransferController::class, 'nuevoUsuario'])->middleware(['auth', 'verified'])->name('usuarios.store');
Route::put('producto3/usuarios', [TransferController::class, 'actualizarUsuario'])->middleware(['auth', 'verified'])->name('usuarios.update');
Route::put('producto3/transfers', [TransferController::class, 'actualizarTransfer'])->middleware(['auth', 'verified'])->name('transfer.update');

Route::delete('producto3/transfers', [TransferController::class, 'deletearTrans'])->middleware(['auth', 'verified'])->name('transfer.destroy');
Route::delete('producto3/tipos', [TransferController::class, 'deletearTipo'])->middleware(['auth', 'verified'])->name('tipos.destroy');
Route::delete('producto3/zonas', [TransferController::class, 'deletearZona'])->middleware(['auth', 'verified'])->name('zonas.destroy');
Route::delete('producto3/hoteles', [TransferController::class, 'deletearHotel'])->middleware(['auth', 'verified'])->name('hoteles.destroy');
Route::delete('producto3/usuarios', [TransferController::class, 'deletearUsuario'])->middleware(['auth', 'verified'])->name('usuarios.destroy');
Route::delete('producto3/vehiculos', [TransferController::class, 'deletearVehiculo'])->middleware(['auth', 'verified'])->name('vehiculo.destroy');

Route::post('producto3/transfers', [TransferController::class, 'guardarTransfer'])->middleware(['auth', 'verified'])->name('transfer.store');

// API
//Lo pondria en api pero...
Route::prefix('producto3/api')->group(function () {
    Route::get('/estadistica', [ApiController::class, 'getTransfers']);
});
// Route::put('/vehiculos', [TransferController::class, 'actualizarVehiculo'])->middleware(['auth', 'verified'])->name('vehiculos.update');

require __DIR__.'/auth.php';
