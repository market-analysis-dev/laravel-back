<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MarketAuthController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModulesColumnController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubMarketController;
use App\Http\Controllers\UniquePermissionController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UserTypeController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/me', [AuthController::class, 'me'])->middleware('auth:sanctum')->name('me');


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

// * UNIQUE PERMISSIONS
Route::get('/unique', [UniquePermissionController::class, 'index']);
Route::get('/unique/{id}', [UniquePermissionController::class, 'show']);
Route::put('/unique/{id}', [UniquePermissionController::class, 'update']);
Route::put('/unique/{id}/delete', [UniquePermissionController::class, 'destroy']);
// Route::post('/unique', [UniquePermissionController::class, 'store']);


// * AVAILABILITY
Route::get('/excel-data', [ExcelController::class, 'getData']); // ! Este NO se utiliza

/*
 * API's Pólizas de Acceso
 */
Route::post('/permissions/multiple/{userId}', [PermissionController::class, 'store']);
Route::post('/permissions/{userId}', [PermissionController::class, 'showPermissions']);
Route::post('/permissions/update/{userId}', [PermissionController::class, 'updatePermissions']);
Route::post('/permissions/clone/{userId}', [PermissionController::class, 'clonePermissions']);
Route::post('/permissions/clone/multiple/{userId}', [PermissionController::class, 'cloneMultipleUsers']);



// Route::post('/market/login', [MarketAuthController::class, 'login']);

require_once '_users.php';
require_once '_buildings_available.php';
require_once '_buildings_absorption.php';
require_once '_building_contacts.php';
require_once '_buildings.php';
require_once '_industrial_parks.php';
require_once '_regions.php';
require_once '_currency.php';
require_once '_markets.php';
require_once '_submarkets.php';
require_once '_roles.php';
require_once '_permissions.php';
require_once '_tenants.php';
require_once '_developers.php';
require_once '_shelters.php';
require_once '_brokers.php';
require_once  '_industries.php';
require_once  '_countries.php';
require_once '_companies.php';
require_once '_company_contacts.php';
require_once '_land_absorption.php';
require_once '_land_available.php';
require_once '_lands.php';
require_once '_reits_types.php';
require_once '_reits.php';
require_once '_modules.php';
require_once '_reit_annual.php';
require_once '_reit_mortgages.php';
require_once '_cams.php';
require_once '_land_contacts.php';
require_once '_market_growths.php';
require_once '_reits_timeline.php';
require_once '_reit_instruments.php';
