@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="pb-3">
            <div class="col">
                <form action="{{ route('brand.edit.detail', $brand->tblitembrand_id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="brand-code" class="col-form-label">{{ __('Kode Merek :') }}</label>
                        <input type="hidden" name="action" value="edit">
                        <input type="text" class="form-control Upper" id="brand-code" name="brandcode" maxlength="4"
                            value="{{ old('brandcode', $brand->tblitembrand_code) }}">

                    </div>
                    <div class="mb-3">
                        <label for="brand-name" class="col-form-label">{{ __('Nama Merek :') }}</label>

                        <input type="text" class="form-control" id="brand-name" name="brandname"
                            value=" {{ old('brandname', $brand->tblitembrand_name) }}">
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
