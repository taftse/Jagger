<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Providers\ProviderRegistrationController;
use App\Http\Controllers\Federations\FederationsController;
use App\Http\Controllers\Federations\FederationManageController;
use App\Http\Controllers\Reports\ReportsController;
use App\Http\Controllers\Manage\EntityEditController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MetadataController;
use App\Http\Controllers\SetupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned the "web" middleware group. Make something great!
|
*/

// Default / Home
Route::get('/', [DashboardController::class, 'index']);
Route::get('/home', [PageController::class, 'frontPage']);

// Authentication
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

// Setup
Route::get('/setup', [SetupController::class, 'index']);

// Providers - SP/IDP Registration
Route::get('/providers/sp/registration/{token?}', [ProviderRegistrationController::class, 'sp']);
Route::get('/providers/sp_registration', [ProviderRegistrationController::class, 'sp']);
Route::get('/providers/idp_registration', [ProviderRegistrationController::class, 'idp']);
Route::get('/providers/idpsp_registration', [ProviderRegistrationController::class, 'idpsp']);

// Providers - Advanced Registration
Route::get('/providers/idp_registration/advanced', [EntityEditController::class, 'register'])->defaults('type', 'idp');
Route::get('/providers/sp_registration/advanced', [EntityEditController::class, 'register'])->defaults('type', 'sp');
Route::get('/providers/idpsp_registration/advanced', [EntityEditController::class, 'register'])->defaults('type', 'both');

// Federations
Route::get('/federations/federation_registration', [FederationsController::class, 'fedregistration']);
Route::get('/metadata/federation/{id}/metadata.xml', [FederationManageController::class, 'show']);
// Backward-compatible redirect for original misspelling in CodeIgniter routes
Route::get('/metadata/federatation/{id}/metadata.xml', fn ($id) => redirect("/metadata/federation/{$id}/metadata.xml", 301));

// Reports
Route::get('/reports/awaiting', [ReportsController::class, 'awaitingList']);
