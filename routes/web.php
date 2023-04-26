<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CamisetaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'showHomeStats'])->middleware(['auth', 'verified'])->name('home');
Route::get('/home', [HomeController::class, 'showHomeStats'])->middleware(['auth', 'verified'])->name('home');

// Rutas clientes
Route::get('/clientes',  [ClienteController::class, 'index'])->middleware(['auth', 'verified']);

// Rutas camisetas
Route::get('/camisetas',  [CamisetaController::class, 'index'])->middleware(['auth', 'verified'])->name('camisetas');
Route::get('/camisetas/nuevo', [CamisetaController::class, 'create'])->middleware(['auth', 'verified'])->name('crear_camiseta');

// Rutas compras y pedidos
Route::get('/compras',  [CompraController::class, 'index'])->middleware(['auth', 'verified'])->name('compras');
Route::get('/compras/{id}',  [CompraController::class, 'show'])->middleware(['auth', 'verified']);

// Rutas perfil/auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
