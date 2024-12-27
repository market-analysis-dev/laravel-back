<?php

use App\Http\Controllers\BuilderController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'builder',
    'as' => 'api.builder.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [BuilderController::class, 'index'])->name('listBuilders');
    Route::post('/', [BuilderController::class, 'store'])->name('createBuilder');
    Route::put('/{id}', [BuilderController::class, 'update'])->name('updateBuilder');
    Route::delete('/{id}', [BuilderController::class, 'destroy'])->name('deleteBuilder');
});
