<?php

namespace App\Http\Controllers\Transactions;

use App\Models\Bill;
use App\Models\Meter;
use Nette\Utils\Json;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\MidtransLog;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MidtransWebhookController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $payload = $request->all();
        MidtransLog::create($payload);

        $signature = hash('SHA512', $payload['order_id'] . $payload['status_code'] . $payload['gross_amount'] . env('MIDTRANS_SERVER_KEY'));

        if ($signature !== $payload['signature_key']) {
            return response()->json(['status' => false, 'message' => 'Signature failed'], 401);
        }

        $bill = Bill::whereUuid($payload['order_id'])->first();

        if ($bill === null) {
            return response()->json(['status' => false, 'message' => 'Bill not found'], 400);
        }

        if ($payload['transaction_status'] === 'settlement') {
            $bill->status = 'settlement';
            $bill->payment_date = now();
            $bill->payment_method = $payload['payment_type'];
            $bill->save();
            foreach ($bill->billDetails as $item) {
                $meter = Meter::whereId($item->meter_id)->first();
                $meter->previous_reading = $item->current_reading;
                $meter->current_reading;
                $meter->save();
            }

            $payment = Payment::create([
                'customer_id' => $bill->customer_id,
                'payment_date' => $payload['settlement_time'],
                'payment_amount' => $payload['gross_amount'],
                'payment_method' => $payload['payment_type'],
                'bill_id' => $bill->id,
                'record_date' => now(),
            ]);

            $customer = Customer::find($bill->customer_id);
            $customer->last_payment_date = $payload['settlement_time'];
            $customer->save();

            Notification::create([
                'title' => $customer->name . ' Melakukan Pembayaran',
                'message' => Json::encode($payment),
                'notification_time' => now(),
                'type' => 'success',
                'redirect' => route('payments.edit', ['payment' => $payment->id])
            ]);

        } else if (in_array($payload['transaction_status'], ['cancel', 'deny', 'expire'])) {
            $bill->status = $payload['transaction_status'];
            $bill->save();
        } else {
            $bill->status = 'pending';
            $bill->save();
        }

        return response()->json(['status' => true, 'message' => 'success']);
    }
}
