<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeOfWorkController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\JobOrderStatementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('jos.index');
});

// Type of Works Routes
Route::resource('type-of-works', TypeOfWorkController::class)->except(['show']);

// Contractors Routes
Route::resource('contractors', ContractorController::class)->except(['show']);

// Conductors Routes
Route::resource('conductors', ConductorController::class)->except(['show']);

// Job Orders Routes
Route::resource('job-orders', JobOrderController::class);

// Job Order Statements (JOS) Routes
Route::prefix('jos')->name('jos.')->group(function () {
    Route::get('/', [JobOrderStatementController::class, 'index'])->name('index');
    Route::post('/', [JobOrderStatementController::class, 'store'])->name('store');
    Route::get('/{jos}', [JobOrderStatementController::class, 'show'])->name('show');
    Route::get('/{jos}/export', [JobOrderStatementController::class, 'exportPdf'])->name('export');
});