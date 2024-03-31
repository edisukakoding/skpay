<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transactions\MidtransWebhookController;

Route::prefix('midtrans')->group(function () {
    Route::post('webhook', MidtransWebhookController::class);
});