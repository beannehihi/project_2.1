<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TuitionController;
use App\Models\Fees;

Route::get('/', function () {
    return redirect('sign-in');
})->middleware('guest');
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');


Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('school_years', [SchoolYearController::class, 'create'])->name('school_years');
        Route::post('school_years_add', [SchoolYearController::class, 'add'])->name('school_years_add');
        Route::put('school_years_update', [SchoolYearController::class, 'update'])->name('school_years_update');
        Route::delete('school_years_delete/{id}', [SchoolYearController::class, 'delete'])->name('school_years_delete');


        Route::get('majors', [MajorController::class, 'create'])->name('majors');
        Route::post('majors/add', [MajorController::class, 'add'])->name('majors_add');
        Route::put('majors/update', [MajorController::class, 'update'])->name('major_update');
        Route::delete('majors/delete/{id}', [MajorController::class, 'delete'])->name('majors_delete');

        Route::get('students', [StudentController::class, 'create'])->name('students');
        Route::post('students/add', [StudentController::class, 'add'])->name('students_add');
        Route::put('students/update/{id}', [StudentController::class, 'update'])->name('students_update');
        Route::delete('students/delete/{id}', [StudentController::class, 'delete'])->name('students_delete');
        Route::post('students/import', [StudentController::class, 'import'])->name('students_import');

        Route::get('fees', [FeeController::class, 'create'])->name('fees');
        Route::post('fees/add', [FeeController::class, 'add'])->name('fees_add');
        Route::put('fees/update', [FeeController::class, 'update'])->name('fees_update');
        Route::delete('fees/delete.{id}', [FeeController::class, 'delete'])->name('fees_delete');
    });


    Route::get('tuition', [TuitionController::class, 'create'])->name('tuition');
    Route::post('tuition_add', [TuitionController::class, 'store'])->name('tuition_add');
    Route::patch('/tuition/update', [TuitionController::class, 'update'])->name('tuition_update');

    Route::get('/tuition/print/{id}', [TuitionController::class, 'printReceipt'])->name('tuition.printReceipt');




    Route::get('user-management', function () {
        return view('pages.user.management');
    })->name('management');

    Route::get('user-profile', [ProfileController::class, 'create'])->name('profile');
    Route::get('user-profile', [ProfileController::class, 'update'])->name('update_profile');
});
