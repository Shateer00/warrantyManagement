@extends('layouts.app')
@section('title')
    View Garansi
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('warranty.edit.detail', $Warranty->tblitemwarranty_id) }}" method="POST">
                    @csrf

                    <input type="hidden" name="action" value="create">

                    <div class="mb-3">
                        <label for="period-id" class="col-form-label" style="font-weight: 600">Batas Akhir Garansi :</label>
                        <input type="date" class="form-control" disabled style="font-weight: 600"
                            value="{{  \Carbon\Carbon::parse($Warranty->tblitemwarrant_purchaseDate)->addMonths($Warranty->tblitemwarrant_monthPeriod)->format('Y-m-d') }}"
                            >
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="category-code" class="col-form-label">Kode Kategori :</label>
                        <select class="form-control" name="categorycodeedit" id="category-code" disabled>
                            {{-- <option value="">PILIH KODE KATEGORI</option> --}}
                            @foreach ($codeCategory as $key => $row)
                                <option value="{{ $row->tblitemcategory_id }}"
                                    {{ $Warranty->tblitemcategory_id == $row->tblitemcategory_id ? 'selected' : '' }}>
                                    {{ $row->tblitemcategory_code }} -
                                    {{ $row->tblitemcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand-code" class="col-form-label">Kode Merek :</label>
                        <select class="form-control" name="brandcodeedit" id="brand-code" disabled>
                            {{-- <option value="">PILIH KODE MEREK</option> --}}
                            @foreach ($codeBrand as $key => $row)
                                <option value="{{ $row->tblitembrand_id }}"
                                    {{ $Warranty->tblitembrand_id == $row->tblitembrand_id ? 'selected' : '' }}>
                                    {{ $row->tblitembrand_code }} -
                                    {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="model-code" class="col-form-label">Kode Model :</label>
                        <select class="form-control" style="width: 100%" name="modelcodeedit" id="model-code" disabled>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sn-transaction" class="col-form-label">SN :</label>
                        <input type="text" class="form-control" name="sntransaction" id="sn-transaction" disabled
                            value="{{ old('sntransaction', $Warranty->tblitemwarrant_SN) }}">
                    </div>
                    <div class="mb-3">
                        <label for="dok-bukti" class="col-form-label">Dokumen Bukti :</label>
                        <input type="text" class="form-control" name="dokbukti" id="dok-bukti" disabled
                            value="{{ old('dokbukti', $Warranty->tblitemwarrant_dokBukti) }}">
                    </div>
                    <div class="mb-3">
                        <label for="distributor-id" class="col-form-label">Distributor :</label>
                        <input type="text" class="form-control" name="distributorname" id="distributor-id" disabled
                            value="{{ old('distributorname', $Warranty->tblitemwarrant_distributor) }}">
                    </div>
                    <div class="mb-3">
                        <label for="pemakai-id" class="col-form-label">Pemakai :</label>
                        <input type="text" class="form-control" name="pemakainame" id="pemakai-id" disabled
                            value="{{ old('pemakainame', $Warranty->tblitemwarrant_username) }}">
                    </div>
                    <div class="mb-3">
                        <label for="lokasi-id" class="col-form-label">Lokasi :</label>
                        <input type="text" class="form-control" name="lokasiname" id="lokasi-id" disabled
                            value="{{ old('lokasiname', $Warranty->tblitemwarrant_location) }}">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal-beli-id" class="col-form-label">Tanggal Pembelian : </label>

                        <input type="date" class="form-control" name="tanggalbeliname" disabled
                            value="{{ old('tanggalbeliname', \Carbon\Carbon::parse($Warranty->tblitemwarrant_purchaseDate)->format('Y-m-d'), date('Y-m-d')) }}"
                            id="tanggal-beli-id">
                        {{-- <p>{{ $Warranty->tblitemwarrant_purchaseDate }}</p> --}}
                    </div>
                    <div class="mb-3">
                        <label for="period-id" class="col-form-label">Periode Bulan :</label>
                        <input type="number" class="form-control" min="1" disabled
                            value="{{ old('periodname', $Warranty->tblitemwarrant_monthPeriod) }}" max="100"
                            name="periodname" id="period-id">
                    </div>
                    <div class="mb-3">
                        <label for="status-id" class="col-form-label">Status :</label>
                        <select class="form-control" name="statusname" id="status-id" disabled>
                            @foreach ($codeStatus as $key => $row)
                                <option value="{{ $row->tblitemstatus_id }}"
                                    {{ $Warranty->tblitemstatus_id == $row->tblitemstatus_id ? 'selected' :  '' }}>
                                    {{ $row->tblitemstatus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catatan-id" class="col-form-label">Catatan :</label>
                        <textarea name="note" class="form-control" disabled
                            id="note-id">{{ old('note', $Warranty->tblitemwarrant_note) }}</textarea>
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
                    {{-- <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button> --}}
                    <a href="{{ route('warranty') }}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Tutup') }}</button>
                    </a>

                </form>
            </div>
        </div>
    </div>
    {{-- <script>
        $(document).ready(function() {
            var brandCode = $('#brand-code').val();
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
                        matcher: matchCustom
                    });
                },
                error: function(err) {
                    console.log(err);
                }
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
                        matcher: matchCustom
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });
    </script> --}}
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

    $(document).ready(function() {
        var brandCode = $('#brand-code').val();
        var categoryCode = $('#category-code').val();
        var urlWarrantyGetModel = "{{ route('warranty.getmodel') }}";
        $("#model-code").empty();
        $('#model-code').select2({
            placeholder: 'Select an Model'
        });

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
@endsection

