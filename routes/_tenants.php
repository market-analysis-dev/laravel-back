<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'tenants',
    'as' => 'api.tenants.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [TenantController::class, 'index'])->name('index');
    Route::post('/', [TenantController::class, 'store'])->name('store');
    Route::get('/{tenant}', [TenantController::class, 'show'])->name('show');
    Route::put('/{tenant}', [TenantController::class, 'update'])->name('update');
    Route::delete('/{tenant}', [TenantController::class, 'destroy'])->name('destroy');
});
