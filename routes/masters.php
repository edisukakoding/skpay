<?php
use App\Http\Controllers\Masters\CustomerController;
use App\Http\Controllers\Masters\MeterController;
use App\Http\Controllers\Transactions\CheckoutController;
use App\Http\Controllers\Masters\RateController;
use App\Http\Middleware\isAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('masters')->middleware([Authenticate::class, isAdmin::class])->group(function () {
    Route::put('/rates/set-status/{rate}', [RateController::class, 'setStatus'])->name('rates.set-status');
    Route::resource('rates', RateController::class);
    Route::put('/customers/set-status/{customer}', [CustomerController::class, 'setStatus'])->name('customers.set-status');
    Route::resource('customers', CustomerController::class);
    Route::put('/meters/set-status/{meter}', [MeterController::class, 'setStatus'])->name('meters.set-status');
    Route::resource('meters', MeterController::class);

    Route::resource('checkout', CheckoutController::class);
});