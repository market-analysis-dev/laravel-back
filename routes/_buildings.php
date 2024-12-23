<?php

use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/classes', [BuildingController::class, 'listClasses'])->name('listClasses');
});

