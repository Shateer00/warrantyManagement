@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="row">
            <div class="pb-3 col-12 col-md-8">
                <button type="button" id="buttonAddModel" class="btn btn-primary" data-toggle="modal"
                    data-target="#createModal" data-whatever="@mdo">Tambah Model Barang</button>
            </div>
            <div class="col-12 col-md-4">
                <form class="form-inline my-2 my-lg-0" action="{{ route('model.search') }}" method="get">
                    @if ($requestParam == '')
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param'>
                    @else
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param' value="{{ $requestParam }}">
                    @endif
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <a class="btn btn-warning my-2 my-sm-0 ml-3" href="/model">Reset</a>
                </form>
            </div>
        </div>

        <div class="col-12">
            <h3>List Model Barang</h3>
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            Nomor
                        </th>
                        <th scope="col">
                            Kategori
                        </th>
                        <th scope="col">
                            Merek
                        </th>
                        <th scope="col">
                            Kode Model
                        </th>
                        <th scope="col" class="limitDescriptionText">
                            Deskripsi Model
                        </th>
                        <th>
                            Sub Menu
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model as $key => $row)
                        <tr>
                            <td>
                                {{ $model->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $row->tblitemcategory_code }} - {{ $row->tblitemcategory_name }}
                            </td>
                            <td>
                                {{ $row->tblitembrand_code }} - {{ $row->tblitembrand_name }}
                            </td>
                            <td>
                                {{ $row->tblitemmodel_codeModel }}
                            </td>
                            <td>
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
                                    <p class="fas fa-edit"></p>
                                    <p class="btnEdit">Edit</p>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $model->links() }}
        </div>

    </div>




    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                            {{-- <input type ="hidden" name ="action" value="create" >
                    <input type="text" class="form-control" id="model-code" name="categorycode" value="{{ old('categorycode')}}"> --}}
                            <label for="category-code" class="col-form-label">Kode Kategori :</label>
                            <select class="form-control" name="categorycode" id="category-code">
                                @foreach ($codeCategory as $key => $row)
                                    <option value="{{ $row->tblitemcategory_id }}"
                                        {{ old('categorycode') == $key ? 'selected' : '' }}>
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
                                        {{ old('brandcode') == $key ? 'selected' : '' }}>{{ $row->tblitembrand_code }}
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

                        {{-- <input type="text" class="form-control" id="model-name" name="modelname" value="{{old('modelname')}}"> --}}
                        <textarea name="modelname" class="form-control"
                            id="model-name">{{ old('modelname') }}</textarea>
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
    @if (count($errors->all()) > 0 && old('action') == 'create')
        <script>
            ModalCreateShow();
        </script>
    @endif

@endsection
