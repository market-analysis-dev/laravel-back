<?php

use App\Http\Controllers\FiberController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'fibers',
    'as' => 'api.fibers',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [FiberController::class, 'index'])->name('index');
    Route::post('/', [FiberController::class, 'store'])->name('store');
    Route::put('/{fiber}', [FiberController::class, 'update'])->name('update');
    Route::delete('/{fiber}', [FiberController::class, 'destroy'])->name('destroy');
});
