@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="pb-3">
            <div class="col">
                <form action="{{ route('model.edit.detail',$model->tblitemmodel_id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        {{-- <label for="model-code" class="col-form-label">Kode Model :</label> --}}
                        {{-- <input type ="hidden" name ="action" value="create" >
                <input type="text" class="form-control" id="model-code" name="categorycode" value="{{ old('categorycode')}}"> --}}
                        <label for="category-code" class="col-form-label">Kode Kategori :</label>
                        <select class="form-control" name="categorycode" id="category-code">
                            @foreach ($codeCategory as $key => $row)
                                <option value="{{ $row->tblitemcategory_id }}"
                                    {{ $model->tblitemcategory_id == $key ? 'selected' : '' }}>
                                    {{ $row->tblitemcategory_code }} -
                                    {{ $row->tblitemcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="model-name" class="col-form-label">Nama Model :</label>

                <input type="text" class="form-control" id="model-name" name="categoryname" value="{{old('categoryname')}}"> --}}
                        <label for="brand-code" class="col-form-label">Kode Merek :</label>
                        <select class="form-control" name="brandcode" id="brand-code">
                            @foreach ($codeBrand as $key => $row)
                                <option value="{{ $row->tblitembrand_id }}"
                                    {{  $model->tblitembrand_id == $key ? 'selected' : '' }}>{{ $row->tblitembrand_code }} -
                                    {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>


                    </div>

                    <div class="mb-3">
                        <label for="model-code" class="col-form-label">Kode Model :</label>
                        <input type="hidden" name="action" value="create">
                        <input type="text" class="form-control upperText" id="model-code" name="modelcode"
                            value="{{ old('modelcode',$model->tblitemmodel_codeModel) }}">

                    </div>

                    <label for="model-name" class="col-form-label">Deskripsi Model :</label>

                    {{-- <input type="text" class="form-control" id="model-name" name="modelname" value="{{old('modelname')}}"> --}}
                    <textarea name="modelname" class="form-control"
                        id="model-name">{{ old('modelname',$model->tblitemmodel_descriptionModel) }}</textarea>
                    <div class="mb-3">

                    </div>
                    @if ($errors->any() && old('action') == 'create')
                        <div class="alert alert-danger">
                            <ul>

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                    <a href="{{ route('model') }}">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">{{ __('Tutup') }}</button>
                    </a>

                </form>
            </div>
        </div>
    </div>
@endsection
