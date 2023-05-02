<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CamisetaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* version todo en clase separadas
Route::apiResource('/camisetas', APICamisetaController::class);
Route::apiResource('/clientes', APIClienteController::class);
Route::apiResource('/categorias', APICategoriaController::class);
*/

/**
 * Camisetas
 */
Route::get('/camisetas', [CamisetaController::class, 'getCamisetasAPI']);
Route::get('/camisetas/{id}', [CamisetaController::class, 'getCamisetasByCategoriaAPI']);

/**
 * Categorias
 */
Route::get('/categorias', [CategoriaController::class, 'getCategoriasAPI']);

/**
 * Cliente/Compras
 */
Route::get('/clientes/{id}', [ClienteController::class, 'getComprasByClienteAPI']);