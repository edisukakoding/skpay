@extends('clients.layouts.app')

@section('content')
    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <div class="card" style="display: flex; justify-content: center">
            <div style="display: flex; justify-content: center; align-items: center;margin: 20px">
                <span class="icon icon-info" style="color: #777"></span>
                <h4 style="margin-top: unset;margin-bottom: unset;margin-left: 10px; color: #777">
                    Riwayat Pembayaran</h4>
            </div>
        </div>
        @if (count($payments) > 0)
            <div class="card">
                <ul class="table-view">
                    @foreach ($payments as $item)
                        <li class="table-view-cell" style="padding-right: 18px">
                            {{ $item->bill->title }}
                            <table style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td>Tanggal Pembayaran</td>
                                        <td style="text-align: right">
                                            {{ $item->payment_date->translatedFormat('d F Y, H:i') . ' WIB' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td style="text-align: right">
                                            Rp. {{ number_format($item->payment_amount, '2', ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td style="text-align: right">
                                            {!! $item->verification
                                                ? '<span class="badge badge-positive">Sudah di verifikasi</span>'
                                                : '<span class="badge">Belum di verifikasi</span>' !!}
                                        </td>
                                    </tr>
                            </table>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="card">
                <p class="content-padded">
                    <span class="icon icon-info"></span>
                    Belum ada riwayat pembayaran
                </p>
            </div>
        @endif

    </div>
    @include('clients.layouts.navigation')
@endsection
