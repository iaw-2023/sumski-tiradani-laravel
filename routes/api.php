<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CamisetaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIClienteController;
use App\Http\Controllers\APICamisetaController;
use App\Http\Controllers\APICategoriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Camisetas
 */
Route::apiResource('/camisetas', APICamisetaController::class);

/**
 * Clientes
 */
//Route::apiResource('/camisetas', CamisetaController::class)->middleware(['auth', 'verified'])->name('*','camisetas');
//Route::get('/clientes', [APIClienteController::class, 'index']);
Route::apiResource('/clientes', APIClienteController::class);

/**
 * Categorias
 */
Route::apiResource('/categorias', APICategoriaController::class);



