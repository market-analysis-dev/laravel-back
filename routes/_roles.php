<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{roleId}', [RoleController::class, 'show']);
    Route::put('/{roleId}', [RoleController::class, 'update']);
    Route::delete('/{roleId}', [RoleController::class, 'destroy']);
});