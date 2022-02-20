@extends('layouts.app')
@section('title')
Edit Model
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('model.edit.detail',$model->tblitemmodel_id) }}" method="POST">
                @csrf

                <div class="form-floating mb-3">

                    <select class="form-select" name="categorycode" id="category-code">
                        @foreach ($codeCategory as $key => $row)
                        <option value="{{ $row->tblitemcategory_id }}" {{ $model->tblitemcategory_id == ($key+1) ?
                            'selected' : '' }}>
                            {{ $row->tblitemcategory_code }} -
                            {{ $row->tblitemcategory_name }}</option>
                        @endforeach
                    </select>
                    <label for="category-code" class="form-label">Kode Kategori</label>
                </div>
                <div class="form-floating mb-3">

                    <select class="form-select" name="brandcode" id="brand-code">
                        @foreach ($codeBrand as $key => $row)

                        <option value="{{ $row->tblitembrand_id }}" {{ $model->tblitembrand_id == ($key+1) ? 'selected'
                            : '' }}>{{ $row->tblitembrand_code }} -
                            {{ $row->tblitembrand_name }}</option>

                        @endforeach
                    </select>
                    <label for="brand-code" class="form-label">Kode Merek</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="hidden" name="action" value="create">
                    <input type="text" class="form-control upperText" id="model-code" name="modelcode"
                        value="{{ old('modelcode',$model->tblitemmodel_codeModel) }}" placeholder="Kode Model">
                    <label for="model-code" class="col-form-label">Kode Model</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="modelname" class="form-control" style="height: 100px"
                        id="model-name">{{ old('modelname',$model->tblitemmodel_descriptionModel) }}</textarea>
                    <label for="model-name" class="col-form-label">Deskripsi Model</label>
                </div>

                @if ($errors->any() && old('action') == 'create')
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                <a href="{{ route('model') }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                </a>

            </form>
        </div>
    </div>
</div>
@endsection
