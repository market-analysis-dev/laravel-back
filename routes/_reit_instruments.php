<?php

use App\Http\Controllers\ReitInstrumentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reit-instruments',
    'as' => 'api.reit-instruments.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitInstrumentController::class, 'index'])->name('index');
    Route::post('/', [ReitInstrumentController::class, 'store'])->name('store');
    Route::get('/{reitInstrument}', [ReitInstrumentController::class, 'show'])->name('show');
    Route::put('/{reitInstrument}', [ReitInstrumentController::class, 'update'])->name('update');
    Route::delete('/{reitInstrument}', [ReitInstrumentController::class, 'destroy'])->name('destroy');
});
