@extends('clients.layouts.app')

@section('content')
    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <div class="card" style="display: flex; justify-content: center">
            <div style="display: flex; justify-content: center; align-items: center;margin: 20px">
                <span class="icon icon-person" style="color: #777"></span>
                <h4 style="margin-top: unset;margin-bottom: unset;margin-left: 10px; color: #777">
                    {{ strtoupper(auth()->user()->customer->name) }}</h4>
            </div>
        </div>
        <div class="card">
            <p class="content-padded">
                <span class="icon icon-compose"></span>
                <strong>Tarif</strong>
            </p>
            <ul class="table-view" style="margin-top: -10px">
                @foreach ($bill->billDetails as $item)
                    <li class="table-view-cell" style="padding: 11px 10px 11px 15px;">
                        <table style="width: 100%">
                            <tr>
                                <td style="font-style: italic;text-decoration: underline">Informasi tarif untuk nomor meter:
                                    <strong>{{ $item->meter->meter_number }}</strong>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Biaya Tetap (Abodement)</td>
                                <td style="text-align: right">Rp.
                                    {{ number_format($item->meter->rate->fixed_fee, '2', ',', '.') }}
                                </td>
                            </tr>
                            @foreach ($item->meter->rate->rateDetails as $detail)
                                <tr>
                                    <td>{{ $detail->description }}</td>
                                    <td style="text-align: right">Rp. {{ number_format($detail->price, '2', ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <ul class="table-view">
                @foreach ($bill->billDetails as $item)
                    <li class="table-view-cell" style="padding: 11px 10px 11px 15px;">
                        <table style="width: 100%">
                            <tr>
                                <td>Nomor Meter</td>
                                <td style="text-align: right">{{ $item->meter->meter_number }}</td>
                            </tr>
                            <tr>
                                <td>Pemakaian Sebelumnya</td>
                                <td style="text-align: right">{{ $item->previous_reading }} m<sup>3</sup></td>
                            </tr>
                            <tr>
                                <td>Pemakaian Saat Ini</td>
                                <td style="text-align: right">{{ $item->current_reading }} m<sup>3</sup></td>
                            </tr>
                            <tr>
                                <td>Biaya Pemakaian</td>
                                <td style="text-align: right">Rp.
                                    {{ number_format($item->subtotal, '2', ',', '.') }}</td>
                            </tr>
                        </table>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card">
            <div class="content-padded">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <td>Denda</td>
                            <td style="text-align: right">Rp. {{ number_format($bill->late, '2', ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Lainnya</td>
                            <td style="text-align: right">Rp. {{ number_format($bill->other_charges, '2', ',', '.') }}</td>
                        </tr>
                        <tr style="border-bottom: 2px solid #cecece;">
                            <td>Diskon</td>
                            <td style="text-align: right">Rp. {{ number_format($bill->discount, '2', ',', '.') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Grand Total</td>
                            <td style="text-align: right"><strong>Rp.
                                    {{ number_format($bill->total_amount, '2', ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="content-padded">
            <button class="btn btn-primary btn-block"
                onclick="window.snap.pay(`{{ $bill->token }}`)"><strong>BAYAR</strong></button>
        </div>
        <div class="card">
            <p class="content-padded">
                <span class="icon icon-info"></span>
                Pembayaran tagihan air paling lambat tanggal 29 setiap bulannya . Setelah itu akan dikenakan biaya denda
                keterlambatan sebesar 10% dari nominal tagihan perbulan.
            </p>
        </div>
        <div class="card" style="margin-bottom: 70px">
            <p class="content-padded" style="font-style: italic;font-size: 12px">
                *Aplikasi masih dalam tahap pengembangan lebih lanjut. Jika mengalami kesulitan atau ketidaksesuaian
                data
                yang kami tampilkan, mohon hubungi admin kami.
            </p>
        </div>
    </div>
    @include('clients.layouts.navigation')
@endsection
