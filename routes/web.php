<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\InvoiceController;

Route::get('/', function () {
    return view('frontend.home');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('companies', CompanyController::class);
});
Route::get('/company/dashboard/{company}', [CompanyController::class, 'dashboard'])->name('company.dashboard');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', controller: ProjectController::class);
    Route::resource('invoices', InvoiceController::class);
});

Route::get('/admin/company/clients/{client}/projects', [ProjectController::class, 'getProjectsByClient']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
// require __DIR__ . '/api.php';
