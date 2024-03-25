<?php

use App\Models\Bill;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', function () {
        $bill = Bill::whereCustomerId(Auth::user()->customer->id)->orderBy('created_at', 'desc')->first();
        return view('clients.index', compact('bill'));
    });

    Route::get('/redirect', function (Request $request) {
        $data = $request->all();
        $bill = Bill::whereUuid($data['order_id'])->first();
        $bill->status = $data['transaction_status'];
        if ($bill->save()) {
            return redirect('/');
        }
    });
});