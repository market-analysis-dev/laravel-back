<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;

Route::post('/login', [AuthController::class, 'login']);

// * COMPANIES
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::put('/companies/{id}/delete', [CompanyController::class, 'delete']);
Route::post('/companies', [CompanyController::class, 'store']);