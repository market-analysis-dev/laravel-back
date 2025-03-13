<?php

use App\Http\Controllers\BuildingContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings/{building}/contact',
    'as' => 'api.buildings.contacts.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [BuildingContactController::class, 'index'])->name('index');
    Route::post('/', [BuildingContactController::class, 'store'])->name('store');
    Route::get('/{contact}', [BuildingContactController::class, 'show'])->name('show');
    Route::put('/{contact}', [BuildingContactController::class, 'update'])->name('update');
    Route::delete('/{contact}', [BuildingContactController::class, 'destroy'])->name('destroy');
    Route::post('/add/{contact}', [BuildingContactController::class, 'addContact'])->name('addContact');
});
