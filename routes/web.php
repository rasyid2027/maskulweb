<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::post('/student', [StudentController::class, 'store']);
    Route::get('/student/{id}', [StudentController::class, 'show'])->name('profile');
    Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('delete');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit']);
    Route::patch('/student/{id}', [StudentController::class, 'update'])->name('update');
});

Route::group(['middleware' => ['auth', 'checkRole:admin,guru']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::get('/student/{id}', [StudentController::class, 'show'])->name('profile');
});
