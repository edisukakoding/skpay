<?php

namespace App\Http\Controllers\Masters;

use App\Models\RateDetail;
use Carbon\Carbon;
use Psy\Util\Json;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::query()->orderBy('created_at', 'asc')->get();
        return view('masters.rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masters.rates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|unique:rates,type',
            'effective_date' => 'required|date_format:d/m/Y',
            'fixed_fee' => 'required|numeric',
            'details.*.description' => 'required',
            'details.*.threshold_limit' => 'required',
            'details.*.price' => 'required',
        ]);
        $data = $request->all();
        $data['effective_date'] = Carbon::createFromFormat('d/m/Y', $data['effective_date']);

        try {
            DB::beginTransaction();
            $rate = Rate::create($data);
            foreach ($data['details'] as $detail) {
                RateDetail::create([
                    'rate_id' => $rate->id,
                    'description' => $detail['description'],
                    'threshold_limit' => $detail['threshold_limit'],
                    'price' => $detail['price']
                ]);
            }

            DB::commit();
            return redirect()->route('rates.index')->with(['status' => 'success', 'message' => 'Tarif telah ditambahkan']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rate $rate)
    {
        return view('masters.rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        return view('masters.rates.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        $request->validate([
            'type' => 'required|unique:rates,type,' . $rate->id,
            'effective_date' => 'required|date_format:d/m/Y',
            'fixed_fee' => 'required|numeric',
            'details.*.description' => 'required',
            'details.*.threshold_limit' => 'required',
            'details.*.price' => 'required',
        ]);
        $data = $request->all();
        $data['effective_date'] = Carbon::createFromFormat('d/m/Y', $data['effective_date']);

        try {
            DB::beginTransaction();
            $rate->fill($data);
            $rate->save();
            RateDetail::whereRateId($rate->id)->delete();
            foreach ($data['details'] as $detail) {
                RateDetail::create([
                    'rate_id' => $rate->id,
                    'description' => $detail['description'],
                    'threshold_limit' => $detail['threshold_limit'],
                    'price' => $detail['price']
                ]);
            }

            DB::commit();
            return redirect()->route('rates.index')->with(['status' => 'success', 'message' => 'Tarif berhasil diubah']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        try {
            RateDetail::whereRateId($rate->id)->delete();
            $rate->delete();
            return redirect()->back()->with(['status' => 'success', 'message' => 'Tarif Berhasil dihapus']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['status' => 'failed', 'message' => $e->getMessage()]);
        }
    }

    public function setStatus(Request $request, Rate $rate)
    {
        if ($rate->status) {
            $rate->status = false;
        } else {
            $rate->status = true;
        }

        if ($rate->save()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Status tarif berhasil diubah']);
        }

        return abort(500);
    }
}
