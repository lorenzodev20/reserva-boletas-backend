<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [LoginController::class, 'login']);

Route::apiResource('v1/customers', App\Http\Controllers\Api\V1\CustomerController::class)
    ->only('index', 'show', 'destroy')
    ->middleware('auth:sanctum');

Route::apiResource('v1/tickets', App\Http\Controllers\Api\V1\TicketController::class)
    ->only('index', 'show', 'destroy')
    ->middleware('auth:sanctum');

Route::apiResource('v1/reservations', App\Http\Controllers\Api\V1\ReservationController::class)
    ->only('index');
