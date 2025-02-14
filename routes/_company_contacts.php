<?php

use App\Http\Controllers\CompanyContactController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'companies',
    'as' => 'api.companies',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/{company}/contact', [CompanyContactController::class, 'index'])->name('index');
    Route::post('/{company}/contact', [CompanyContactController::class, 'store'])->name('store');
    Route::get('/{company}/contact/{contact}', [CompanyContactController::class, 'show'])->name('show');
    Route::put('/{company}/contact/{contact}', [CompanyContactController::class, 'update'])->name('update');
    Route::delete('/{company}/contact/{contact}', [CompanyContactController::class, 'destroy'])->name('destroy');
});
