<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\ReservationController;

Route::post('login', [LoginController::class, 'login']);

Route::prefix('v1/customers')->group(function () {
    Route::get('get-list',[CustomerController::class,'getList']);
});

Route::apiResource('v1/customers', CustomerController::class)
    ->only('index', 'store', 'show', 'update', 'destroy');
    //->middleware('auth:sanctum');

Route::prefix('v1/tickets')->group(function () {
    Route::get('get-list',[TicketController::class,'getList']);
});

Route::apiResource('v1/tickets', TicketController::class)
    ->only('index', 'store', 'show', 'update', 'destroy');
    //->middleware('auth:sanctum');


Route::apiResource('v1/reservations', ReservationController::class)
    ->only('index','store','show', 'update', 'destroy');
