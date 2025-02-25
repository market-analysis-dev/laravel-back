<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'companies',
    'as' => 'api.companies.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [CompanyController::class, 'index'])->name('index');
    Route::get('/{companyId}', [CompanyController::class, 'show'])->name('show');
    Route::post('/', [CompanyController::class, 'store'])->name('store');
    Route::post('/{company}', [CompanyController::class, 'update'])->name('update');
    Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('destroy');
});
