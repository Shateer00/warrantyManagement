@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="pb-3">
            <div class="col">
                <form action="{{ route('category.edit.detail', $category->tblitemcategory_id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="category-code" class="col-form-label">{{ __('Kode Kategory :') }}</label>
                        <input type="hidden" name="action" value="edit">
                        <input type="text" class="form-control Upper" id="category-code" name="categorycode" maxlength="4"
                            value="{{ old('categorycode', $category->tblitemcategory_code) }}">

                    </div>
                    <div class="mb-3">
                        <label for="category-name" class="col-form-label">{{ __('Nama Kategori :') }}</label>

                        <input type="text" class="form-control" id="category-name" name="categoryname"
                            value=" {{ old('categoryname', $category->tblitemcategory_name) }}">
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
                    <a href="{{ route('category') }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                    </a>

                </form>
            </div>
        </div>
    </div>
@endsection
