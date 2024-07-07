@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('bills.store') }}" method="POST"
                            onsubmit="return confirm('Mohon pastikan data sudah benar. \nTagihan yang sudah dikirim ke pelanggan tidak akan bisa diubah')">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Cth: Pembayaran Bulan Januari 2024" name="title"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pelanggan</label>
                                    <select id="customer_id"
                                        class="form-control select2 @error('customer_id') is-invalid @enderror"
                                        name="customer_id">
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('customer_id') === $item->id ? 'selected' : '' }}>
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
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Tagihan</label>
                                    <div class="d-flex">
                                        <input type="text" class="form-control @error('bill_date') is-invalid @enderror"
                                            id="bill_date" placeholder="dd/mm/yyyy" name="bill_date"
                                            value="{{ old('bill_date', date('d/m/Y')) }}" autocomplete="off" readonly>
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                    @error('bill_date')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tanggal Jatuh Tempo</label>
                                    <div class="d-flex">
                                        <input type="text"
                                            class="datepicker form-control @error('due_date') is-invalid @enderror"
                                            id="due_date" placeholder="dd/mm/yyyy" name="due_date"
                                            value="{{ old('due_date') }}" autocomplete="off">
                                        <span class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-calendar-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                    @error('due_date')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12" id="meter-input">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-dark">Buat Tagihan</button>
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
        jQuery('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd/mm/yyyy'
        });
        $(document).ready(function() {
            $('.select2').select2();
            $('#customer_id').on('change', function() {
                $.get('{{ route('bills.get-meter', ['customer' => ':customer']) }}'.replace(':customer', $(
                    this).val()), function(res) {
                    $('#meter-input').html(res)
                })
            })
        });

        function counting(e, rate) {
            const rates = JSON.parse(rate)
            const consumption = $(e).parents('td').next().children();
            const previous = parseFloat($($(e).parents('td').prev().children()).val());
            const subtotalEl = $(e).parents('tr').children().last().children();
            const current = parseFloat($(e).val()) - previous;

            let total = 0;
            let remain = [];
            let lastVal = 0;
            let subtotal = rates.master.fixed_fee;
            rates.details.forEach(function(v, i) {
                if (current - v.threshold_limit > 0 && rates.details.length - 1 !== i) {
                    remain.push(v.threshold_limit);
                    lastVal = current - v.threshold_limit
                }
            })
            if (lastVal > 0) {
                remain.push(lastVal)
            } else {
                remain.push(current)
            }
            for (let i = 0; i < remain.length; i++) {
                subtotal = subtotal + (remain[i] * rates.details[i].price)
            }

            $(consumption).val(current)
            $(subtotalEl).val(subtotal)

            $('tbody tr').each(function() {
                total = total + parseFloat($(this).children().last().children().val());
            })

            $('#total_amount').val(total)
        }

        function countTotal() {
            const late = parseFloat($('#late').val());
            const other_charges = parseFloat($('#other_charges').val());
            const discount = parseFloat($('#discount').val());
            let total = 0;

            $('tbody tr').each(function() {
                total = total + parseFloat($(this).children().last().children().val());
            })

            total = total + late + other_charges;
            if (discount !== 0) {
                total = total - discount
            }
            $('#total_amount').val(total)
        }
    </script>
@endpush
