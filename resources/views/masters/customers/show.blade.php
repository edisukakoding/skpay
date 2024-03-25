<div class="modal fade" id="modal-detail-customer">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Tipe Pelanggan&nbsp;</td>
                        <td>:&nbsp;{{ $customer->customer_type }}</td>
                    </tr>
                    <tr>
                        <td>NIK&nbsp;</td>
                        <td>:&nbsp;{{ $customer->nik }}</td>
                    </tr>
                    <tr>
                        <td>Nama&nbsp;</td>
                        <td>:&nbsp;{{ $customer->name }}
                        </td>
                    </tr>
                    <tr>
                        <td>No. HP&nbsp;</td>
                        <td>:&nbsp;{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <td>Email&nbsp;</td>
                        <td>:&nbsp;{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <td>Blok&nbsp;</td>
                        <td>:&nbsp;{{ $customer->block }}</td>
                    </tr>
                    <tr>
                        <td>Alamat&nbsp;</td>
                        <td>:&nbsp;{{ $customer->address }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pembayaran Terakhir&nbsp;</td>
                        <td>:&nbsp;{{ $customer->last_payment_date ? \Carbon\Carbon::parse($customer->last_payment_date)->format('d/m/Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Total Tunggakan&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($customer->total_pending_bills, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Diubah pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($customer->updated_at)->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
