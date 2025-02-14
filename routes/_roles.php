<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'roles',
    'as' => 'api.roles',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('/{roleId}', [RoleController::class, 'show'])->name('show');
    Route::put('/{roleId}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{roleId}', [RoleController::class, 'destroy'])->name('destroy');
});
