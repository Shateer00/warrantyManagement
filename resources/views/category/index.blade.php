@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="row">
            <div class="pb-3 col-12 col-md-8">
                <button type="button" id="buttonAddCategory" class="btn btn-primary" data-toggle="modal"
                    data-target="#createModal" data-whatever="@mdo">Tambah Kategori Barang</button>
            </div>
            <div class="col-12 col-md-4">
                <form class="form-inline my-2 my-lg-0" action="{{ route('category.search') }}" method="get">
                    @if ($requestParam == '')
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param'>
                    @else
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param' value="{{ $requestParam }}">
                    @endif
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <a class="btn btn-warning my-2 my-sm-0 ml-3" href="{{ route('category') }}">Reset</a>
                </form>
            </div>
        </div>

        <div class="col-12">
            <h3>List Kategori Barang</h3>
            <table class="table table-hovertable-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            Nomor
                        </th>
                        {{-- <th scope="col">
                    ID Kategori
                  </th> --}}
                        <th scope="col">
                            Kode Kategori
                        </th>
                        <th scope="col">
                            Nama Kategori
                        </th>
                        <th>
                            Sub Menu
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $key => $row)
                        <tr>
                            <td>
                                {{ $category->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $row->tblitemcategory_code }}
                            </td>
                            <td>
                                {{ $row->tblitemcategory_name }}
                            </td>
                            <td>
                                {{-- <button type="button" data-id="{{ $row->tblitemcategory_id }}"
                                    data-name="{{ $row->tblitemcategory_name }}"
                                    data-code="{{ $row->tblitemcategory_code }}"
                                    class="btn btn-primary buttonEditcategory" data-toggle="modal"
                                    data-target="#editModal" data-whatever="@mdo">Edit</button> --}}
                                <a class="btn btn-primary" href="{{ route('category.edit', $row->tblitemcategory_id) }}">
                                    <p class="fas fa-edit"></p>
                                    <p class="btnEdit">Edit</p>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $category->links() }}
        </div>

    </div>




    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
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

    @if (count($errors->all()) > 0 && old('action') == 'create')
        <script>
            ModalCreateShow();
        </script>
    @endif

@endsection
