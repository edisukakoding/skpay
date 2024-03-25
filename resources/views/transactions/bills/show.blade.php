<div class="modal fade" id="modal-detail-rate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Rates</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td>Type&nbsp;</td>
                        <td>:&nbsp;{{ $rate->type }}</td>
                    </tr>
                    <tr>
                        <td>Effective Date&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->effective_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Expiration Date&nbsp;</td>
                        <td>:&nbsp;{{ $rate->expiration_date ? Carbon\Carbon::parse($rate->expiration_date)->format('d/m/Y') : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Unit Price&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($rate->unit_price, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Fixed Fee&nbsp;</td>
                        <td>:&nbsp;Rp. {{ number_format($rate->fixed_fee, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Discounts&nbsp;</td>
                        <td>:&nbsp;{{ $rate->dicounts }}%</td>
                    </tr>
                    <tr>
                        <td>Tax Rate&nbsp;</td>
                        <td>:&nbsp;{{ $rate->tax_rate }}%</td>
                    </tr>
                    <tr>
                        <td>Exceptions&nbsp;</td>
                        <td>:&nbsp;{{ $rate->exceptions }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">Tier&nbsp;</td>
                        <td>
                            @if ($rate->tier_thresholds)
                                @foreach (json_decode($rate->tier_thresholds) as $i => $item)
                                    @if ($loop->first)
                                        :&nbsp;Biaya Meter Antara (0 - {{ $item }}) m<sup>3</sup> :
                                        Rp. {{ number_format(json_decode($rate->tier_prices)[$i], '2', ',', '.') }}
                                    @elseif ($loop->last)
                                        <br />&nbsp; Biaya Meter Lebih
                                        (> {{ $item }})
                                        m<sup>3</sup> :
                                        Rp. {{ number_format(json_decode($rate->tier_prices)[$i], '2', ',', '.') }}
                                    @else
                                        <br />&nbsp; Biaya Meter Antara
                                        ({{ json_decode($rate->tier_thresholds)[$i - 1] }}
                                        - {{ $item }})
                                        m<sup>3</sup> :
                                        Rp. {{ number_format(json_decode($rate->tier_prices)[$i], '2', ',', '.') }}
                                    @endif
                                @endforeach
                            @else
                                :
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Remakrs&nbsp;</td>
                        <td>:&nbsp;{{ $rate->remarks }}</td>
                    </tr>
                    <tr>
                        <td>Status&nbsp;</td>
                        <td>:&nbsp;{!! $rate->status
                            ? '<span class="badge badge-success"><i class="icon-check"></i> Active</span></td>'
                            : '<span class="badge badge-danger"><i class="icon-close"></i> Non-Active</span></td>' !!}
                    </tr>
                    <tr>
                        <td>Created At&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->created_at)->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <td>Updated At&nbsp;</td>
                        <td>:&nbsp;{{ Carbon\Carbon::parse($rate->updated_at)->diffForHumans() }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
