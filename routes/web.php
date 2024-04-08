<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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
});

Route::group(['prefix' => 'user'], function () {
    Route::get("/login", [LoginController::class, 'showUserLoginPage'])->name("user.login");
});
