<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'startup_owner' => redirect()->route('startup.dashboard'),
        'investor' => redirect()->route('investor.dashboard'),
        'freelancer' => redirect()->route('freelancer.dashboard'),
        default => view('dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Marketplace Routes
Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{startup}', [App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/startups/{startup}/approve', [App\Http\Controllers\AdminController::class, 'approveStartup'])->name('admin.startups.approve');
    Route::post('/admin/startups/{startup}/reject', [App\Http\Controllers\AdminController::class, 'rejectStartup'])->name('admin.startups.reject');

    Route::get('/startup/dashboard', [App\Http\Controllers\StartupController::class, 'dashboard'])->name('startup.dashboard');

    Route::get('/investor/dashboard', [App\Http\Controllers\InvestorController::class, 'dashboard'])->name('investor.dashboard');

    Route::get('/freelancer/dashboard', [App\Http\Controllers\FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');

    Route::get('/startups/create', [App\Http\Controllers\StartupController::class, 'create'])->name('startups.create');
    Route::post('/startups', [App\Http\Controllers\StartupController::class, 'store'])->name('startups.store');

    Route::get('/investors/create', [App\Http\Controllers\InvestorController::class, 'create'])->name('investors.create');
    Route::post('/investors', [App\Http\Controllers\InvestorController::class, 'store'])->name('investors.store');

    Route::get('/jobs/create', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [App\Http\Controllers\JobController::class, 'store'])->name('jobs.store');
});

// Public Job Routes
Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
Route::post('/jobs/{job}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('jobs.apply')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
