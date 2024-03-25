<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nomor Seri</th>
            <th class="text-center">Biaya Tetap(IDR)</th>
            <th class="text-center">Sebelumnya (m<sup>3</sup>)</th>
            <th class="text-center">Saat Ini (m<sup>3</sup>)</th>
            <th class="text-center">Pemakaian (m<sup>3</sup>)</th>
            <th class="text-center">Biaya (IDR)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customer->meters as $i => $item)
            <tr>
                <td class="text-center">{{ ++$i }}</td>
                <td>
                    <input type="text" class="form-control form-control-sm" readonly style="cursor: not-allowed"
                        value="{{ $item->meter_number }}">
                    <input type="hidden" class="form-control form-control-sm"
                        name="meters[{{ $item->id }}][meter_id]" readonly style="cursor: not-allowed"
                        value="{{ $item->id }}">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm text-right" readonly
                        style="cursor: not-allowed" value="{{ $item->rate->fixed_fee }}"
                        name="meters[{{ $item->id }}][fixed_fee]">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-right"
                        name="meters[{{ $item->id }}][previous_reading]" readonly style="cursor: not-allowed"
                        value="{{ $item->current_reading }}">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-right"
                        name="meters[{{ $item->id }}][current_reading]" value="{{ $item->current_reading }}"
                        oninput="counting(this, `{{ json_encode(['master' => $item->rate, 'details' => $item->rate->rateDetails]) }}`)">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-right"
                        name="meters[{{ $item->id }}][consumption]" readonly style="cursor: not-allowed"
                        value="0">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-right"
                        name="meters[{{ $item->id }}][subtotal]" readonly style="cursor: not-allowed"
                        value="0">
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="6">Denda (IDR)</td>
            <td><input type="number" class="form-control form-control-sm text-right" name="late" id="late"
                    value="0" oninput="countTotal()">
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="6">Biaya Lainnya (IDR)</td>
            <td><input type="number" class="form-control form-control-sm text-right" name="other_charges"
                    id="other_charges" value="0" oninput="countTotal()">
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="6">Diskon (IDR)</td>
            <td><input type="number" class="form-control form-control-sm text-right" name="discount" id="discount"
                    value="0" oninput="countTotal()">
            </td>
        </tr>
        <tr>
            <td class="text-right" colspan="6">Total Tagihan (IDR)</td>
            <td><input type="number" class="form-control form-control-sm text-right" style="cursor: not-allowed"
                    id="total_amount" readonly value="0" name="total_amount">
            </td>
        </tr>
    </tfoot>
</table>
