<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\ScholarshipApplicationController;

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

Route::get('/', function () {
    return view('auth.login');
});

// Users
Route::get('/users/create', function () {
    return view('users.create');
})->name('users.create');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

// CRUD Programs
Route::get('/admin/programs', [AdminController::class, 'programs'])->name('admin.programs.index');
Route::get('/admin/programs/create', [AdminController::class, 'createProgram'])->name('admin.programs.create');
Route::post('/admin/programs', [AdminController::class, 'storeProgram'])->name('admin.programs.store');
Route::get('/admin/programs/{program}/edit', [AdminController::class, 'editProgram'])->name('admin.programs.edit');
Route::put('/admin/programs/{program}', [AdminController::class, 'updateProgram'])->name('admin.programs.update');
Route::delete('/admin/programs/{program}', [AdminController::class, 'destroyProgram'])->name('admin.programs.destroy');

// CRUD Users
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

// CRUD Scholarship Types
Route::get('/admin/scholarship_types', [AdminController::class, 'scholarshipTypes'])->name('admin.scholarship_types.index');
Route::get('/admin/scholarship_types/create', [AdminController::class, 'createScholarshipType'])->name('admin.scholarship_types.create');
Route::post('/admin/scholarship_types', [AdminController::class, 'storeScholarshipType'])->name('admin.scholarship_types.store');
Route::get('/admin/scholarship_types/{scholarshipType}/edit', [AdminController::class, 'editScholarshipType'])->name('admin.scholarship_types.edit');
Route::put('/admin/scholarship_types/{scholarshipType}', [AdminController::class, 'updateScholarshipType'])->name('admin.scholarship_types.update');
Route::delete('/admin/scholarship_types/{scholarshipType}', [AdminController::class, 'destroyScholarshipType'])->name('admin.scholarship_types.destroy');

// CRUD Faculties
Route::get('/admin/faculties', [AdminController::class, 'faculties'])->name('admin.faculties.index');
Route::get('/admin/faculties/create', [AdminController::class, 'createFaculty'])->name('admin.faculties.create');
Route::post('/admin/faculties', [AdminController::class, 'storeFaculty'])->name('admin.faculties.store');
Route::get('/admin/faculties/{faculty}/edit', [AdminController::class, 'editFaculty'])->name('admin.faculties.edit');
Route::put('/admin/faculties/{faculty}', [AdminController::class, 'updateFaculty'])->name('admin.faculties.update');
Route::delete('/admin/faculties/{faculty}', [AdminController::class, 'destroyFaculty'])->name('admin.faculties.destroy');

// CRUD applications
Route::get('/scholarship-applications/create', [ScholarshipApplicationController::class, 'create'])->name('scholarship-applications.create');
Route::post('/scholarship-applications', [ScholarshipApplicationController::class, 'store'])->name('scholarship-applications.store');
Route::get('/scholarship-applications', [ScholarshipApplicationController::class, 'index'])->name('scholarship-applications.index');
Route::get('/scholarship-applications/{id}/edit', [ScholarshipApplicationController::class, 'edit'])->name('scholarship-applications.edit');
Route::put('/scholarship-applications/{id}', [ScholarshipApplicationController::class, 'update'])->name('scholarship-applications.update');
Route::delete('/scholarship-applications/{id}', [ScholarshipApplicationController::class, 'destroySelf'])->name('scholarship-applications.destroy');

// CRUD periods
Route::get('/periods/create', [PeriodController::class, 'create'])->name('faculty.periods.create');
Route::post('/periods', [PeriodController::class, 'store'])->name('faculty.periods.store');
Route::get('/periods', [PeriodController::class, 'index'])->name('faculty.periods.index');
Route::get('/periods/{id}/edit', [PeriodController::class, 'edit'])->name('faculty.periods.edit');
Route::put('/periods/{id}', [PeriodController::class, 'update'])->name('faculty.periods.update');
Route::delete('/periods/{id}', [PeriodController::class, 'destroy'])->name('faculty.periods.destroy');

// Read, Edit, Delete Student Application by Faculty
Route::get('/scholarship-applications-faculty', [ScholarshipApplicationController::class, 'viewsAllDataByFaculty'])->name('faculty.student.index');
Route::post('/scholarship-applications-faculty/{id}/approve', [ScholarshipApplicationController::class, 'approveByFaculty'])->name('faculty.student.approve');
Route::delete('/scholarship-applications-faculty/{id}', [ScholarshipApplicationController::class, 'destroyByFaculty'])->name('faculty.student.destroy');

// Read, Edit, Delete Student Application by Study Program
Route::get('/scholarship-applications-study-program', [ScholarshipApplicationController::class, 'viewsAllDataByStudyProgram'])->name('studyProgram.student.index');
Route::post('/scholarship-applications-study-program/{id}/approve', [ScholarshipApplicationController::class, 'approveByStudyProgram'])->name('studyProgram.student.approve');
Route::delete('/scholarship-applications-study-program/{id}', [ScholarshipApplicationController::class, 'destroyByStudyProgram'])->name('studyProgram.student.destroy');

