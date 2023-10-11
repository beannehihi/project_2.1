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
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MajorController;

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

    Route::get('school_years', [SchoolYearController::class, 'create'])->name('school_years');
    Route::post('school_years_add', [SchoolYearController::class, 'add'])->name('school_years_add');
    Route::put('school_years_update', [SchoolYearController::class, 'update'])->name('school_years_update');
    Route::post('classes_add', [SchoolYearController::class, 'addClass'])->name('class_add');

    Route::get('classes/{id}', [ClassesController::class, 'create'])->name('classes');

    Route::get('majors', [MajorController::class, 'create'])->name('majors');



    Route::get('user-management', function () {
        return view('pages.user.management');
    })->name('management');

    Route::get('user-profile', [ProfileController::class, 'create'])->name('profile');
    Route::get('user-profile', [ProfileController::class, 'update'])->name('update_profile');
});
