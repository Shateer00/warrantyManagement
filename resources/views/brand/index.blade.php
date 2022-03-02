@extends('layouts.app')
@section('title')
Merek
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddBrand" class="btn btn-dark" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#createModal" data-whatever="@mdo">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="pt-3 pl-3 pb-3 col-md-4">
            <form class="form-inline my-2 my-lg-0" action="{{ route('brand.search') }}" method="get">
                @if ($requestParam == '')
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'>
                @else
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='param'
                    value="{{ $requestParam }}">
                @endif
                <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="{{ route('brand') }}">Reset</a>
            </form>
        </div>
    </div>
    <div class="col-12">
        <h3 class="text-dark">List Merek Barang</h3>
        @if (count($brand) == 0)
        <div class="align-items-center justify-content-center flex-row d-flex py-4">
            <div class="card bg-info flex-center">
                <div class="card-body EmptyTable">
                    <a class="text-white"> Data Merek belum ada / Tidak ditemukan</a>
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
                        @sortablelink('tblitembrand_code','Kode Merek')
                    </th>
                    <th scope="col" class="col-8" class="Oswald">
                        @sortablelink('tblitembrand_name','Nama Merek')
                    </th>
                    <th scope="col" class="col-2" class="Oswald">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brand as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber Oswald">
                        {{ $brand->firstItem() + $key }}
                    </td>
                    <td data-label="Kode" class="Oswald">
                        {{ $row->tblitembrand_code }}
                    </td>
                    <td data-label="Nama" class="Oswald">
                        {{ $row->tblitembrand_name }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary" href="{{ route('brand.edit', $row->tblitembrand_id) }}">
                            <span class="btnEdit"><i class="fas fa-edit"></i>&nbsp;Edit</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $brand->appends(\Request::except('page'))->render() !!}
        {{-- {{ $brand->links() }} --}}
        @endif

    </div>

</div>


<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Merek Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('brand.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="action" value="create">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control upperText" for="brand-code" id="brand-code"
                            name="brandcode" maxlength="4" value="{{ old('brandcode') }}" placeholder="Kode Merek">
                        <label for="brand-code">Kode Merek</label>


                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" for="brand-name" id="brand-name" name="brandname"
                            value="{{ old('brandname') }}" placeholder="Nama Merek">
                        <label for="brand-name">Nama Merek</label>
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
                    <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
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
