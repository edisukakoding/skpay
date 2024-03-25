@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('meters.update', ['meter' => $meter->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Pelanggan</label>
                                    <select id="customer_id"
                                        class="form-control select2 @error('customer_id') is-invalid @enderror"
                                        name="customer_id">
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('customer_id', $meter->customer_id) === $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Merek</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                        placeholder="Merek" name="brand" value="{{ old('brand', $meter->brand) }}">
                                    @error('brand')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tipe Meteran</label>
                                    <select id="meter_type" class="form-control @error('meter_type') is-invalid @enderror"
                                        name="meter_type">
                                        <option value="Digital"
                                            {{ old('meter_type', $meter->meter_type) === 'Digital' ? 'selected' : '' }}>
                                            Digital
                                        </option>
                                        <option value="Analog"
                                            {{ old('meter_type', $meter->meter_type) === 'Analog' ? 'selected' : '' }}>
                                            Analog
                                        </option>
                                    </select>
                                    @error('meter_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Meter Number</label>
                                    <input type="text" class="form-control @error('meter_number') is-invalid @enderror"
                                        placeholder="Meter Number" name="meter_number"
                                        value="{{ old('meter_number', $meter->meter_number) }}">
                                    @error('meter_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Tarif</label>
                                    <select id="rate_id" class="form-control @error('rate_id') is-invalid @enderror"
                                        name="rate_id">
                                        @foreach ($rates as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('rate_id', $meter->rate_id) === $item->id ? 'selected' : '' }}>
                                                {{ $item->type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rate_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Installation Date</label>
                                    <div class="d-flex">
                                        <input type="text"
                                            class="datepicker form-control @error('installation_date') is-invalid @enderror"
                                            id="installation_date" placeholder="dd/mm/yyyy" name="installation_date"
                                            value="{{ old('installation_date', \Carbon\Carbon::parse($meter->installation_date)->format('d/m/Y')) }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                    @error('installation_date')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        placeholder="Location" name="location"
                                        value="{{ old('location', $meter->location) }}">
                                    @error('location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control @error('remarks') is-invalid @enderror"
                                        placeholder="Remarks" name="remarks" value="{{ old('remarks', $meter->remarks) }}">
                                    @error('remarks')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-styles')
    <link href="{{ asset('library/theme/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #777777;
            line-height: 44px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 1px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('library/theme/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
