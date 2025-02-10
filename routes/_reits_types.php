<?php

use App\Http\Controllers\ReitTypeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reit-types',
    'as' => 'api.reit-types',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitTypeController::class, 'index'])->name('index');
    Route::post('/', [ReitTypeController::class, 'store'])->name('store');
    Route::get('{reitType}', [ReitTypeController::class, 'show'])->name('show');
    Route::put('/{reitType}', [ReitTypeController::class, 'update'])->name('update');
    Route::delete('/{reitType}', [ReitTypeController::class, 'destroy'])->name('destroy');
});
