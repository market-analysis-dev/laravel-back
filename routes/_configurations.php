<?php

use App\Http\Controllers\ConfigurationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'configurations',
    'as' => 'api.configurations.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ConfigurationController::class, 'index'])->name('index');
    Route::put('/{configuration}', [ConfigurationController::class, 'update'])->name('update');
    Route::post('/{configuration}/kmz', [ConfigurationController::class, 'uploadKmz'])->name('uploadKmz');

});
