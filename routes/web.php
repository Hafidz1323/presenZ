<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AttendanceWebController;
use App\Http\Controllers\Web\LeaveWebController;
use App\Http\Controllers\Web\AdminWebController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Attendance
    Route::get('/attendance/history', [AttendanceWebController::class, 'history'])->name('attendance.history');
    Route::post('/attendance/check-in', [AttendanceWebController::class, 'checkIn'])->name('attendance.check-in');
    Route::post('/attendance/check-out', [AttendanceWebController::class, 'checkOut'])->name('attendance.check-out');
    Route::get('/attendance/reverse-geocode', [AttendanceWebController::class, 'reverseGeocode'])->name('attendance.reverse-geocode');

    // Leave
    Route::get('/leaves', [LeaveWebController::class, 'index'])->name('leaves.index');
    Route::post('/leaves', [LeaveWebController::class, 'store'])->name('leaves.store');
    Route::post('/leaves/{leave}/approve', [LeaveWebController::class, 'approve'])->name('leaves.approve');

    // Admin Only
    Route::middleware(['role:admin,hr'])->group(function () {
        Route::get('/admin/master-data', [AdminWebController::class, 'masterData'])->name('admin.master-data');
        Route::get('/admin/employees', [AdminWebController::class, 'employees'])->name('admin.employees');
        Route::post('/admin/employees', [AdminWebController::class, 'storeEmployee'])->name('admin.employees.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
});

require __DIR__.'/auth.php';

Route::get('/api/docs', function () {
    return view('swagger');
})->name('api.docs');
