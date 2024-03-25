@extends('layouts.quixlab')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('customers.update', ['customer' => $customer->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Tipe Pelanggan</label>
                                    <select id="customer_type"
                                        class="form-control @error('customer_type') is-invalid @enderror"
                                        name="customer_type">
                                        <option value="Perumahan"
                                            {{ old('customer_type', $customer->customer_type) === 'Perumahan' ? 'selected' : '' }}>
                                            Perumahan
                                        </option>
                                        <option value="Komersil"
                                            {{ old('customer_type', $customer->customer_type) === 'Komersil' ? 'selected' : '' }}>
                                            Komersil
                                        </option>
                                        <option value="Industri"
                                            {{ old('customer_type', $customer->customer_type) === 'Industri' ? 'selected' : '' }}>
                                            Industri
                                        </option>
                                    </select>
                                    @error('customer_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                        placeholder="Nomor Induk Kependudukan" name="nik"
                                        value="{{ old('nik', $customer->nik) }}">
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nama Pelanggan" name="name"
                                        value="{{ old('name', $customer->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Nomor HP" name="phone" value="{{ old('phone', $customer->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email" name="email" value="{{ old('email', $customer->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Blok</label>
                                    <input type="text" class="form-control @error('block') is-invalid @enderror"
                                        placeholder="Blok" name="block" value="{{ old('block', $customer->block) }}">
                                    @error('block')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        placeholder="Alamat Lengkap" name="address"
                                        value="{{ old('address', $customer->address) }}">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Catatan</label>
                                    <input type="text" class="form-control @error('remarks') is-invalid @enderror"
                                        placeholder="Catatan" name="remarks"
                                        value="{{ old('remarks', $customer->remarks) }}">
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
