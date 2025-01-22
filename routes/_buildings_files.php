<?php

use App\Http\Controllers\BuildingFileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/{building}/files', [BuildingFileController::class, 'uploadFiles'])->name('uploadFiles');
});

