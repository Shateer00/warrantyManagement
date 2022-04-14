@extends('layouts.app')
@section('title')
Model
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddModel" class="btn btn-dark" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#createModal" data-whatever="@mdo">
                <i class="fas fa-plus"></i>
            </button>
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
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="{{ route('model') }}">Reset</a>
            </form>
        </div>
    </div>

    <div class="col-12">
        <h3 class="text-dark">List Model Barang</h3>
        @if (count($model) == 0)
        <div class="align-items-center justify-content-center flex-row d-flex py-4">
            <div class="card bg-info flex-center">
                <div class="card-body EmptyTable">
                    <a class="text-white">Data Model belum ada / Tidak ditemukan</a>
                </div>
            </div>
        </div>
        @else
        <table class="table table-bordered" id="TheTable">
            <thead class="table-info">
                <tr>
                    <th scope="col" class="col-1">
                        Nomor
                    </th>
                    <th scope="col" class="col-1">
                        @sortablelink('tblitemcategory_id','Kategori')
                    </th>
                    <th scope="col" class="col-1">
                        @sortablelink('tblitembrand_id','Merek')
                    </th>
                    <th scope="col" class="col-2">
                        @sortablelink('tblitemmodel_codeModel','Kode Model')
                    </th>
                    <th scope="col" class="limitDescriptionText col-5">
                        @sortablelink('tblitemmodel_descriptionModel','Deskripsi Model')
                    </th>
                    <th class="col-2 ">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber  Oswald">
                        {{ $model->firstItem() + $key }}
                    </td>
                    <td data-label="Kategori" class=" Oswald">
                        {{ $row->tblitemcategory_code }} - {{ $row->tblitemcategory_name }}
                    </td>
                    <td data-label="Merek" class=" Oswald">
                        {{ $row->tblitembrand_code }} - {{ $row->tblitembrand_name }}
                    </td>
                    <td data-label="Model" class=" Oswald">
                        {{ $row->tblitemmodel_codeModel }}
                    </td>
                    <td data-label="Description" class=" Oswald">

                        {{ $row->tblitemmodel_descriptionModel }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{ route('model.edit', $row->tblitemmodel_id) }}">
                            <span class="btnEdit"><i class="fas fa-edit"></i>&nbsp;Edit</span>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $model->appends(\Request::except('page'))->render() !!}
        {{-- {{ $model->links() }} --}}
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
                    <div class="form-floating mb-3">
                        <select class="form-select" name="categorycode" id="category-code">
                            @foreach ($codeCategory as $key => $row)
                            <option value="{{ $row->tblitemcategory_id }}" {{ old('categorycode')==$row->
                                tblitemcategory_id ? 'selected' : '' }}>
                                {{ $row->tblitemcategory_code }} -
                                {{ $row->tblitemcategory_name }}</option>
                            @endforeach
                        </select>
                        <label for="category-code" class="form-label">Kode Kategori</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="brandcode" id="brand-code">
                            @foreach ($codeBrand as $key => $row)
                            <option value="{{ $row->tblitembrand_id }}" {{ old('brandcode')==$row->tblitembrand_id ?
                                'selected' : '' }}>{{ $row->tblitembrand_code }}
                                -
                                {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>
                        <label for="brand-code" class="form-label">Kode Merek</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="hidden" name="action" value="create">
                        <input type="text" class="form-control upperText" id="model-code" name="modelcode"
                            value="{{ old('modelcode') }}" placeholder="Kode Model">
                        <label for="model-code">Kode Model</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="modelname" class="form-control" id="model-name" placeholder="Deskripsi Model"
                            style="height: 100px">{{ old('modelname') }}</textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </div>
            </form>
        </div>
    </div>
</div>
<x-error-modal>
</x-error-modal>

<x-success-modal>
</x-success-modal>

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
