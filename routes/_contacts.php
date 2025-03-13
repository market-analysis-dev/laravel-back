<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'contacts',
    'as' => 'api.contacts.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
});
