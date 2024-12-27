<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'owners',
    'as' => 'api.owners.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [OwnerController::class, 'index'])->name('listOwners');
    Route::post('/', [OwnerController::class, 'store'])->name('createOwner');
    Route::put('/{id}', [OwnerController::class, 'update'])->name('updateOwner');
    Route::delete('/{id}', [OwnerController::class, 'destroy'])->name('deleteOwner');
});
