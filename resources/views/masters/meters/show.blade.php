<div class="modal fade" id="modal-detail-meter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Meteran</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Tanggal Pemasangan&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($meter->installation_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Tipe Meteran&nbsp;</td>
                        <td>:&nbsp;{{ $meter->meter_type }}</td>
                    </tr>
                    <tr>
                        <td>Pelanggan&nbsp;</td>
                        <td>:&nbsp;{{ $meter->customer->name }}</td>
                    </tr>
                    <tr>
                        <td>Tarif&nbsp;</td>
                        <td>:&nbsp;{{ $meter->rate->type }}</td>
                    </tr>
                    <tr>
                        <td>Merek&nbsp;</td>
                        <td>:&nbsp;{{ $meter->meter_number }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi Pemasangan&nbsp;</td>
                        <td>:&nbsp;{{ $meter->location }}</td>
                    </tr>
                    <tr>
                        <td>Angka Meteran Terakhir&nbsp;</td>
                        <td>:&nbsp;{{ $meter->previous_reading }} m<sup>3</sup></td>
                    </tr>
                    <tr>
                        <td>Angka Meteran Saat Ini&nbsp;</td>
                        <td>:&nbsp;{{ $meter->current_reading }} m<sup>3</sup></td>
                    </tr>
                    <tr>
                        <td>Catatan&nbsp;</td>
                        <td>:&nbsp;{{ $meter->remarks }}</td>
                    </tr>
                    <tr>
                        <td>Status&nbsp;</td>
                        <td>:&nbsp;{!! $meter->status
                            ? '<span class="badge badge-success"><i class="icon-check"></i> Active</span></td>'
                            : '<span class="badge badge-danger"><i class="icon-close"></i> Non-Active</span></td>' !!}
                    </tr>
                    <tr>
                        <td>Dibuat pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($meter->created_at)->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Diubah pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($meter->updated_at)->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
