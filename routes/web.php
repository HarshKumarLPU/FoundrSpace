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

// Marketplace Routes (Protected)
Route::middleware(['auth', 'role:admin,customer,investor,startup_owner'])->group(function () {
    Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/marketplace/{startup}', [App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');
});

// Investor Routes (Protected)
Route::middleware(['auth', 'role:admin,investor,startup_owner'])->group(function () {
    Route::get('/investors', [App\Http\Controllers\InvestorController::class, 'index'])->name('investors.index');
    Route::get('/investors/{investor}', [App\Http\Controllers\InvestorController::class, 'show'])
        ->name('investors.show')
        ->where('investor', '[0-9]+');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Bookmarks
    Route::post('/bookmarks/startup/{startup}', [App\Http\Controllers\BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    
    // Notifications
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    
    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/startups/{startup}/approve', [App\Http\Controllers\AdminController::class, 'approveStartup'])->name('admin.startups.approve');
        Route::post('/admin/startups/{startup}/reject', [App\Http\Controllers\AdminController::class, 'rejectStartup'])->name('admin.startups.reject');
        Route::post('/admin/startups/{startup}/verify', [App\Http\Controllers\AdminController::class, 'verifyStartup'])->name('admin.startups.verify');
    });

    // Startup Owner Routes
    Route::middleware(['role:startup_owner'])->group(function () {
        Route::get('/startup/dashboard', [App\Http\Controllers\StartupController::class, 'dashboard'])->name('startup.dashboard');
        Route::get('/startups/create', [App\Http\Controllers\StartupController::class, 'create'])->name('startups.create');
        Route::post('/startups', [App\Http\Controllers\StartupController::class, 'store'])->name('startups.store');
        Route::get('/jobs/create', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [App\Http\Controllers\JobController::class, 'store'])->name('jobs.store');
        Route::post('/applications/{application}/accept', [App\Http\Controllers\ApplicationController::class, 'accept'])->name('applications.accept');
        Route::post('/applications/{application}/reject', [App\Http\Controllers\ApplicationController::class, 'reject'])->name('applications.reject');
    });

    // Investor Routes
    Route::middleware(['role:investor'])->group(function () {
        Route::get('/investor/dashboard', [App\Http\Controllers\InvestorController::class, 'dashboard'])->name('investor.dashboard');
        Route::get('/investors/create', [App\Http\Controllers\InvestorController::class, 'create'])->name('investors.create');
        Route::post('/investors', [App\Http\Controllers\InvestorController::class, 'store'])->name('investors.store');
    });

    // Freelancer Routes
    Route::middleware(['role:freelancer'])->group(function () {
        Route::get('/freelancer/dashboard', [App\Http\Controllers\FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');
    });

});

// Job Routes (Protected)
Route::middleware(['auth', 'role:admin,freelancer,startup_owner'])->group(function () {
    Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [App\Http\Controllers\JobController::class, 'show'])
        ->name('jobs.show')
        ->where('job', '[0-9]+');
});
Route::post('/jobs/{job}/apply', [App\Http\Controllers\ApplicationController::class, 'store'])->name('jobs.apply')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
