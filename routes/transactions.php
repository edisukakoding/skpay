<?php
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Transactions\BillController;

Route::prefix('transactions')->middleware([Authenticate::class, isAdmin::class])->group(function () {
    Route::get('bills/meter/{customer}', [BillController::class, 'getMeter'])->name('bills.get-meter');
    Route::resource('bills', BillController::class);
});