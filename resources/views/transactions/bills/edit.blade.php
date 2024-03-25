@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Rate</h4>
                    <div class="basic-form">
                        <form action="{{ route('rates.update', ['rate' => $rate->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Type</label>
                                    <select id="type" class="form-control @error('type') is-invalid @enderror"
                                        name="type">
                                        <option value="Standard"
                                            {{ old('type') || $rate->type === 'Standard' ? 'selected' : '' }}>Standard
                                        </option>
                                        <option value="Discounted"
                                            {{ old('type') || $rate->type === 'Discounted' ? 'selected' : '' }}>
                                            Discounted
                                        </option>
                                        <option value="Tiered"
                                            {{ old('type') || $rate->type === 'Tiered' ? 'selected' : '' }}>Tiered
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Effective Date</label>
                                    <div class="d-flex">
                                        <input type="text"
                                            class="datepicker form-control @error('effective_date') is-invalid @enderror"
                                            id="effective_date" placeholder="dd/mm/yyyy" name="effective_date"
                                            value="{{ old('effective_date', \Carbon\Carbon::parse($rate->effective_date)->format('d/m/Y')) }}">
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
                                    <label>Expiration Date</label>
                                    <div class="d-flex">
                                        <input type="text"
                                            class="datepicker form-control @error('expiration_date') is-invalid @enderror"
                                            id="expiration_date" placeholder="dd/mm/yyyy" name="expiration_date"
                                            value="{{ old('expiration_date', $rate->expiration_date ? \Carbon\Carbon::parse($rate->expiration_date)->format('d/m/Y') : null) }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                    @error('expiration_date')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Unit Price</label>
                                    <input type="number" class="form-control @error('unit_price') is-invalid @enderror"
                                        placeholder="Unit Price" name="unit_price"
                                        value="{{ old('unit_price', $rate->unit_price) }}">
                                    @error('unit_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Fixed Fee</label>
                                    <input type="number" class="form-control @error('fixed_fee') is-invalid @enderror"
                                        placeholder="Fixed Fee" name="fixed_fee"
                                        value="{{ old('fixed_fee', $rate->fixed_fee) }}">
                                    @error('fixed_fee')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Discounts (%)</label>
                                    <input type="number" class="form-control @error('discounts') is-invalid @enderror"
                                        placeholder="Discounts" name="discounts"
                                        value="{{ old('discounts', $rate->discounts) }}">
                                    @error('discounts')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Exceptions</label>
                                    <input type="text" class="form-control @error('exceptions') is-invalid @enderror"
                                        placeholder="Exceptions" name="exceptions"
                                        value="{{ old('exceptions', $rate->exceptions) }}">
                                    @error('exceptions')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tax Rate (%)</label>
                                    <input type="number" class="form-control @error('tax_rate') is-invalid @enderror"
                                        placeholder="Tax Rate" name="tax_rate"
                                        value="{{ old('tax_rate', $rate->tax_rate) }}">
                                    @error('tax_rate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <table style="width: 100%" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Tier Thresholds (m<sup>3</sup>)</td>
                                                <td>Tier Prices (IDR/m<sup>3</sup>)</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($rate->tier_thresholds)
                                                @foreach (json_decode($rate->tier_thresholds) as $i => $item)
                                                    @php
                                                        $level = $i;
                                                        $level = $level + 1;
                                                    @endphp
                                                    @if ($loop->first)
                                                        <tr>
                                                            <td><input type="number" class="form-control"
                                                                    placeholder="Level {{ $level }}"
                                                                    name="tier_thresholds[]"
                                                                    data-level="{{ $level }}"
                                                                    value="{{ $item }}"></td>
                                                            <td><input type="number" class="form-control"
                                                                    placeholder="Price" name="tier_prices[]"
                                                                    value="{{ json_decode($rate->tier_prices)[$i] }}"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    id="add-input">+</button>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td><input type="number" class="form-control"
                                                                    placeholder="Level {{ $level }}"
                                                                    name="tier_thresholds[]"
                                                                    data-level="{{ $level }}"
                                                                    value="{{ $item }}"></td>
                                                            <td><input type="number" class="form-control"
                                                                    placeholder="Price" name="tier_prices[]"
                                                                    value="{{ json_decode($rate->tier_prices)[$i] }}">
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td><input type="number" class="form-control" placeholder="Level 1"
                                                            name="tier_thresholds[]" data-level="1"></td>
                                                    <td><input type="number" class="form-control" placeholder="Price"
                                                            name="tier_prices[]"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary"
                                                            id="add-input">+</button>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control @error('remarks') is-invalid @enderror"
                                        placeholder="Remarks" name="remarks"
                                        value="{{ old('remarks', $rate->remarks) }}">
                                    @error('remarks')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="css-control css-control-primary css-checkbox" for="status">
                                        <input type="checkbox" class="css-control-input" id="status" name="status"
                                            @checked($rate->status)> <span
                                            class="css-control-indicator"></span>&nbsp;Active</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark">Update</button>
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
        jQuery('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });

        $('#add-input').on('click', function() {
            const level = parseInt($('tbody tr:last td:first input').data('level')) + 1;
            const placeholder = `Level ${level}`;
            $('tbody').append(`
                <tr>
                    <td><input type="number" class="form-control" placeholder="${placeholder}" name="tier_thresholds[]" data-level="${level}"></td>
                    <td><input type="number" class="form-control" placeholder="Price" name="tier_prices[]"></td> 
                    <td></td>
                </tr>
            `)
        })
    </script>
@endpush
