<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModulesColumnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BuildingsController;
use App\Http\Controllers\UniquePermissionController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\SubMarketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

Route::post('/login', [AuthController::class, 'login']);

// * COMPANIES (COMPLETADO)
Route::get('/companies', [CompanyController::class, 'index']); // * Este si se utiliza
Route::get('/companies/{id}', [CompanyController::class, 'show']); // * Este si se utiliza
Route::put('/companies/{id}', [CompanyController::class, 'update']); // * Este si se utiliza
Route::put('/companies/{id}/delete', [CompanyController::class, 'destroy']); // * Este si se utiliza
Route::post('/companies', [CompanyController::class, 'store']);

// * USERS (COMPLETADO)
Route::get('/user', [UserController::class, 'index']); // * Este si se utiliza
Route::get('/user/{id}', [UserController::class, 'show']); // * Este si se utiliza
Route::put('/user/{id}', [UserController::class, 'update']); // * Este si se utiliza
Route::put('/user/{id}/delete', [UserController::class, 'destroy']); // * Este si se utiliza
Route::post('/user', [UserController::class, 'store']); // * Este si se utiliza

// * USER DETAILS (COMPLETADO)
Route::get('/user-details', [UserDetailsController::class, 'index']); // ! Este NO se utiliza
Route::get('/user-details/{id}', [UserDetailsController::class, 'show']); // ! Este NO se utiliza
Route::put('/user-details/{id}', [UserDetailsController::class, 'update']); // ! Este NO se utiliza
Route::put('/user-details/{id}/delete', [UserDetailsController::class, 'destroy']); // ! Este NO se utiliza
Route::post('/user-details', [UserDetailsController::class, 'store']); // ! Este NO se utiliza

// * USER TYPES (COMPLETADO)
Route::get('/user-types', [UserTypeController::class, 'index']);
Route::get('/user-types/{id}', [UserTypeController::class, 'show']);
Route::put('/user-types/{id}', [UserTypeController::class, 'update']);
Route::put('/user-types/{id}/delete', [UserTypeController::class, 'destroy']);
Route::post('/user-types', [UserTypeController::class, 'store']);

// * MODULES (COMPLETADO)
Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/{id}', [ModuleController::class, 'show']);
Route::put('/modules/{id}', [ModuleController::class, 'update']);
Route::put('/modules/{id}/delete', [ModuleController::class, 'destroy']);
Route::post('/modules', [ModuleController::class, 'store']);

// * MODULES COLUMNS (COMPLETADO)
Route::get('/modules-col', [ModulesColumnController::class, 'index']);
Route::get('/modules-col/{id}', [ModulesColumnController::class, 'show']);
Route::put('/modules-col/{id}', [ModulesColumnController::class, 'update']);
Route::put('/modules-col/{id}/delete', [ModulesColumnController::class, 'destroy']);
Route::post('/modules-col', [ModulesColumnController::class, 'store']);

// * PERMISSIONS (COMPLETADO)
Route::get('/permission', [PermissionController::class, 'index']);
Route::get('/permission/{userId}', [PermissionController::class, 'show']);
Route::put('/permission/{id}', [PermissionController::class, 'update']);
Route::put('/permission/{id}/delete', [PermissionController::class, 'destroy']);
// Route::post('/permission/{userId}', [PermissionController::class, 'store']);

// * UNIQUE PERMISSIONS
Route::get('/unique', [UniquePermissionController::class, 'index']);
Route::get('/unique/{id}', [UniquePermissionController::class, 'show']);
Route::put('/unique/{id}', [UniquePermissionController::class, 'update']);
Route::put('/unique/{id}/delete', [UniquePermissionController::class, 'destroy']);
// Route::post('/unique', [UniquePermissionController::class, 'store']);

// * MARKETS (COMPLETADO)
Route::get('/market', [MarketController::class, 'index']);
Route::get('/market/{id}', [MarketController::class, 'show']);
Route::put('/market/{id}', [MarketController::class, 'update']);
Route::put('/market/{id}/delete', [MarketController::class, 'destroy']);
Route::post('/market', [MarketController::class, 'store']);

// * SUB MARKETS (COMPLETADO)
Route::get('/submarket', [SubMarketController::class, 'index']);
Route::get('/submarket/{id}', [SubMarketController::class, 'show']);
Route::put('/submarket/{id}', [SubMarketController::class, 'update']);
Route::put('/submarket/{id}/delete', [SubMarketController::class, 'destroy']);
Route::post('/submarket', [SubMarketController::class, 'store']);

// * AVAILABILITY
Route::get('/excel-data', [ExcelController::class, 'getData']); // ! Este NO se utiliza

/*
 * API's Pólizas de Acceso
 */
Route::post('/permissions/multiple/{userId}', [PermissionController::class, 'store']);
Route::post('/permissions/{userId}', [PermissionController::class, 'showPermissions']);

/*
 * API's Buildings
 */
Route::get('/buildings/data', [BuildingsController::class, 'index']);