<?php

namespace App\Http\Controllers\Transactions;

use App\Models\Meter;
use Midtrans\Snap;
use App\Models\Bill;
use App\Models\Rate;
use Midtrans\Config;
use App\Models\Customer;
use App\Models\BillDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transactions.bills.index', ['bills' => Bill::query()->orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rates = Rate::whereStatus(true)->get();
        $customers = Customer::query()->orderBy('created_at', 'desc')->get();
        return view('transactions.bills.create', compact('rates', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'required',
            'bill_date' => 'required|date_format:d/m/Y',
            'due_date' => 'required|date_format:d/m/Y',
            'total_amount' => 'required',
        ]);
        $data = $request->all();
        $data['status'] = 'pending';
        $data['bill_date'] = Carbon::createFromFormat('d/m/Y', $data['bill_date']);
        $data['due_date'] = $data['due_date'] ? Carbon::createFromFormat('d/m/Y', $data['due_date']) : null;
        $data['user_id'] = Auth::user()->id;
        $data['uuid'] = Str::uuid();

        try {
            DB::beginTransaction();
            $bill = Bill::create($data);

            foreach ($request->post('meters') as $item) {
                $item['bill_id'] = $bill->id;
                BillDetail::create($item);
            }

            $total_amount = BillDetail::whereBillId($bill->id)->sum('subtotal');
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $bill->uuid,
                    'gross_amount' => $bill->total_amount
                ],
                'customer_details' => [
                    'first_name' => $bill->customer->name,
                    'email' => $bill->customer->email,
                    'phone' => $bill->customer->phone,
                    'billing_address' => [
                        'first_name' => $bill->customer->name,
                        'email' => $bill->customer->email,
                        'phone' => $bill->customer->phone,
                        'address' => $bill->customer->address
                    ]
                ],
                'item_details' => [
                    [
                        "name" => 'Denda',
                        "price" => $bill->late,
                        'quantity' => 1,
                        'id' => rand(),
                    ],
                    [
                        "name" => 'Biaya Lainnya',
                        "price" => $bill->other_charges,
                        'quantity' => 1,
                        'id' => rand(),
                    ],
                    [
                        "name" => 'Diskon',
                        "price" => -$bill->discount,
                        'quantity' => 1,
                        'id' => rand(),
                    ],
                    [
                        "name" => $bill->title,
                        "price" => $total_amount,
                        'quantity' => 1,
                        'id' => rand(),
                    ],
                ],
                'expiry' => [
                    'start_time' => $bill->bill_date->isoFormat('YYYY-MM-DD HH:mm:ss ZZ'),
                    'unit' => 'minutes',
                    'duration' => intval($bill->bill_date->diffInMinutes($bill->due_date)),
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $bill->token = $snapToken;
            if ($bill->save()) {
                DB::commit();
                return redirect()->route('bills.index')->with(['status' => 'success', 'message' => 'Bill has been created']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['status' => 'failed', 'message' => $e->getMessage()]);
        }

        return redirect()->back()->with(['status' => 'failed', 'message' => 'Failed to create bill']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return view('transactions.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $rates = Rate::whereStatus(true)->get();
        $customers = Customer::query()->orderBy('created_at', 'desc')->get();
        return view('transactions.bills.edit', compact('bill', 'rates', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getMeter(Customer $customer)
    {
        $meters = Meter::whereStatus(true)->whereCustomerId($customer->id)->get();
        return view('transactions.bills.meter', compact('meters'));
    }
}
