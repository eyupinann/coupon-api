<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ADMIN\AuthController;
use App\Http\Controllers\ADMIN\IndexController;
use App\Http\Controllers\ADMIN\UserController;
use App\Http\Controllers\ADMIN\CouponController;
use App\Http\Controllers\ADMIN\MatchController;
use App\Http\Controllers\ADMIN\SettingsController;
use App\Http\Controllers\ADMIN\PushController;
use App\Http\Controllers\ADMIN\ContactController;


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_post'])->name('login_post');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::get('contact', [ContactController::class, 'index'])->name('contact');

    Route::get('match', [MatchController::class, 'oran'])->name('match');
    Route::get('match-daily', [MatchController::class, 'daily'])->name('match_daily');
    Route::get('match-live', [MatchController::class, 'live'])->name('match_live');

    Route::get('coupon-result', [CouponController::class, 'result'])->name('coupon_result');

    Route::get('coupon', [CouponController::class, 'index'])->name('coupon_list');
    Route::get('coupon-priv', [CouponController::class, 'coupon_priv_list'])->name('coupon_priv_list');
    Route::get('coupon-add', [CouponController::class, 'create'])->name('coupon_create');
    Route::get('coupon-edit/{id}', [CouponController::class, 'edit'])->name('coupon_edit');
    Route::post('coupon-save', [CouponController::class, 'save'])->name('coupon_save');
    Route::get('coupon-destroy/{id}', [CouponController::class, 'destroy'])->name('coupon_destroy');
    Route::get('coupon-priv-list', [CouponController::class, 'coupon_priv_list_buy'])->name('coupon_priv_buy');

    Route::get('push', [PushController::class, 'index'])->name('push_list');
    Route::get('push-add', [PushController::class, 'create'])->name('push_create');
    Route::get('push-edit/{id}', [PushController::class, 'edit'])->name('push_edit');
    Route::post('push-save', [PushController::class, 'save'])->name('push_save');
    Route::get('push-destroy/{id}', [PushController::class, 'destroy'])->name('push_destroy');

    Route::get('user', [UserController::class, 'index'])->name('user_list');
    Route::get('user-add', [UserController::class, 'create'])->name('user_create');
    Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::post('user-save', [UserController::class, 'save'])->name('user_save');
    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user_destroy');
    Route::get('user-premium', [UserController::class, 'user_premium_list'])->name('user_premium_list');

    Route::get('settings', [SettingsController::class, 'edit'])->name('settings');
    Route::post('settings', [SettingsController::class, 'save'])->name('settings_save');


    Route::get('cikis', [AuthController::class, 'logout'])->name('logout');
});
