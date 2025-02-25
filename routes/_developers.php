<?php

use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'developers',
    'as' => 'api.developers.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [DeveloperController::class, 'index'])->name('index');
    Route::post('/', [DeveloperController::class, 'store'])->name('store');
    Route::get('/{developer}', [DeveloperController::class, 'show'])->name('show');
    Route::put('/{developer}', [DeveloperController::class, 'update'])->name('update');
    Route::delete('/{developer}', [DeveloperController::class, 'destroy'])->name('destroy');
});
