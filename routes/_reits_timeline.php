<?php

use App\Http\Controllers\ReitsTimelineController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reits-timeline',
    'as' => 'api.reits-timeline.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ReitsTimelineController::class, 'index'])->name('index');
    Route::post('/', [ReitsTimelineController::class, 'store'])->name('store');
    Route::get('/{reitTimeline}', [ReitsTimelineController::class, 'show'])->name('show');
    Route::put('/{reitTimeline}', [ReitsTimelineController::class, 'update'])->name('update');
    Route::delete('/{reitTimeline}', [ReitsTimelineController::class, 'destroy'])->name('destroy');
});
