<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\AdminValidation;

Route::resource('users', UserController::class)
    ->except(['store', 'index'])->middleware('auth:sanctum');

Route::get('users', [UserController::class, 'index'])
    ->middleware(['auth:sanctum', AdminValidation::class]);

Route::post('auth', [AuthController::class, 'auth']);

Route::group([
    'prefix' => 'diseases',
    'middleware' => ['auth:sanctum']
], function () {

    Route::get('/', [DiseaseController::class, 'index'])
        ->middleware('auth:sanctum');

    Route::post('/', [DiseaseController::class, 'store'])
        ->middleware('auth:sanctum');

    Route::get('types', [DiseaseController::class, 'getTypes'])
        ->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'notifications',
    'middleware' => ['auth:sanctum', AdminValidation::class]
], function () {

    Route::get('/', [NotificationController::class, 'index']);

    Route::post('/', [NotificationController::class, 'store']);

    Route::get('types', [NotificationController::class, 'getTypes']);
});



Route::group([
    'prefix' => 'reports',
    'middleware' => ['auth:sanctum', AdminValidation::class]
], function () {

    Route::get('/', [DiseaseController::class, 'countDieases']);

    Route::get('/stats', [DiseaseController::class, 'stats']);
});
