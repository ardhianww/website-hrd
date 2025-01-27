<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Karyawan
    Route::resource('employees', EmployeeController::class);

    // Absensi
    Route::resource('attendances', AttendanceController::class);
    Route::post('attendances/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clockIn');
    Route::post('attendances/clock-out', [AttendanceController::class, 'clockOut'])->name('attendances.clockOut');

    // Penggajian
    Route::resource('payrolls', PayrollController::class);
    Route::get('payrolls/{payroll}/print', [PayrollController::class, 'print'])->name('payrolls.print');
    Route::post('payrolls/generate', [PayrollController::class, 'generate'])->name('payrolls.generate');

    // Rekrutmen
    Route::resource('jobs', JobVacancyController::class);
    Route::resource('applications', JobApplicationController::class);
    Route::post('applications/{application}/schedule-interview', [JobApplicationController::class, 'scheduleInterview'])
        ->name('applications.scheduleInterview');

    // Cuti
    Route::resource('leaves', LeaveController::class);
    Route::post('leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
