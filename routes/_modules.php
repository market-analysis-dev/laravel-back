<?php

use App\Http\Controllers\ModuleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'modules',
    'as' => 'api.modules.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ModuleController::class, 'index'])->name('index');
});
