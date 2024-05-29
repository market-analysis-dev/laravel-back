<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModulesColumnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UniquePermissionController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\SubMarketController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

// * COMPANIES
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::put('/companies/{id}/delete', [CompanyController::class, 'destroy']);
Route::post('/companies', [CompanyController::class, 'store']);

// * USERS
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::put('/user/{id}/delete', [UserController::class, 'destroy']);
Route::post('/user', [UserController::class, 'store']);

// * USER DETAILS
Route::get('/user-details', [UserDetailsController::class, 'index']);
Route::get('/user-details/{id}', [UserDetailsController::class, 'show']);
Route::put('/user-details/{id}', [UserDetailsController::class, 'update']);
Route::put('/user-details/{id}/delete', [UserDetailsController::class, 'destroy']);
Route::post('/user-details', [UserDetailsController::class, 'store']);

// * USER TYPES
Route::get('/user-types', [UserTypeController::class, 'index']);
Route::get('/user-types/{id}', [UserTypeController::class, 'show']);
Route::put('/user-types/{id}', [UserTypeController::class, 'update']);
Route::put('/user-types/{id}/delete', [UserTypeController::class, 'destroy']);
Route::post('/user-types', [UserTypeController::class, 'store']);

// * MODULES
Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/{id}', [ModuleController::class, 'show']);
Route::put('/modules/{id}', [ModuleController::class, 'update']);
Route::put('/modules/{id}/delete', [ModuleController::class, 'destroy']);
Route::post('/modules', [ModuleController::class, 'store']);

// * MODULES COLUMNS
Route::get('/modules-col', [ModulesColumnController::class, 'index']);
Route::get('/modules-col/{id}', [ModulesColumnController::class, 'show']);
Route::put('/modules-col/{id}', [ModulesColumnController::class, 'update']);
Route::put('/modules-col/{id}/delete', [ModulesColumnController::class, 'destroy']);
Route::post('/modules-col', [ModulesColumnController::class, 'store']);

// * PERMISSIONS
Route::get('/premission', [PermissionController::class, 'index']);
Route::get('/premission/{id}', [PermissionController::class, 'show']);
Route::put('/premission/{id}', [PermissionController::class, 'update']);
Route::put('/premission/{id}/delete', [PermissionController::class, 'destroy']);
Route::post('/premission', [PermissionController::class, 'store']);

// * UNIQUE PERMISSIONS
Route::get('/unique', [UniquePermissionController::class, 'index']);
Route::get('/unique/{id}', [UniquePermissionController::class, 'show']);
Route::put('/unique/{id}', [UniquePermissionController::class, 'update']);
Route::put('/unique/{id}/delete', [UniquePermissionController::class, 'destroy']);
Route::post('/unique', [UniquePermissionController::class, 'store']);

// * MARKETS
Route::get('/market', [MarketController::class, 'index']);
Route::get('/market/{id}', [MarketController::class, 'show']);
Route::put('/market/{id}', [MarketController::class, 'update']);
Route::put('/market/{id}/delete', [MarketController::class, 'destroy']);
Route::post('/market', [MarketController::class, 'store']);

// * SUB MARKETS
Route::get('/submarket', [SubMarketController::class, 'index']);
Route::get('/submarket/{id}', [SubMarketController::class, 'show']);
Route::put('/submarket/{id}', [SubMarketController::class, 'update']);
Route::put('/submarket/{id}/delete', [SubMarketController::class, 'destroy']);
Route::post('/submarket', [SubMarketController::class, 'store']);