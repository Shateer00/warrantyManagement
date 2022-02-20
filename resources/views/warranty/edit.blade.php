@extends('layouts.app')
@section('title')
Edit Garansi
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <form action="{{ route('warranty.edit.detail', $Warranty->tblitemwarranty_id) }}" method="POST">
                @csrf

                <input type="hidden" name="action" value="create">
                <div class="form-floating mb-3">

                    <input placeholder="1999-01-01" type="date" class="form-control" disabled style="font-weight: 600"
                        value="{{  \Carbon\Carbon::parse($Warranty->tblitemwarrant_purchaseDate)->addMonths($Warranty->tblitemwarrant_monthPeriod)->format('Y-m-d') }}">
                    <label for="period-id" class="col-form-label" style="font-weight: 600">Batas Akhir Garansi</label>
                </div>
                <hr>
                <div class="form-floating mb-3">

                    <select class="form-control" name="categorycodeedit" id="category-code">
                        {{-- <option value="">PILIH KODE KATEGORI</option> --}}
                        @foreach ($codeCategory as $key => $row)
                        <option value="{{ $row->tblitemcategory_id }}" {{ $Warranty->tblitemcategory_id ==
                            $row->tblitemcategory_id ? 'selected' : '' }}>
                            {{ $row->tblitemcategory_code }} -
                            {{ $row->tblitemcategory_name }}</option>
                        @endforeach
                    </select>
                    <label for="category-code" class="col-form-label">Kode Kategori</label>
                </div>
                <div class="form-floating mb-3">

                    <select class="form-control" name="brandcodeedit" id="brand-code">
                        {{-- <option value="">PILIH KODE MEREK</option> --}}
                        @foreach ($codeBrand as $key => $row)
                        <option value="{{ $row->tblitembrand_id }}" {{ $Warranty->tblitembrand_id ==
                            $row->tblitembrand_id ? 'selected' : '' }}>
                            {{ $row->tblitembrand_code }} -
                            {{ $row->tblitembrand_name }}</option>
                        @endforeach
                    </select>
                    <label for="brand-code" class="col-form-label">Kode Merek</label>
                </div>
                <div class="mb-3">
                    <label for="model-code" class="col-form-label">Kode Model</label>

                    <select class="form-control" style="width: 100%" name="modelcode" id="model-code">
                    </select>
                </div>

                <div class="form-floating mb-3">

                    <input type="text" class="form-control" name="sntransaction" id="sn-transaction"
                        value="{{ old('sntransaction', $Warranty->tblitemwarrant_SN) }}">
                    <label for="sn-transaction" class="col-form-label">SN</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="dokbukti" id="dok-bukti"
                        value="{{ old('dokbukti', $Warranty->tblitemwarrant_dokBukti) }}">
                    <label for="dok-bukti" class="col-form-label">Dokumen Bukti</label>
                </div>
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" name="distributorname" id="distributor-id"
                        value="{{ old('distributorname', $Warranty->tblitemwarrant_distributor) }}">
                    <label for="distributor-id" class="col-form-label">Distributor</label>
                </div>
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" name="pemakainame" id="pemakai-id"
                        value="{{ old('pemakainame', $Warranty->tblitemwarrant_username) }}">
                    <label for="pemakai-id" class="col-form-label">Pemakai</label>
                </div>
                <div class="form-floating mb-3">

                    <input type="text" class="form-control" name="lokasiname" id="lokasi-id"
                        value="{{ old('lokasiname', $Warranty->tblitemwarrant_location) }}">
                    <label for="lokasi-id" class="col-form-label">Lokasi</label>
                </div>
                <div class="form-floating mb-3">


                    <input type="date" class="form-control" name="tanggalbeliname"
                        value="{{ old('tanggalbeliname', date('Y-m-d', strtotime($Warranty->tblitemwarrant_purchaseDate)), date('Y-m-d')) }}"
                        id="tanggal-beli-id">
                    {{-- <p>{{ $Warranty->tblitemwarrant_purchaseDate }}</p> --}}
                    <label for="tanggal-beli-id" class="col-form-label">Tanggal Pembelian</label>
                </div>
                <div class="form-floating mb-3">

                    <input type="number" class="form-control" min="1"
                        value="{{ old('periodname', $Warranty->tblitemwarrant_monthPeriod) }}" max="100"
                        name="periodname" id="period-id">
                    <label for="period-id" class="col-form-label">Periode Bulan</label>
                </div>
                <div class="form-floating mb-3">

                    <select class="form-control" name="statusname" id="status-id">
                        @foreach ($codeStatus as $key => $row)
                        <option value="{{ $row->tblitemstatus_id }}" {{ $Warranty->tblitemstatus_id ==
                            $row->tblitemstatus_id ? 'selected' : '' }}>
                            {{ $row->tblitemstatus_name }}</option>
                        @endforeach
                    </select>
                    <label for="status-id" class="col-form-label">Status</label>
                </div>
                <div class="form-floating mb-3">

                    <textarea name="note" style="height: 100px" class="form-control"
                        id="note-id">{{ old('note', $Warranty->tblitemwarrant_note) }}</textarea>
                    <label for="catatan-id" class="col-form-label">Catatan</label>

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
                <button type="submit" id="submitbtn" class="btn btn-primary">{{ __('Simpan') }}</button>
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
{{-- @if ($errors->any() && old('action') == 'create')
ModalCreateShow();
@endif;
@if(Session::has('error'))
ModalErrorShow();
@endif;
@if(Session::has('success'))
ModalSuccessShow();
@endif; --}}

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
var SelectedData = JSON.parse(data);
var Length = (SelectedData.length);
for (let i = 0; i < Length; i++) { if(SelectedData[i].id=={{ $Warranty->tblitemmodel_id
    }}) SelectedData[i].selected = true };
    var X = JSON.stringify(SelectedData);
    $("#model-code").select2({
    data: JSON.parse(X),
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
    @endsection
