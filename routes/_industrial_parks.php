<?php

use App\Http\Controllers\IndustrialParkController;
use App\Models\IndustrialPark;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'industrial-parks',
    'as' => 'api.industrial-parks',
    // 'middleware' => 'auth:sanctum',
], function(){
    Route::get('/', [IndustrialParkController::class, 'index'])->name('index');
    Route::post('/', [IndustrialParkController::class, 'store'])->name('store');
    Route::put('/{id}', [IndustrialParkController::class, 'update'])->name('update');
    Route::delete('/{id}', [IndustrialParkController::class, 'destroy'])->name('destroy');

});