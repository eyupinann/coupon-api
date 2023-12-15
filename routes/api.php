<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PushController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ContactController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [AuthController::class, 'create']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('contact', [ContactController::class, 'index']);
    Route::get('all-match', [MatchController::class, 'oran']);

});


Route::group(['prefix'=>'v1','middleware' => ['auth:sanctum']], function () {
    Route::get('user-detail', [AuthController::class, 'detail']);
    Route::post('profile-edit', [AuthController::class, 'edit']);
    Route::get('user-destroy', [AuthController::class, 'destroy']);
    Route::get('user-pay', [AuthController::class, 'pay']);
    Route::get('user-type', [AuthController::class, 'user_type']);

    Route::get('daily/{day}', [MatchController::class, 'daily']);
    Route::get('live-match', [MatchController::class, 'live']);

    Route::get('push', [PushController::class, 'index']);

    Route::get('settings', [SettingsController::class, 'index']);

    Route::get('coupons', [CouponController::class, 'index']);
    Route::get('coupons-special-list', [CouponController::class, 'private_list']);
    Route::get('coupons-special', [CouponController::class, 'private']);
    Route::get('coupon_set/{id}', [CouponController::class, 'private_set']);


    //logout
    Route::get('logout', [AuthController::class, 'logout']);
});
