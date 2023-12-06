<?php

use App\Http\Controllers\Api\VentasApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/buscar_producto_api/{search}', [VentasApiController::class, 'buscar_producto_api'])->name('buscar_producto_api');
Route::post('/registrar_venta_api', [VentasApiController::class, 'registrar_venta_api'])->name('registrar_venta_api');

