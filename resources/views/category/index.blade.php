@extends('layouts.app')
@section('title')
Kategori
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddCategory" class="btn btn-dark" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#createModal" data-whatever="@mdo"><i
                    class="fas fa-plus"></i></button>
        </div>
        <div class="pt-3 pl-3 pb-3 col-md-4">
            <form class="form-inline my-2 my-lg-0" action="{{ route('category.search') }}" method="get">
                @if ($requestParam == '')
                <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search" name='param'>
                @else
                <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search" name='param'
                    value="{{ $requestParam }}">
                @endif
                <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="{{ route('category') }}">


                    <i class="fas fa-redo"></i></a>
            </form>
        </div>
    </div>

    <div class="col-12">
        <h3 class="text-dark">List Kategori Barang</h3>
        @if (count($category) == 0)
        <div class="align-items-center justify-content-center flex-row d-flex py-4">
            <div class="card bg-info flex-center">
                <div class="card-body EmptyTable">
                    <a class="text-white">Data Kategori belum ada / Tidak ditemukan</a>
                </div>
            </div>
        </div>
        @else
        <table class="table table-bordered" id="TheTable">
            <thead class="table-info">
                <tr>
                    <th scope="col" class="col-1" class="Oswald">
                        Nomor
                    </th>
                    <th scope="col" class="col-1" class="Oswald">
                        @sortablelink('tblitemcategory_code','Kode Kategori')
                    </th>
                    <th scope="col" class="col-8" class="Oswald">
                        @sortablelink('tblitemcategory_name','Nama Kategori')
                    </th>
                    <th scope="col" class="col-2" class="Oswald">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber Oswald">
                        {{ $category->firstItem() + $key }}
                    </td>
                    <td data-label="Kode" class="Oswald">
                        {{ $row->tblitemcategory_code }}
                    </td>
                    <td data-label="Kode" class="Oswald">
                        {{ $row->tblitemcategory_name }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{ route('category.edit', $row->tblitemcategory_id) }}">
                            <span class="btnEdit"><i class="fas fa-edit"></i>&nbsp;Edit</span>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $category->appends(\Request::except('page'))->render() !!}
        {{-- {{ $category->links() }} --}}
        @endif
    </div>

</div>




<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.add') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control upperText" id="category-code" name="categorycode"
                            maxlength="4" for="category-code" value="{{ old('categorycode') }}"
                            placeholder="Kode Kategori">

                        <label for="category-code">Kode Kategori</label>

                        <input type="hidden" name="action" value="create">

                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="category-name" name="categoryname"
                            value="{{ old('categoryname') }}" for="category-name" placeholder="Nama Kategori">

                        <label for="category-name">Nama Kategori :</label>
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
