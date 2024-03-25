<?php

namespace App\Http\Controllers\Masters;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Meter;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MeterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meters = Meter::query()->orderBy('created_at', 'desc')->get();
        return view('masters.meters.index', compact('meters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masters.meters.create', [
            'customers' => Customer::whereStatus(true)->get(),
            'rates' => Rate::whereStatus(true)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'meter_number' => 'required',
            'installation_date' => 'required|date_format:d/m/Y',
            'brand' => 'required',
            'location' => 'required',
            'meter_type' => 'required|in:Digital,Analog',
            'rate_id' => 'required|exists:rates,id'
        ]);

        $data = $request->all();
        $data['installation_date'] = Carbon::createFromFormat('d/m/Y', $data['installation_date']);
        Meter::create($data);
        return redirect()->route('meters.index')->with(['status' => 'success', 'message' => 'Meteran baru ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meter $meter)
    {
        return view('masters.meters.show', compact('meter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meter $meter)
    {
        $customers = Customer::whereStatus(true)->get();
        $rates = Rate::whereStatus(true)->get();

        return view('masters.meters.edit', compact('meter', 'customers', 'rates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meter $meter)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'meter_number' => 'required',
            'installation_date' => 'required|date_format:d/m/Y',
            'brand' => 'required',
            'location' => 'required',
            'meter_type' => 'required|in:Digital,Analog',
            'rate_id' => 'required|exists:rates,id'
        ]);

        $data = $request->all();
        $data['installation_date'] = Carbon::createFromFormat('d/m/Y', $data['installation_date']);
        $meter->fill($data);
        $meter->save();
        return redirect()->route('meters.index')->with(['status' => 'success', 'message' => 'Meteran diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meter $meter)
    {
        if ($meter->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Meteran berhasil dihapus']);
        }

        return abort(500);
    }

    public function setStatus(Request $request, Meter $meter)
    {
        if ($meter->status) {
            $meter->status = false;
        } else {
            $meter->status = true;
        }

        if ($meter->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Status meteran diubah']);
        }

        return abort(500);
    }
}
