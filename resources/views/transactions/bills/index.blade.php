@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-between" style="margin-bottom: -20px">
                            <a href="{{ route('bills.create') }}" class="btn btn-primary" style="margin-left: 30px">Create</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration table-sm" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Tanggal Tagihan</th>
                                    <th class="text-center">Jatuh Tempo</th>
                                    <th class="text-center">Pelanggan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Total Bayar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $i => $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->bill_date)->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->due_date)->format('d/m/Y') }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge @if ($item->status === 'settlement') badge-success @elseif ($item->status === 'pending') badge-dark @else badge-danger @endif text-white">
                                                <strong>{{ strtoupper($item->status) }}</strong>
                                            </span>
                                        </td>
                                        <td class="text-right">Rp. {{ number_format($item->total_amount, '2', ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-outline-info btn-detail"
                                                data-id="{{ $item->id }}">Detail</button>
                                            <a href="{{ route('bills.edit', ['bill' => $item->id]) }}"
                                                class="btn btn-xs btn-outline-warning">Edit</a>
                                            <form action="{{ route('bills.destroy', ['bill' => $item->id]) }}"
                                                method="POST" style="display: inline"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-xs">Delete</button>
                                            </form>
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
    <script>
        $('.btn-detail').on('click', function() {
            const id = $(this).data('id')
            $.get('{{ route('bills.show', ['bill' => ':id']) }}'.replace(':id', id), function(response) {
                $('.modal-place').html(response)
                $('#modal-detail-bill').modal('toggle')
            })
        })
    </script>
@endpush
