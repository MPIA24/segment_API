<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::post('/register',[RegisteredUserController::class,'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/users/count',[AuthenticatedSessionController::class, 'count']);
