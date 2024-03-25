<div class="modal fade" id="modal-detail-rate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Tarif</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="mb-3">
                    <tr>
                        <td>Golongan&nbsp;</td>
                        <td>:&nbsp;{{ $rate->type }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Tarif Berlaku&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->effective_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Biaya Tetap (Abodement)&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($rate->fixed_fee, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status&nbsp;</td>
                        <td>:&nbsp;{!! $rate->status
                            ? '<span class="badge badge-success"><i class="icon-check"></i> Active</span></td>'
                            : '<span class="badge badge-danger"><i class="icon-close"></i> Non-Active</span></td>' !!}
                    </tr>
                    <tr>
                        <td>Dibuat pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->created_at)->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Diubah pada&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->updated_at)->diffForHumans() }}</td>
                    </tr>
                </table>
                <table class="table-table-sm table-bordered table-hover table-stripped" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Rincian</th>
                            <th class="text-center">Batas Ambang (m<sup>3</sup>)</th>
                            <th class="text-center">Biaya (IDR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rate->rateDetails as $i => $item)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-right">{{ $item->threshold_limit }}</td>
                                <td class="text-right">Rp. {{ number_format($item->price, '2', ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
