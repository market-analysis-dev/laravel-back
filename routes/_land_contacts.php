<?php

use App\Http\Controllers\LandContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lands/{land}/contact',
    'as' => 'api.lands.contact.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [LandContactController::class, 'index'])->name('index');
    Route::post('/', [LandContactController::class, 'store'])->name('store');
    Route::get('/{contact}', [LandContactController::class, 'show'])->name('show');
    Route::put('/{contact}', [LandContactController::class, 'update'])->name('update');
    Route::delete('/{contact}', [LandContactController::class, 'destroy'])->name('destroy');
    Route::post('/add/{contact}', [LandContactController::class, 'addContact'])->name('addContact');
});
