@extends('layouts.app')
@section('title')
Edit Kategori
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('category.edit.detail', $category->tblitemcategory_id) }}" method="POST">
                @csrf

                <div class="form-floating mb-3">


                    <input type="text" class="form-control upperText" id="category-code" name="categorycode"
                        maxlength="4" for="category-code"
                        value="{{ old('categorycode', $category->tblitemcategory_code) }}" placeholder="Kode Kategori">
                    <label for="category-code">{{ __('Kode Kategori') }}</label>
                    <input type="hidden" name="action" value="edit">
                </div>
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" placeholder="Nama Kategori" for="category-name"
                        id="category-name" name="categoryname"
                        value=" {{ old('categoryname', $category->tblitemcategory_name) }}">

                    <label for="category-name">{{ __('Nama Kategori') }}</label>

                </div>
                @if ($errors->any() && old('action') == 'edit')
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                <a href="{{ route('category') }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                </a>

            </form>
        </div>
    </div>
</div>
@endsection
