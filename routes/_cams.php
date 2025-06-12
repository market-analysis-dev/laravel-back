<?php

use App\Http\Controllers\CamController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cams',
    'as' => 'api.cams.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [CamController::class, 'index'])->name('index');
    Route::post('/', [CamController::class, 'store'])->name('store');
    Route::get('/{cam}', [CamController::class, 'show'])->name('show');
    Route::put('/{cam}', [CamController::class, 'update'])->name('update');
    Route::delete('/{cam}', [CamController::class, 'destroy'])->name('destroy');
});
