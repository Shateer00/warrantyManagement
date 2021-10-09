@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="row">
            <div class="pb-3 col-12 col-md-8">
                <button type="button" id="buttonAddBrand" class="btn btn-primary" data-toggle="modal"
                    data-target="#createModal" data-whatever="@mdo">Tambah Merek Barang</button>
            </div>
            <div class="col-12 col-md-4">
                <form class="form-inline my-2 my-lg-0" action="{{ route('brand.search') }}" method="get">
                    @if ($requestParam == '')
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param'>
                    @else
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param' value="{{ $requestParam }}">
                    @endif
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <a class="btn btn-warning my-2 my-sm-0 ml-3" href="{{ route('brand') }}">Reset</a>
                </form>
            </div>
        </div>
        <div class="col-12">
            <h3>List Merek Barang</h3>
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            Nomor
                        </th>
                        <th scope="col">
                            Kode Merek
                        </th>
                        <th scope="col">
                            Nama Merek
                        </th>
                        <th>
                            Sub Menu
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brand as $key => $row)
                        <tr>
                            <td>
                                {{ $brand->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $row->tblitembrand_code }}
                            </td>
                            <td>
                                {{ $row->tblitembrand_name }}
                            </td>
                            <td>
                                {{-- <button type="button" data-id="{{ $row->tblitembrand_id }}"
                                    data-name="{{ $row->tblitembrand_name }}" data-code="{{ $row->tblitembrand_code }}"
                                    class="btn btn-primary buttonEditBrand" data-toggle="modal" data-target="#editModal"
                                    data-whatever="@mdo">Edit</button> --}}
                                <a class="btn btn-primary" href="{{ route('brand.edit', $row->tblitembrand_id) }}">
                                    <p class="fas fa-edit"></p>
                                    <p class="btnEdit">Edit</p>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $brand->links() }}
        </div>

    </div>


    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
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

                        <div class="mb-3">
                            <label for="brand-code" class="col-form-label">{{ __('Kode Merek :') }}</label>
                            <input type="hidden" name="action" value="create">
                            <input type="text" class="form-control upperText" id="brand-code" name="brandcode" maxlength="4"
                                value="{{ old('brandcode') }}">

                        </div>
                        <div class="mb-3">
                            <label for="brand-name" class="col-form-label">{{ __('Nama Merek :') }}</label>

                            <input type="text" class="form-control" id="brand-name" name="brandname"
                                value="{{ old('brandname') }}">
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
                        <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if (count($errors->all()) > 0 && old('action') == 'create')
        <script>
            ModalCreateShow();
        </script>
    @endif

@endsection
