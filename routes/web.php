<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Member\MemberAuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\CardController as MemberCardController;
use App\Http\Controllers\Member\PaymentController as MemberPaymentController;
use App\Http\Controllers\Member\NotificationController as MemberNotificationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;

Route::get('/', function () {
    return redirect()->route('member.login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('member')->name('member.')->group(function () {
    Route::get('/login', [MemberAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [MemberAuthController::class, 'sendOtp'])->name('login.submit');
    Route::get('/otp', [MemberAuthController::class, 'showOtp'])->name('otp');
    Route::post('/otp', [MemberAuthController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/logout', [MemberAuthController::class, 'logout'])->name('logout');

    Route::middleware('member')->group(function () {
        Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
        Route::get('/card', [MemberCardController::class, 'index'])->name('card');
        Route::get('/card/qr', [MemberCardController::class, 'qrCode'])->name('card.qr');
        Route::get('/payments', [MemberPaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}', [MemberPaymentController::class, 'show'])->name('payments.show');
        Route::get('/notifications', [MemberNotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/{notification}', [MemberNotificationController::class, 'show'])->name('notifications.show');
    });
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('members', AdminMemberController::class);
    Route::resource('payments', AdminPaymentController::class)->except(['show']);
    Route::resource('notifications', AdminNotificationController::class)->except(['show']);
});
