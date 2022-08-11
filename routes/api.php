<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiseaseController;




Route::resource('users', UserController::class)
    ->except('index');

Route::post('auth', [AuthController::class, 'auth']);


Route::resource('diseases', DiseaseController::class)
    ->middleware('auth:sanctum');
