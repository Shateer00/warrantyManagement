@extends('layouts.app')
@section('title')
Model
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddModel" class="btn btn-primary" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#createModal" data-whatever="@mdo"><i
                    class="fas fa-plus"></i></button>
        </div>
        <div class="pt-3 pl-3 pb-3 col-md-4">
            <form class="form-inline my-2 my-lg-0" action="{{ route('model.search') }}" method="get">
                @if ($requestParam == '')
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'>
                @else
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'
                    value="{{ $requestParam }}">
                @endif
                <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="/model">Reset</a>
            </form>
        </div>
    </div>

    <div class="col-12">
        <h3 class="textWhite">List Model Barang</h3>
        @if (count($model) == 0)
        <div class="border ">
            <div class="card ">
                <div class="card-body EmptyTable">
                    Data Model belum ada.
                </div>
            </div>
        </div>
        @else
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th scope="col" class="col-1">
                        Nomor
                    </th>
                    <th scope="col" class="col-1">
                        Kategori
                    </th>
                    <th scope="col" class="col-1">
                        Merek
                    </th>
                    <th scope="col" class="col-2">
                        Kode Model
                    </th>
                    <th scope="col" class="limitDescriptionText col-5">
                        Deskripsi Model
                    </th>
                    <th class="col-2">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber">
                        {{ $model->firstItem() + $key }}
                    </td>
                    <td data-label="Kategori">
                        {{ $row->tblitemcategory_code }} - {{ $row->tblitemcategory_name }}
                    </td>
                    <td data-label="Merek">
                        {{ $row->tblitembrand_code }} - {{ $row->tblitembrand_name }}
                    </td>
                    <td data-label="Model">
                        {{ $row->tblitemmodel_codeModel }}
                    </td>
                    <td data-label="Description">
                        {{ Str::limit($row->tblitemmodel_descriptionModel, 10) }}
                    </td>
                    <td>
                        {{-- <button type="button" data-id="{{ $row->tblitemmodel_id }}"
                            data-name="{{ $row->tblitemmodel_descriptionModel }}"
                            data-code="{{ $row->tblitemmodel_codeModel }}"
                            data-categorydetail="{{ $row->tblitemcategory_id }}"
                            data-branddetail="{{ $row->tblitembrand_id }}"
                            data-category="{{ $row->tblitemcategory_code . ' - ' . $row->tblitemcategory_name }}"
                            data-brand="{{ $row->tblitembrand_code . ' - ' . $row->tblitembrand_name }}"
                            class="btn btn-primary buttonEditModel" data-toggle="modal" data-target="#editModal"
                            data-whatever="@mdo">Edit</button> --}}
                        <a class="btn btn-primary" href="{{ route('model.edit', $row->tblitemmodel_id) }}">
                            <p class="btnEdit"><i class="fas fa-edit"></i></p>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $model->links() }}
        @endif
    </div>

</div>




<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Model Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('model.add') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        {{-- <label for="model-code" class="col-form-label">Kode Model :</label> --}}
                        {{-- <input type="hidden" name="action" value="create">
                        <input type="text" class="form-control" id="model-code" name="categorycode"
                            value="{{ old('categorycode')}}"> --}}
                        <label for="category-code" class="col-form-label">Kode Kategori :</label>
                        <select class="form-control" name="categorycode" id="category-code">
                            @foreach ($codeCategory as $key => $row)
                            <option value="{{ $row->tblitemcategory_id }}" {{ old('categorycode')==$row->
                                tblitemcategory_id ? 'selected' : '' }}>
                                {{ $row->tblitemcategory_code }} -
                                {{ $row->tblitemcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        {{-- <label for="model-name" class="col-form-label">Nama Model :</label>

                        <input type="text" class="form-control" id="model-name" name="categoryname"
                            value="{{old('categoryname')}}"> --}}
                        <label for="brand-code" class="col-form-label">Kode Merek :</label>
                        <select class="form-control" name="brandcode" id="brand-code">
                            @foreach ($codeBrand as $key => $row)
                            <option value="{{ $row->tblitembrand_id }}" {{ old('brandcode')==$row->tblitembrand_id ?
                                'selected' : '' }}>{{ $row->tblitembrand_code }}
                                -
                                {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>


                    </div>

                    <div class="mb-3">
                        <label for="model-code" class="col-form-label">Kode Model :</label>
                        <input type="hidden" name="action" value="create">
                        <input type="text" class="form-control upperText" id="model-code" name="modelcode"
                            value="{{ old('modelcode') }}">

                    </div>

                    <label for="model-name" class="col-form-label">Deskripsi Model :</label>

                    {{-- <input type="text" class="form-control" id="model-name" name="modelname"
                        value="{{old('modelname')}}"> --}}
                    <textarea name="modelname" class="form-control" id="model-name">{{ old('modelname') }}</textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header errorModal">
                <h5 class="modal-title"><i class="fas fa-exclamation"></i>&nbsp;Error Message</h5>
            </div>
            <div class="modal-body">
                {{ Session::get('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header successModal">
                <h5 class="modal-title"><i class="fas fa-check"></i>&nbsp;Success Message</h5>
            </div>
            {{--
            <div class="modal-body">
                {{ Session::get('success') }}
            </div>
            --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@if ($errors->any() && old('action') == 'create')
ModalCreateShow();
@endif;
@if(Session::has('error'))
ModalErrorShow();
@endif;
@if(Session::has('success'))
ModalSuccessShow();
@endif;
@endsection
