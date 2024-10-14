@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Total Terbayarkan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp.
                            {{ number_format(App\Models\Payment::sum('payment_amount'), '2', ',', '.') }}</h2>
                        <p class="text-white mb-0">Nov 2024 - {{ Carbon\Carbon::now()->isoFormat('MMM Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Pelanggan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ App\Models\Customer::count() }}</h2>
                        <p class="text-white mb-0">Nov 2024 - {{ Carbon\Carbon::now()->isoFormat('MMM Y') }}</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('library/theme/js/dashboard/dashboard-1.js') }}"></script>
@endpush
