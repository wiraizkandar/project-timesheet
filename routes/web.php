<?php

use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\User\TimeSheetController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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

Route::get("/", [HomeController::class, 'index'])->name("home");

Route::group(['prefix' => 'admin'], function () {
    Route::get("/login", [LoginController::class, 'showAdminLoginPage'])->name("admin.login");
    Route::post("/authenticate", [AdminLoginController::class, 'authenticate'])->name("admin.authenticate");

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get("/dashboard", [AdminDashboardController::class, 'index'])->name("admin.dashboard");
    });
});

Route::group(['prefix' => 'user'], function () {

    Route::get("/login", [LoginUserController::class, 'showUserLoginPage'])->name("user.login");
    Route::post("/authenticate", [LoginUserController::class, 'authenticate'])->name("user.authenticate");
    Route::post("/register", [RegisterUserController::class, 'store'])->name("user.register");
    Route::get("/register", [RegisterUserController::class, 'showUserRegisterPage'])->name("user.register");


    Route::group(['middleware' => 'auth:user'], function () {
        Route::get("/dashboard", [UserDashboardController::class, 'index'])->name("user.dashboard");

        // User TimeSheet
        Route::get("/timesheet", [TimeSheetController::class, 'index'])->name("user.timesheet");
    });
});
