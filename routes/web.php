<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\ActivityLogController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ReporterController;
use App\Http\Controllers\Dashboard\ReportTrackerController;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Yajra Datatable
// https://yajrabox.com/docs/laravel-datatables/10.0/quick-starter

// Activity Log
// https://spatie.be/docs/laravel-activitylog/v4/basic-usage/logging-activity

// Sweet Alert
// https://realrashid.github.io/sweet-alert/

// Role and Permissions
// https://spatie.be/docs/laravel-permission/v5/basic-usage/role-permissions

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/getLog', function () {
    return Activity::latest()->take(5)->get();
});

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [AuthController::class, 'loginView'])->name('login');
        Route::post('/', [AuthController::class, 'login'])->name('login.store');
    });
    
    Route::prefix('register')->group(function () {
        Route::get('/', [AuthController::class, 'registerView'])->name('register');
        Route::post('/', [AuthController::class, 'register'])->name('register.store');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('dashboard')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::prefix('data')->group(function () {
            Route::get('activity-logs', ActivityLogController::class)->name('activity-logs.index');
            Route::resource('categories', CategoryController::class);
            Route::resource('reports', ReportController::class);
            Route::resource('reporters', ReporterController::class);
            Route::resource('report-trackers', ReportTrackerController::class);
        });
    });
});


