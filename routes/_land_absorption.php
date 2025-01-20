<?php

use App\Http\Controllers\LandAbsorptionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lands/{land}/absorption',
    'as' => 'api.lands.absorption.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [LandAbsorptionController::class, 'index'])->name('index');
    Route::post('/', [LandAbsorptionController::class, 'store'])->name('store');
    Route::get('/{landAbsorption}', [LandAbsorptionController::class, 'show'])->name('show');
    Route::put('/{landAbsorption}', [LandAbsorptionController::class, 'update'])->name('update');
    Route::delete('/{landAbsorption}', [LandAbsorptionController::class, 'destroy'])->name('destroy');
});
