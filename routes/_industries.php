<?php

use App\Http\Controllers\IndustryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'industries',
    'as' => 'api.industries.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [IndustryController::class, 'index'])->name('index');
    Route::post('/', [IndustryController::class, 'store'])->name('store');
    Route::get('/{industry}', [IndustryController::class, 'show'])->name('show');
    Route::put('/{industry}', [IndustryController::class, 'update'])->name('update');
    Route::delete('/{industry}', [IndustryController::class, 'destroy'])->name('destroy');
});
