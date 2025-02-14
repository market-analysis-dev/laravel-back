<?php

use App\Http\Controllers\BrokerController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'brokers',
    'as' => 'api.brokers',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [BrokerController::class, 'index'])->name('index');
    Route::post('/', [BrokerController::class, 'store'])->name('store');
    Route::get('/{broker}', [BrokerController::class, 'show'])->name('show');
    Route::put('/{broker}', [BrokerController::class, 'update'])->name('update');
    Route::delete('/{broker}', [BrokerController::class, 'destroy'])->name('destroy');
});
