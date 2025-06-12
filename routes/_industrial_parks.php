<?php

use App\Http\Controllers\IndustrialParkController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'industrial-parks',
    'as' => 'api.industrial-parks.',
    'middleware' => 'auth:sanctum',
], function(){
    Route::get('/', [IndustrialParkController::class, 'index'])->name('index');
    Route::post('/', [IndustrialParkController::class, 'store'])->name('store');
    Route::get('/{industrialPark}', [IndustrialParkController::class, 'show'])->name('show');
    Route::put('/{industrialPark}', [IndustrialParkController::class, 'update'])->name('update');
    Route::delete('/{industrialPark}', [IndustrialParkController::class, 'destroy'])->name('destroy');
    Route::get('/{industrialPark}/tenants', [IndustrialParkController::class, 'getTenantsByPark'])->name('getTenantsByPark');
});
