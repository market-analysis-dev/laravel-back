<?php

use App\Http\Controllers\BuildingContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/{building}/contact', [BuildingContactController::class, 'index'])->name('index');
    Route::post('/{building}/contact', [BuildingContactController::class, 'store'])->name('store');
    Route::get('/{building}/contact/{contact}', [BuildingContactController::class, 'show'])->name('show');
    Route::put('/{building}/contact/{contact}', [BuildingContactController::class, 'update'])->name('update');
    Route::delete('/{building}/contact/{contact}', [BuildingContactController::class, 'destroy'])->name('destroy');
});
