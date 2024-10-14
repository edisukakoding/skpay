@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Nomor Transaksi&nbsp;</td>
                            <td>:&nbsp;<strong>{{ $payment->bill->uuid }}</strong></td>
                        </tr>
                        <tr>
                            <td>Pelanggan&nbsp;</td>
                            <td>:&nbsp;{{ $payment->customer->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Tagihan&nbsp;</td>
                            <td>:&nbsp;{{ Carbon\Carbon::parse($payment->bill->bill_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Jatuh Tempo&nbsp;</td>
                            <td>:&nbsp;{{ Carbon\Carbon::parse($payment->bill->due_date)->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Denda (IDR)&nbsp;</td>
                            <td>:&nbsp;Rp. {{ number_format($payment->bill->late, '2', ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Lainnya (IDR)&nbsp;</td>
                            <td>:&nbsp;Rp. {{ number_format($payment->bill->other_charges, '2', ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Diskon (IDR)&nbsp;</td>
                            <td>:&nbsp;Rp. {{ number_format($payment->bill->discount, '2', ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Total Biaya (IDR)&nbsp;</td>
                            <td>:&nbsp;<strong>Rp. {{ number_format($payment->bill->total_amount, '2', ',', '.') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>Status&nbsp;</td>
                            <td>:&nbsp;<span class="badge badge-success">{{ $payment->bill->status }}</span>
                            </td>
                        </tr>
                        @if ($payment->bill->payment_method)
                            <tr>
                                <td>Metode Pembayaran&nbsp;</td>
                                <td>:&nbsp;{{ $payment->bill->payment_method }}</td>
                            </tr>
                            <tr>
                                <td>Dibayar pada&nbsp;</td>
                                <td>:&nbsp;{{ Carbon\Carbon::parse($payment->bill->payment_date)->format('d/m/Y H:i:s') }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>Dibuat pada&nbsp;</td>
                            <td>:&nbsp;{{ Carbon\Carbon::parse($payment->bill->created_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td>Dibuat Oleh&nbsp;</td>
                            <td>:&nbsp;{{ $payment->bill->user->name }}</td>
                        </tr>
                    </table>
                    <br>
                    @if ($payment->verification)
                        <button class="btn btn-block btn-success"><i class="icon-check"></i>
                            Terverifikasi</button>
                    @else
                        <form action="{{ route('payments.update', ['payment' => $payment->id]) }}" method="POST"
                            onsubmit="return confirm('Verifikasi Pembayaran?')">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-block btn-outline-warning">Verifikasi</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
