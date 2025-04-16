<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'clients',
    'as' => 'api.clients.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/building-availability', [ClientController::class, 'buildingAvailabilityList'])->name('buildingAvailabilityList');
    Route::get('/building-availability/statistics', [ClientController::class, 'buildingAvailabilityStatistic'])->name('buildingAvailabilityStatistic');
});
