<?php

use App\Http\Controllers\ReitAnnualController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reit-annual',
    'as' => 'api.reit-annual.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitAnnualController::class, 'index'])->name('index');
    Route::post('/', [ReitAnnualController::class, 'store'])->name('store');
    Route::get('{reitAnnual}', [ReitAnnualController::class, 'show'])->name('show');
    Route::put('/{reitAnnual}', [ReitAnnualController::class, 'update'])->name('update');
    Route::delete('/{reitAnnual}', [ReitAnnualController::class, 'destroy'])->name('destroy');
});
