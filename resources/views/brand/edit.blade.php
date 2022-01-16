@extends('layouts.app')
@section('title')
Edit Merek
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('brand.edit.detail', $brand->tblitembrand_id) }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control upperText" for="brand-code" id="brand-code" name="brandcode"
                        maxlength="4" value="{{ old('brandcode', $brand->tblitembrand_code) }}"
                        placeholder="Kode Merek">
                    <label for="brand-code">Kode Merek</label>

                    <input type="hidden" name="action" value="edit">
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" for="brand-name" id="brand-name" name="brandname"
                        value="{{ old('brandname', $brand->tblitembrand_name) }}" placeholder="Nama Merek">
                    <label for="brand-name">Nama Merek</label>
                </div>
                @if ($errors->any() && old('action') == 'edit')
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                <a href="{{ route('brand') }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
