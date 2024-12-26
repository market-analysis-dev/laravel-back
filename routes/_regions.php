<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'regions',
    'as' => 'api.regions.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [RegionController::class, 'index'])->name('index');
});

