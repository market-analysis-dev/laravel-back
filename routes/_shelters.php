<?php

use App\Http\Controllers\ShelterController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'shelters',
    'as' => 'api.shelters',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ShelterController::class, 'index'])->name('index');
});
