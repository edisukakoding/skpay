<?php
use App\Http\Controllers\Transactions\BillController;
use App\Http\Middleware\isAdmin;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->middleware([Authenticate::class, isAdmin::class])->group(function () {
    Route::get('bills/meter/{customer}', [BillController::class, 'getMeter'])->name('bills.get-meter');
    Route::resource('bills', BillController::class);
});