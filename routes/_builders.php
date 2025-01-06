<?php

use App\Http\Controllers\BuilderController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'builder',
    'as' => 'api.builder.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [BuilderController::class, 'index'])->name('index');
    Route::post('/', [BuilderController::class, 'store'])->name('store');
    Route::put('/{builder}', [BuilderController::class, 'update'])->name('update');
    Route::delete('/{builder}', [BuilderController::class, 'destroy'])->name('destroy');
});
