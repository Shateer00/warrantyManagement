@extends('layouts.app')
@section('title')
Kategori
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddCategory" class="btn btn-primary" data-toggle="modal"
                data-backdrop="static" data-keyboard="false" data-target="#createModal" data-whatever="@mdo"><i
                    class="fas fa-plus"></i></button>
        </div>
        <div class="pt-3 pl-3 pb-3 col-md-4">
            <form class="form-inline my-2 my-lg-0" action="{{ route('category.search') }}" method="get">
                @if ($requestParam == '')
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'>
                @else
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'
                    value="{{ $requestParam }}">
                @endif
                <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="{{ route('category') }}">Reset</a>
            </form>
        </div>
    </div>

    <div class="col-12">
        <h3 class="textWhite">List Kategori Barang</h3>
        @if (count($category) == 0)
        <div class="border ">
            <div class="card ">
                <div class="card-body EmptyTable">
                    Data Kategori belum ada.
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
                    {{-- <th scope="col">
                        ID Kategori
                    </th> --}}
                    <th scope="col" class="col-1">
                        Kode Kategori
                    </th>
                    <th scope="col" class="col-8">
                        Nama Kategori
                    </th>
                    <th scope="col" class="col-2">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber">
                        {{ $category->firstItem() + $key }}
                    </td>
                    <td data-label="Kode">
                        {{ $row->tblitemcategory_code }}
                    </td>
                    <td data-label="Kode">
                        {{ $row->tblitemcategory_name }}
                    </td>
                    <td class="text-center">
                        {{-- <button type="button" data-id="{{ $row->tblitemcategory_id }}"
                            data-name="{{ $row->tblitemcategory_name }}" data-code="{{ $row->tblitemcategory_code }}"
                            class="btn btn-primary buttonEditcategory" data-toggle="modal" data-target="#editModal"
                            data-whatever="@mdo">Edit</button> --}}
                        <a class="btn btn-primary" href="{{ route('category.edit', $row->tblitemcategory_id) }}">
                            <p class="btnEdit"><i class="fas fa-edit"></i></p>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $category->links() }}
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

                    <div class="mb-3">
                        <label for="category-code" class="col-form-label">Kode Kategori :</label>
                        <input type="hidden" name="action" value="create">
                        <input type="text" class="form-control upperText" id="category-code" name="categorycode"
                            maxlength="4" value="{{ old('categorycode') }}">

                    </div>
                    <div class="mb-3">
                        <label for="category-name" class="col-form-label">Nama Kategori :</label>

                        <input type="text" class="form-control" id="category-name" name="categoryname"
                            value="{{ old('categoryname') }}">


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
