<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APICompraController;
use App\Http\Controllers\APICategoriaController;
use App\Http\Controllers\APICamisetaController;

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

/**
 * Camisetas
 */
Route::get('/camisetas', [APICamisetaController::class, 'getCamisetas']);
Route::get('/camisetas/categoria/{id}', [APICamisetaController::class, 'getCamisetasByCategoria']);

/**
 * Categorias
 */
Route::get('/categorias', [APICategoriaController::class, 'getCategorias']);

/**
 * Cliente/Compras
 */
Route::get('/compras/{email}', [APICompraController::class, 'getComprasByCliente']);
Route::post('/compras/buy', [APICompraController::class, 'createCompra']);