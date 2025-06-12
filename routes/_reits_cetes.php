<?php

use App\Http\Controllers\ReitCeteController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reit-cetes',
    'as' => 'api.reit-cetes.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitCeteController::class, 'index'])->name('index');
    Route::post('/', [ReitCeteController::class, 'store'])->name('store');
    Route::get('/{reitCete}', [ReitCeteController::class, 'show'])->name('show');
    Route::put('/{reitCete}', [ReitCeteController::class, 'update'])->name('update');
    Route::delete('/{reitCete}', [ReitCeteController::class, 'destroy'])->name('destroy');
});
