<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;

// Public Marketing Website Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PublicController::class, 'serviceDetail'])->name('services.detail');
Route::get('/projects', [PublicController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [PublicController::class, 'projectDetail'])->name('projects.detail');
Route::get('/before-after', [PublicController::class, 'beforeAfter'])->name('before-after');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/request-quote', [PublicController::class, 'quote'])->name('quote');
Route::post('/request-quote', [PublicController::class, 'submitQuote'])->name('quote.submit');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Management Dashboard Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Enquiries
    Route::get('/enquiries', [AdminController::class, 'enquiries'])->name('enquiries');
    Route::post('/enquiries/{id}/status', [AdminController::class, 'updateEnquiryStatus'])->name('enquiries.status');
    Route::post('/enquiries/{id}/convert', [AdminController::class, 'convertEnquiryToProject'])->name('enquiries.convert');

    // Projects Pipeline
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects.index');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('projects.edit');
    Route::post('/projects/{id}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::post('/projects/{id}/image', [AdminController::class, 'uploadProjectImage'])->name('projects.image');

    // Quotations
    Route::get('/quotations', [AdminController::class, 'quotations'])->name('quotations.index');
    Route::get('/quotations/create', [AdminController::class, 'createQuotation'])->name('quotations.create');
    Route::post('/quotations', [AdminController::class, 'storeQuotation'])->name('quotations.store');
    Route::get('/quotations/{id}', [AdminController::class, 'showQuotation'])->name('quotations.show');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});

// Customer Portal Routes
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
});
