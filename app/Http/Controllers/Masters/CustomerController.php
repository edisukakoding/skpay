<?php

namespace App\Http\Controllers\Masters;

use App\Models\Rate;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::query()->orderBy('created_at', 'desc')->get();
        return view('masters.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masters.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'customer_type' => 'required|in:Perumahan,Komersil,Industri',
            'name' => 'required|min:3',
            'block' => 'required|unique:customers,block',
            'address' => 'required',
            'phone' => 'required|min:10|unique:customers,phone',
            'email' => 'required|email|unique:customers,email',
        ]);

        $data = $request->all();
        $data['block'] = strtoupper($data['block']);
        $customer = Customer::create($data);
        if ($customer) {
            User::create([
                'email' => $customer->email,
                'name' => $customer->name,
                'password' => Hash::make('pda12345'),
                'email_verified_at' => now(),
                'role' => 'user'
            ]);
            return redirect()
                ->route('customers.index')
                ->with(['status' => 'success', 'message' => 'Pelanggan baru berhasil ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('masters.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $rates = Rate::whereStatus(true)->get();
        return view('masters.customers.edit', compact('customer', 'rates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nik' => 'required',
            'customer_type' => 'required|in:Perumahan,Komersil,Industri',
            'name' => 'required|min:3',
            'block' => 'required|unique:customers,block,' . $customer->id,
            'address' => 'required',
            'phone' => 'required|min:10|unique:customers,phone,' . $customer->id,
            'email' => 'required|email|unique:customers,email, ' . $customer->id,
        ]);

        if ($customer->email !== $request->post('email')) {
            $user = User::whereEmail($customer->email)->first();
            $user->email = $request->post('email');
            $user->save();
        }

        $data = $request->all();
        $data['block'] = strtoupper($data['block']);
        $customer->fill($data);
        $customer->save();
        return redirect()->route('customers.index')->with(['status' => 'success', 'message' => 'Pelanggan berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function setStatus(Request $request, Customer $customer)
    {
        if ($customer->status) {
            $customer->status = false;
        } else {
            $customer->status = true;
        }

        if ($customer->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Status pelanggan berhasil diubah']);
        }

        return abort(500);
    }
}
