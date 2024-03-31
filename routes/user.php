<?php

use App\Http\Middleware\isUser;
use App\Models\Bill;
use App\Models\Meter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

Route::middleware([Authenticate::class, isUser::class])->group(function () {
    Route::get('/', function () {
        $bill = Bill::whereCustomerId(Auth::user()->customer->id)->orderBy('created_at', 'desc')->first();
        $meters = Meter::whereCustomerId(Auth::user()->customer->id)->get();
        return view('clients.index', compact('bill', 'meters'));
    });
});