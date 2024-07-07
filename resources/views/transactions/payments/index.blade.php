@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration table-sm" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Pelanggan</th>
                                    <th class="text-center">Tanggal Pembayaran</th>
                                    <th class="text-center">Metode Pembayaran</th>
                                    <th class="text-center">Nominal</th>
                                    <th class="text-center">Verifikasi</th>
                                    <th class="text-center">Diverifikasi Oleh</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $i => $item)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->payment_date)->format('d/m/Y') }}</td>
                                        <td class="text-center">{{ $item->payment_method }}</td>
                                        <td class="text-right">Rp. {{ number_format($item->payment_amount, '2', ',', '.') }}
                                        </td>
                                        <td class="text-center">{!! $item->verification ? '<i class="icon-check text-success"></i>' : '<i class="icon-close text-danger"></i>' !!}</td>
                                        <td class="text-center">{{ $item?->user?->name }}</td>
                                        <td class="text-center">
                                            @if (!$item->verification)
                                                <a href="{{ route('payments.edit', ['payment' => $item->id]) }}"
                                                    class="btn btn-xs btn-outline-success">Verifikasi</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-place"></div>
@endsection

@push('styles')
    <link href="{{ asset('library/theme/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('library/theme/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/theme/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/theme/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
@endpush
