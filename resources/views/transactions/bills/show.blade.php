<div class="modal fade" id="modal-detail-bill">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Tagihan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Nomor Transaksi&nbsp;</td>
                        <td>:&nbsp;<strong>{{ $bill->uuid }}</strong></td>
                    </tr>
                    <tr>
                        <td>Pelanggan&nbsp;</td>
                        <td>:&nbsp;{{ $bill->customer->name }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Tagihan&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($bill->bill_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Jatuh Tempo&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($bill->due_date)->format('d/m/Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Denda (IDR)&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($bill->late, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Lainnya (IDR)&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($bill->other_charges, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Diskon (IDR)&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($bill->discount, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Total Biaya (IDR)&nbsp;</td>
                        <td>:&nbsp;<strong>Rp. {{ number_format($bill->total_amount, '2', ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td>Status&nbsp;</td>
                        <td>:&nbsp;<strong>{{ $bill->status }}</strong></td>
                    </tr>
                    @if ($bill->payment_method)
                        <tr>
                            <td>Metode Pembayaran&nbsp;</td>
                            <td>:&nbsp;{{ $bill->payment_method }}</td>
                        </tr>
                        <tr>
                            <td>Dibayar pada&nbsp;</td>
                            <td>:&nbsp;{{ Carbon\Carbon::parse($bill->payment_date)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Dibuat pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($bill->created_at)->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat Oleh&nbsp;</td>
                        <td>:&nbsp;{{ $bill->user->name }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
