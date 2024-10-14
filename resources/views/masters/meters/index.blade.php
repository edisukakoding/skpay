@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: -20px">
                            <a href="{{ route('meters.create') }}" class="btn btn-primary" style="margin-left: 30px">Tambah
                                Meteran</a>
                            <a href="{{ route('meters.generate') }}" class="btn btn-danger"
                                style="margin-left: 5px">Generate</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration table-sm" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Tarif</th>
                                    <th class="text-center">Pelanggan</th>
                                    <th class="text-center">No Seri</th>
                                    <th class="text-center">Tanggal Pemasangan</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meters as $i => $item)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        <td class="text-center">{{ $item->rate->type }}</td>
                                        <td class="text-left">{{ $item->customer->name }}</td>
                                        <td class="text-center">{{ $item->meter_number }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($item->installation_date)->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('meters.set-status', ['meter' => $item->id]) }}"
                                                method="POST" style="display: inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn btn-outline-{{ $item->status ? 'success' : 'dark' }} btn-xs">{{ $item->status ? 'Active' : 'Inactive' }}</button>
                                            </form>
                                            <button class="btn btn-xs btn-outline-info btn-detail"
                                                data-id="{{ $item->id }}">Detail</button>
                                            <a href="{{ route('meters.edit', ['meter' => $item->id]) }}"
                                                class="btn btn-xs btn-outline-warning">Edit</a>
                                            <form action="{{ route('meters.destroy', ['meter' => $item->id]) }}"
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
            $.get('{{ route('meters.show', ['meter' => ':id']) }}'.replace(':id', id), function(response) {
                $('.modal-place').html(response)
                $('#modal-detail-meter').modal('toggle')
            })
        })
    </script>
@endpush
