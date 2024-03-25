@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('rates.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Golongan</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror"
                                        placeholder="Cth: Rumah Tangga A" name="type" value="{{ old('type') }}">
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal Tarif Berlaku</label>
                                    <div class="d-flex">
                                        <input type="text"
                                            class="datepicker form-control @error('effective_date') is-invalid @enderror"
                                            id="effective_date" placeholder="dd/mm/yyyy" name="effective_date"
                                            autocomplete="off" value="{{ old('effective_date') }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                    @error('effective_date')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Biaya Tetap (IDR)</label>
                                    <input type="number" class="form-control @error('fixed_fee') is-invalid @enderror"
                                        placeholder="Abodement" name="fixed_fee" value="{{ old('fixed_fee') }}">
                                    @error('fixed_fee')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <td style="width: 5%" class="text-center">No</td>
                                            <td class="text-center">Keterangan</td>
                                            <td style="width: 20%" class="text-center">Batas Ambang (m<sup>3</sup>)</td>
                                            <td style="width: 20%" class="text-center">Biaya (IDR)</td>
                                            <td style="width: 5%" class="text-center"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-id="1">
                                            <td class="text-center">1</td>
                                            <td><input type="text" class="form-control form-control-sm"
                                                    name="details[1][description]"></td>
                                            <td><input type="number" class="form-control form-control-sm text-right"
                                                    name="details[1][threshold_limit]"></td>
                                            <td><input type="number" class="form-control form-control-sm text-right"
                                                    name="details[1][price]"></td>
                                            <td><button type="button"
                                                    class="btn btn-xs btn-danger btn-remove-row">X</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary btn-add-row">Tambah
                                                    Baris</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-dark">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <link href="{{ asset('library/theme/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('library/theme/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });

        $('.btn-add-row').on('click', function() {
            const lastRow = $('tbody tr:last').data('id') ?? 0;
            const rowNum = lastRow + 1;
            const template = `
                <tr data-id="${rowNum}">
                    <td class="text-center">${rowNum}</td>
                    <td><input type="text" class="form-control form-control-sm"
                            name="details[${rowNum}][description]"></td>
                    <td><input type="number" class="form-control form-control-sm text-right"
                            name="details[${rowNum}][threshold_limit]"></td>
                    <td><input type="number" class="form-control form-control-sm text-right"
                            name="details[${rowNum}][price]"></td>
                    <td><button type="button"
                            class="btn btn-xs btn-danger btn-remove-row">X</button>
                    </td>
                </tr>
            `;
            $('tbody').append(template)
        })

        $('.btn-remove-row').on('click', function() {
            $(this).parents('tr').remove();
        })
    </script>
@endpush
