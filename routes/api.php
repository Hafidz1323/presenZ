<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DepartmentController;
use App\Http\Controllers\Api\V1\PositionController;
use App\Http\Controllers\Api\V1\ShiftController;
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\LeaveController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\ExternalWeatherController;

Route::prefix('v1')->group(function () {
    // Auth Routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/jwt/login', [AuthController::class, 'jwtLogin']);

    // Weather API (Consume external API)
    Route::get('/weather', [ExternalWeatherController::class, 'getWeather']);

    // Protected Routes (Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Master Data (Admin/HR usually)
        Route::apiResource('master/departments', DepartmentController::class);
        Route::apiResource('master/positions', PositionController::class);
        Route::apiResource('master/shifts', ShiftController::class);

        // Attendance
        Route::get('/attendance', [AttendanceController::class, 'index']);
        Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);
        Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut']);

        // Leave / Pengajuan
        Route::get('/leave', [LeaveController::class, 'index']);
        Route::post('/leave', [LeaveController::class, 'store']);
        Route::get('/leave/{leave}', [LeaveController::class, 'show']);
        Route::patch('/leave/{leave}/approve', [LeaveController::class, 'approve']);

        // Reports
        Route::get('/report/attendance', [ReportController::class, 'attendanceReport']);
    });

    // JWT Protected Routes
    Route::middleware('jwt.auth')->group(function () {
        Route::get('/jwt/profile', [AuthController::class, 'profile']);
        Route::post('/auth/jwt/logout', [AuthController::class, 'logout']);
    });

    // API Key Protected Routes
    Route::middleware('api.key')->group(function () {
        Route::get('/apikey/profile', [AuthController::class, 'profile']);
    });

    // Basic Auth Protected Routes
    Route::middleware('auth.basic')->group(function () {
        Route::get('/basic/profile', [AuthController::class, 'profile']);
    });
});

