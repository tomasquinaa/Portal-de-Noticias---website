<?php

use App\Http\Controllers\Admin\AdminAdvertisementController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SubscriberController;
use Illuminate\Support\Facades\Route;


/** Front End */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::post('/subscriber', [SubscriberController::class, 'index'])->name('subscribe');
Route::get('/subscriber/verify/{token}/{email}', [SubscriberController::class, 'verify'])->name('subscribe_verify');

/** Fim Front End */


/** Admin */

// Route::middleware(['admin:admin', 'auth'])->group(function () {
//     Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');
// });


Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_pasword'])->name('admin_forget_password');
Route::post('/admin/forget-password', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'reset_password'])->name('admin_reset_password');
Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

// Perfil
Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');
Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');


// Anuncios
Route::get('/admin/home-anuncios', [AdminAdvertisementController::class, 'home_ad_show'])->name('admin_home_ad_show')->middleware('admin:admin');
Route::post('/admin/home-anuncios-update', [AdminAdvertisementController::class, 'home_ad_update'])->name('admin_home_ad_update');
