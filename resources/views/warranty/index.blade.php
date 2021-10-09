@extends('layouts.app')
@section('content')
    <div class="pl-3 pt-4">
        <div class="row">
            <div class="pb-3 col-12 col-md-8">
                <button type="button" id="buttonAddWarranty" class="btn btn-primary" data-toggle="modal"
                    data-target="#createModal" data-whatever="@mdo">Tambah Garansi</button>
            </div>
            <div class="col-12 col-md-4">
                <form class="form-inline my-2 my-lg-0" action="{{ route('warranty.search') }}" method="get">
                    @if ($requestParam == '')
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param'>
                    @else
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name='param' value="{{ $requestParam }}">
                    @endif
                    <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    <a class="btn btn-warning my-2 my-sm-0 ml-3" href="{{ route('warranty') }}">Reset</a>
                </form>
            </div>
        </div>

        <div class="col-12">
            <h3>List Garansi Barang</h3>
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">
                            Nomor
                        </th>
                        <th scope="col">
                            SN
                        </th>
                        <th scope="col">
                            Kategori
                        </th>
                        <th scope="col">
                            Merek
                        </th>
                        <th scope="col">
                            Model
                        </th>
                        <th>
                            Sub Menu
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Warranty as $key => $row)
                        <tr>
                            <td>
                                {{ $Warranty->firstItem() + $key }}
                            </td>
                            <td>
                                {{ $row->tblitemwarrant_SN }}
                            </td>
                            <td>

                                {{ $row->tblitemcategory_code }} - {{ $row->tblitemcategory_name }}
                            </td>
                            <td>

                                {{ $row->tblitembrand_code }} - {{ $row->tblitembrand_name }}
                            </td>
                            <td>
                                {{ Str::limit($row->tblitemmodel_codeModel . ' - ' . $row->tblitemmodel_descriptionModel, 30) }}
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('warranty.edit', $row->tblitemwarranty_id) }}">
                                    <p class="fas fa-edit"></p>
                                    <p class="btnEdit">Edit</p>
                                </a>
                                {{-- <button type="button" data-id="{{ $row->tblitemwarranty_id }}"
                                    data-modelid="{{ $row->tblitemmodel_id }}"
                                    data-categorydetail="{{ $row->tblitemcategory_id }}"
                                    data-branddetail="{{ $row->tblitembrand_id }}"
                                    data-sn="{{ $row->tblitemwarrant_SN }}"
                                    data-dokbukti="{{ $row->tblitemwarrant_dokBukti }}"
                                    data-distributor="{{ $row->tblitemwarrant_distributor }}"
                                    data-user="{{ $row->tblitemwarrant_username }}"
                                    data-location="{{ $row->tblitemwarrant_location }}"
                                    data-purchasedate="{{ $row->tblitemwarrant_purchaseDate }}"
                                    data-periodmonth="{{ $row->tblitemwarrant_monthPeriod }}"
                                    data-status="{{ $row->tblitemstatus_id }}" data-note="{{ $row->tblitemwarrant_note }}"
                                    class="btn btn-primary buttonViewModel" data-toggle="modal" data-target="#viewModal"
                                    data-whatever="@mdo">View</button>
                                <button type="button" data-id="{{ $row->tblitemwarranty_id }}"
                                    data-categorydetail="{{ $row->tblitemcategory_id }}"
                                    data-branddetail="{{ $row->tblitembrand_id }}"
                                    data-sn="{{ $row->tblitemwarrant_SN }}"
                                    data-dokbukti="{{ $row->tblitemwarrant_dokBukti }}"
                                    data-distributor="{{ $row->tblitemwarrant_distributor }}"
                                    data-user="{{ $row->tblitemwarrant_username }}"
                                    data-location="{{ $row->tblitemwarrant_location }}"
                                    data-purchasedate="{{ $row->tblitemwarrant_purchaseDate }}"
                                    data-periodmonth="{{ $row->tblitemwarrant_monthPeriod }}"
                                    data-status="{{ $row->tblitemstatus_id }}" data-note="{{ $row->tblitemwarrant_note }}"
                                    class="btn btn-primary buttonEditModel" data-toggle="modal" data-target="#editModal"
                                    data-whatever="@mdo">Edit</button> --}}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $Warranty->links() }}
        </div>

    </div>


    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/transaction/edit/" method="POST" id="EditForm">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="edit">
                        <div class="mb-3">
                            <label for="category-code-edit" class="col-form-label">Kode Kategori :</label>
                            <select class="form-control" name="categorycodeedit" id="category-code-edit">
                                <option value="">PILIH KODE KATEGORI</option>
                                @foreach ($codeCategory as $key => $row)
                                    <option value="{{ $row->tblitemcategory_id }}">
                                        {{ $row->tblitemcategory_code }} -
                                        {{ $row->tblitemcategory_name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand-code-edit" class="col-form-label">Kode Merek :</label>
                            <select class="form-control" name="brandcodeedit" id="brand-code-edit">
                                <option value="">PILIH KODE MEREK</option>
                                @foreach ($codeBrand as $key => $row)
                                    <option value="{{ $row->tblitembrand_id }}">{{ $row->tblitembrand_code }} -
                                        {{ $row->tblitembrand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="model-code-edit" class="col-form-label">Kode Model :</label>
                            <select class="form-control" name="modelcodeedit" id="model-code-edit">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sn-transaction" class="col-form-label">SN :</label>
                            <input type="text" class="form-control" name="sntransaction" id="sn-transaction">
                        </div>
                        <div class="mb-3">
                            <label for="dok-bukti" class="col-form-label">Dokumen Bukti :</label>
                            <input type="text" class="form-control" name="dokbukti" id="dok-bukti">
                        </div>
                        <div class="mb-3">
                            <label for="distributor-id" class="col-form-label">Distributor :</label>
                            <input type="text" class="form-control" name="distributorname" id="distributor-id">
                        </div>
                        <div class="mb-3">
                            <label for="pemakai-id" class="col-form-label">Pemakai :</label>
                            <input type="text" class="form-control" name="pemakainame" id="pemakai-id">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi-id" class="col-form-label">Lokasi :</label>
                            <input type="text" class="form-control" name="lokasiname" id="lokasi-id">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal-beli-id" class="col-form-label">Tanggal Pembelian :</label>
                            <input type="date" class="form-control" name="tanggalbeliname" id="tanggal-beli-id">
                        </div>
                        <div class="mb-3">
                            <label for="period-id" class="col-form-label">Periode Bulan :</label>
                            <input type="number" class="form-control" min="1" value="0" max="100" name="periodname"
                                id="period-id">
                        </div>
                        <div class="mb-3">
                            <label for="status-id" class="col-form-label">Status :</label>
                            <select class="form-control" name="statusname" id="status-id">
                                @foreach ($codeStatus as $key => $row)
                                    <option value="{{ $row->tblitemstatus_id }}">{{ $row->tblitemstatus_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan-id" class="col-form-label">Catatan :</label>
                            <textarea class="form-control" name="note" id="model-note" form="EditForm"></textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/transaction/edit/" method="POST" id="EditForm">
                        @csrf
                    <input type="hidden" name="action" value="view">
                    <div class="mb-3">
                        <label for="category-code-view" class="col-form-label">Kode Kategori :</label>
                        <select class="form-control" name="categorycodeview" id="category-code-view" disabled>
                            <option value="">PILIH KODE KATEGORI</option>
                            @foreach ($codeCategory as $key => $row)
                                <option value="{{ $row->tblitemcategory_id }}">
                                    {{ $row->tblitemcategory_code }} -
                                    {{ $row->tblitemcategory_name }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand-code-view" class="col-form-label">Kode Merek :</label>
                        <select class="form-control" name="brandcodeview" id="brand-code-view" disabled>
                            <option value="">PILIH KODE MEREK</option>
                            @foreach ($codeBrand as $key => $row)
                                <option value="{{ $row->tblitembrand_id }}">{{ $row->tblitembrand_code }} -
                                    {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="model-code-view" class="col-form-label">Kode Model :</label>
                        <select class="form-control" name="modelcodeview" id="model-code-view" disabled>
                            @foreach ($codeModel as $key => $row)
                                <option value="{{ $row->tblitemmodel_id }}">{{ $row->tblitemmodel_codeModel }} -
                                    {{ $row->tblitemmodel_descriptionModel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sn-transaction-view" class="col-form-label">SN :</label>
                        <input type="text" class="form-control" name="sntransactionview" id="sn-transaction-view"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="dok-bukti-view" class="col-form-label">Dokumen Bukti :</label>
                        <input type="text" class="form-control" name="dokbuktiview" id="dok-bukti-view" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="distributor-id-view" class="col-form-label">Distributor :</label>
                        <input type="text" class="form-control" name="distributornameview" id="distributor-id-view"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="pemakai-id-view" class="col-form-label">Pemakai :</label>
                        <input type="text" class="form-control" name="pemakainameview" id="pemakai-id-view" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi-id-view" class="col-form-label">Lokasi :</label>
                        <input type="text" class="form-control" name="lokasinameview" id="lokasi-id-view" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal-beli-id-view" class="col-form-label">Tanggal Pembelian :</label>
                        <input type="date" class="form-control" name="tanggalbelinameview" id="tanggal-beli-id-view"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="period-id-view" class="col-form-label">Periode Bulan :</label>
                        <input type="number" class="form-control" min="1" value="0" max="100" name="periodnameview"
                            id="period-id-view" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="status-id-view" class="col-form-label">Status :</label>
                        <select class="form-control" name="statusname" id="status-id-view" disabled>
                            @foreach ($codeStatus as $key => $row)
                                <option value="{{ $row->tblitemstatus_id }}">{{ $row->tblitemstatus_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan-id-view" class="col-form-label">Catatan :</label>
                        <textarea class="form-control" name="noteview" id="model-note-view" disabled></textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitbtn" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Garansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('warranty.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="action" value="create">
                        <div class="mb-3">
                            <label for="category-code" class="col-form-label">Kode Kategori :</label>
                            <select class="form-control" name="categorycode" id="category-code">
                                {{-- <option value="">PILIH KODE KATEGORI</option> --}}
                                @foreach ($codeCategory as $key => $row)
                                    <option value="{{ $row->tblitemcategory_id }}"
                                        {{ old('categorycode') == $row->tblitemcategory_id ? 'selected' : '' }}>
                                        {{ $row->tblitemcategory_code }} -
                                        {{ $row->tblitemcategory_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand-code" class="col-form-label">Kode Merek :</label>
                            <select class="form-control" name="brandcode" id="brand-code">
                                {{-- <option value="">PILIH KODE MEREK</option> --}}
                                @foreach ($codeBrand as $key => $row)
                                    <option value="{{ $row->tblitembrand_id }}"
                                        {{ old('brandcode') == $row->tblitembrand_id ? 'selected' : '' }}>
                                        {{ $row->tblitembrand_code }} -
                                        {{ $row->tblitembrand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="model-code" class="col-form-label">Kode Model :</label>
                            <select class="form-control" style="width: 100%" name="modelcode" id="model-code">
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sn-transaction" class="col-form-label">SN :</label>
                            <input type="text" class="form-control" name="sntransaction" id="sn-transaction"
                                value="{{ old('sntransaction') }}">
                        </div>
                        <div class="mb-3">
                            <label for="dok-bukti" class="col-form-label">Dokumen Bukti :</label>
                            <input type="text" class="form-control" name="dokbukti" id="dok-bukti"
                                value="{{ old('dokbukti') }}">
                        </div>
                        <div class="mb-3">
                            <label for="distributor-id" class="col-form-label">Distributor :</label>
                            <input type="text" class="form-control" name="distributorname" id="distributor-id"
                                value="{{ old('distributorname') }}">
                        </div>
                        <div class="mb-3">
                            <label for="pemakai-id" class="col-form-label">Pemakai :</label>
                            <input type="text" class="form-control" name="pemakainame" id="pemakai-id"
                                value="{{ old('pemakainame') }}">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi-id" class="col-form-label">Lokasi :</label>
                            <input type="text" class="form-control" name="lokasiname" id="lokasi-id"
                                value="{{ old('lokasiname') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal-beli-id" class="col-form-label">Tanggal Pembelian :</label>
                            <input type="date" class="form-control" name="tanggalbeliname"
                                value="{{ old('tanggalbeliname', date('Y-m-d')) }}" id="tanggal-beli-id">
                        </div>
                        <div class="mb-3">
                            <label for="period-id" class="col-form-label">Periode Bulan :</label>
                            <input type="number" class="form-control" min="1" value="{{ old('periodname') }}" max="100"
                                name="periodname" id="period-id">
                        </div>
                        <div class="mb-3">
                            <label for="status-id" class="col-form-label">Status :</label>
                            <select class="form-control" name="statusname" id="status-id">
                                @foreach ($codeStatus as $key => $row)
                                    <option value="{{ $row->tblitemstatus_id }}">{{ $row->tblitemstatus_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="catatan-id" class="col-form-label">Catatan :</label>
                            <textarea name="note" class="form-control" id="note-id">{{ old('note') }}</textarea>
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


    <script>
        $(document).ready(function() {
            $('#model-code').select2({
                placeholder: 'Select an Model'
            });
        });

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            var lowerData = data.text.toLowerCase();
            params.term = params.term.toLowerCase();
            if (lowerData.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';


                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }
        $('#brand-code').on('change', function(e) {
            var brandCode = $(this).val();
            var categoryCode = $('#category-code').val();
            var urlWarrantyGetModel = "{{ route('warranty.getmodel') }}";
            $("#model-code").empty();
            $.ajax({
                url: urlWarrantyGetModel,
                data: {
                    "CategoryCode": categoryCode,
                    "BrandCode": brandCode
                },
                method: "GET",
                success: function(data) {
                    console.log(JSON.parse(data));
                    $("#model-code").select2({
                        data: JSON.parse(data),
                        minimumInputLength: 3,
                        matcher: matchCustom,
                        dropdownParent: $("#createModal")
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
        @php
        // if (count($errors->all()) > 0 && old('action') == 'create') {
        //     echo "$('#createModal').modal('show');";
        // }
        //
        @endphp
        @php
        // if (count($errors->all()) > 0 && old('action') == 'edit') {
        //     echo "$('#editModal').modal('show');";
        // }
        //
        @endphp
        // $(".buttonViewModel").click(function() {
        //     $('#model-code-view').val($(this).data('modelid')).change();
        //     $('#dok-bukti-view').val($(this).data('dokbukti'));
        //     $('#distributor-id-view').val($(this).data('distributor'));
        //     $('#sn-transaction-view').val($(this).data('sn'));
        //     $('#pemakai-id-view').val($(this).data('user'));
        //     $('#lokasi-id-view').val($(this).data('location'));
        //     $('#tanggal-beli-id-view').val($(this).data('purchasedate').substring(0, 10));
        //     $('#period-id-view').val($(this).data('periodmonth'));
        //     $('#model-note-view').val($(this).data('note'));
        //     $('#status-id-view').val($(this).data('status'));
        //     var categorydetail = $(this).data('categorydetail');
        //     var branddetail = $(this).data('branddetail');
        //     var categoryCN = $(this).data('category');
        //     var brandCN = $(this).data('brand');
        //     $("#category-code-view").val(categorydetail).change();
        //     $("#brand-code-view").val(branddetail).change();
        // });
        // $(".buttonEditModel").click(function() {
        //     var url = "/transaction/edit/" + $(this).data('id');
        //     $("#EditForm").attr("action", url);
        //     $('#dok-bukti').val($(this).data('dokbukti'));
        //     $('#distributor-id').val($(this).data('distributor'));
        //     $('#sn-transaction').val($(this).data('sn'));
        //     $('#pemakai-id').val($(this).data('user'));
        //     $('#lokasi-id').val($(this).data('location'));
        //     $('#tanggal-beli-id').val($(this).data('purchasedate').substring(0, 10));
        //     $('#period-id').val($(this).data('periodmonth'));
        //     $('#model-note').val($(this).data('note'));
        //     $('#status-id').val($(this).data('status'));
        //     var categorydetail = $(this).data('categorydetail');
        //     var branddetail = $(this).data('branddetail');
        //     var categoryCN = $(this).data('category');
        //     var brandCN = $(this).data('brand');
        //     $("#category-code-edit").val(categorydetail).change();
        //     $("#brand-code-edit").val(branddetail).change();
        // });
        // $('select[name="categorycode"]').on('change', function() {
        //     Nyoba(this, "cat");
        //     // console.log('Ini Add');
        // });

        // $('select[name="brandcode"]').on('change', function() {
        //     Nyoba(this, "brand");
        //     // console.log('Ini Add');
        // });

        // $('select[name="categorycodeedit"]').on('change', function() {
        //     NyobaEdit(this, "cat");
        //     // console.log('Ini Edit');
        // });

        // $('select[name="brandcodeedit"]').on('change', function() {
        //     NyobaEdit(this, "brand");
        //     // console.log('Ini Edit');
        // });
    </script>

    @if (count($errors->all()) > 0 && old('action') == 'create')
        <script>
            ModalCreateShow();
        </script>
    @endif

@endsection
