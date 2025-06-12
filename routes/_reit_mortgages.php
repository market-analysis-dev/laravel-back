<?php

use App\Http\Controllers\ReitMortgageController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reit-mortgage',
    'as' => 'api.reit-mortgage.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitMortgageController::class, 'index'])->name('index');
    Route::post('/', [ReitMortgageController::class, 'store'])->name('store');
    Route::get('{reitMortgage}', [ReitMortgageController::class, 'show'])->name('show');
    Route::put('/{reitMortgage}', [ReitMortgageController::class, 'update'])->name('update');
    Route::delete('/{reitMortgage}', [ReitMortgageController::class, 'destroy'])->name('destroy');
});
