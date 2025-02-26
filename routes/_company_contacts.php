<?php

use App\Http\Controllers\CompanyContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'companies/{company}/contact',
    'as' => 'api.companies.contact.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [CompanyContactController::class, 'index'])->name('index');
    Route::post('/', [CompanyContactController::class, 'store'])->name('store');
    Route::get('/{contact}', [CompanyContactController::class, 'show'])->name('show');
    Route::put('/{contact}', [CompanyContactController::class, 'update'])->name('update');
    Route::delete('/{contact}', [CompanyContactController::class, 'destroy'])->name('destroy');
});
