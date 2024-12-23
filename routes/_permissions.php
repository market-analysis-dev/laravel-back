<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'permissions',
    'as' => 'api.permissions',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
});