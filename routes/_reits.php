<?php

use App\Http\Controllers\ReitController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reits',
    'as' => 'api.reits',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitController::class, 'index'])->name('index');
    Route::post('/', [ReitController::class, 'store'])->name('store');
    Route::put('/{reit}', [ReitController::class, 'update'])->name('update');
    Route::delete('/{reit}', [ReitController::class, 'destroy'])->name('destroy');
});
