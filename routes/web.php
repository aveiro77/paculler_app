<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PayrollsController;
use App\Http\Controllers\PresencesController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\KingdomController;
use App\Http\Controllers\ItemController;

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard chart, buatan sendiri
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/presence', [DashboardController::class, 'presence']);

    // Resource routes for departments
    Route::resource('departments', DepartmentController::class)->middleware(['role:HR']);

    // Resource routes for roles
    Route::resource('roles', RoleController::class)->middleware(['role:HR,Developer']);

    // Resource routes for employees
    Route::resource('employees', EmployeeController::class)->middleware(['role:HR']);

    // Resource routes for tasks
    Route::resource('tasks', TaskController::class)->middleware(['role:Developer,HR']);
    Route::get('tasks/done/{id}', [TaskController::class, 'done'])->name('tasks.done');
    Route::get('tasks/pending/{id}', [TaskController::class, 'pending'])->name('tasks.pending');

    // Resource routes for payroll
    Route::resource('payrolls', PayrollsController::class)->middleware(['role:Developer,HR']);

    // Resource routes for presences (attendance)
    Route::resource('presences', PresencesController::class)->middleware(['role:Developer,HR']);
    
    // Resource routes for leave requests
    Route::resource('leave-requests', LeaveRequestController::class)->middleware(['role:Developer,HR']);
    
    Route::get('leave-requests/confirm/{id}', [LeaveRequestController::class, 'confirm'])->name('leave-requests.confirm');
    Route::get('leave-requests/reject/{id}', [LeaveRequestController::class, 'reject'])->name('leave-requests.reject');

    // Resource routes for item categories
    Route::resource('item_categories', ItemCategoryController::class)->middleware(['role:HR,Developer']);

    // Resource routes for kingdoms
    Route::resource('kingdoms', KingdomController::class)->middleware(['role:HR,Developer']);

    // Resource routes for items
    Route::resource('items', ItemController::class)->middleware(['role:HR,Developer']);
});

// Bawaan Breeze.
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';