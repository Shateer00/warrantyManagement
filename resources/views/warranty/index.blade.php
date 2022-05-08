@extends('layouts.app')
@section('title')
Garansi
@endsection
@section('content')
<div class="pl-3 pt-4 pr-3 pb-4">
    <div class="row">
        <div class="pt-3 pl-3 pb-3 col-md">
            <button type="button" id="buttonAddWarranty" class="btn btn-dark" data-toggle="modal" data-backdrop="static"
                data-keyboard="false" data-target="#createModal" data-whatever="@mdo"><i
                    class="fas fa-plus"></i></button>
        </div>
        <div class="pt-3 pl-3 pb-3 col-md-4">
            <form class="form-inline my-2 my-lg-0" action="{{ route('warranty.search') }}" method="get">
                @if ($requestParam == '')
                <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search" name='param'>
                @else
                <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search" name='param'
                    value="{{ $requestParam }}">
                @endif
                <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <a class="btn btn-secondary my-2 my-sm-0 ml-3" href="{{ route('warranty') }}">


                    <i class="fas fa-redo"></i></a>
            </form>
        </div>
    </div>

    <div class="col-12">
        <h3 class="text-dark">List Garansi Barang</h3>
        @if (count($Warranty) == 0)
        <div class="align-items-center justify-content-center flex-row d-flex py-4">
            <div class="card bg-info flex-center">
                <div class="card-body EmptyTable">
                    <a class="text-white">Data Garansi belum ada / Tidak ditemukan</a>
                </div>
            </div>
        </div>
        @else
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th scope="col" class="col-1 ">
                        Nomor
                    </th>
                    <th scope="col" class="col-1 ">
                        @sortablelink('tblitemwarrant_SN','SN')
                    </th>
                    <th scope="col" class="col-2 ">
                        Kategori
                    </th>
                    <th scope="col" class="col-2 ">
                        Merek
                    </th>
                    <th scope="col" class="col-2 ">
                        @sortablelink('tblitemmodel_id','Model')
                    </th>
                    <th scope="col" class="col-1 ">
                        @sortablelink('tblitemstatus_id','Status')
                    </th>
                    <th scope="col" class="col-1 ">
                        Warranty
                    </th>
                    <th scope="col" class="col-1 ">
                        Sub Menu
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Warranty as $key => $row)
                <tr>
                    <td data-label="Nomor" class="RowNumber  Oswald">
                        {{ $Warranty->firstItem() + $key }}
                    </td>
                    <td data-label="SN" class=" Oswald">
                        {{ $row->tblitemwarrant_SN }}
                    </td>
                    <td data-label="Kategori" class=" Oswald">

                        {{ $row->tblitemcategory_code }} - {{ $row->tblitemcategory_name }}
                    </td>
                    <td data-label="Merek" class=" Oswald">

                        {{ $row->tblitembrand_code }} - {{ $row->tblitembrand_name }}
                    </td>

                    <td data-label="Model" class=" Oswald">
                        {{ Str::limit($row->tblitemmodel_codeModel . ' - ' . $row->tblitemmodel_descriptionModel, 30) }}
                    </td>
                    <td bgcolor="{{ $row->tblitemstatus_colorCode }}" data-label="Status" class=" Oswald">
                        {{ $row->tblitemstatus_name }}
                    </td>
                    <td data-label="Warranty" class=" Oswald" bgcolor="
                                @if (
                                \Carbon\Carbon::parse($currentDate)->diffInDays(\Carbon\Carbon::parse($row->tblitemwarrant_purchaseDate)->addMonths($row->tblitemwarrant_monthPeriod),false)
                                    >=
                                    Carbon\Carbon::now()->daysInMonth
                                )
                                    #22D122
                                @elseif (
                                \Carbon\Carbon::parse($currentDate)->diffInDays(\Carbon\Carbon::parse($row->tblitemwarrant_purchaseDate)->addMonths($row->tblitemwarrant_monthPeriod),false)
                                >=
                                14
                                )
                                    #F1F222
                                @else
                                    #F12222
                                @endif
                            ">
                        <p style="font-weight: 600">Sisa Hari : {{
                            \Carbon\Carbon::parse($currentDate)->diffInDays(\Carbon\Carbon::parse($row->tblitemwarrant_purchaseDate)->addMonths($row->tblitemwarrant_monthPeriod),false)
                            }}</p>

                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('warranty.view', $row->tblitemwarranty_id) }}">
                            <span class="btnEdit"><i class="fas fa-info"></i>&nbsp;Info</span>
                        </a>
                        <a class="btn btn-primary" href="{{ route('warranty.edit', $row->tblitemwarranty_id) }}">
                            <span class="btnEdit"><i class="fas fa-edit"></i>&nbsp;Edit</span>
                        </a>
                        <a class="nav-link font-weight-bold"
                            href="{{ route('PDFGenerate',$row->tblitemwarranty_id) }}">{{ __('PDF') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $Warranty->links() }}
        @endif
    </div>

</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog">
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

                    <div class="form-floating mb-3">

                        <input type="hidden" name="action" value="create">

                        <select class="form-select" name="categorycode" id="category-code">
                            {{-- <option value="">PILIH KODE KATEGORI</option> --}}
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
                            {{-- <option value="">PILIH KODE MEREK</option> --}}
                            @foreach ($codeBrand as $key => $row)
                            <option value="{{ $row->tblitembrand_id }}" {{ old('brandcode')==$row->tblitembrand_id ?
                                'selected' : '' }}>
                                {{ $row->tblitembrand_code }} -
                                {{ $row->tblitembrand_name }}</option>
                            @endforeach
                        </select>
                        <label for="brand-code" class="form-label">Kode Merek</label>
                    </div>
                    <div class="mb-3">
                        <label for="model-code" class="col-form-label">Kode Model</label>

                        <select class="form-control" style="width: 100%" name="modelcode" id="model-code">
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="sntransaction" id="sn-transaction"
                            value="{{ old('sntransaction') }}" placeholder="SN">
                        <label for="sn-transaction" class="col-form-label">SN</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="dokbukti" id="dok-bukti"
                            value="{{ old('dokbukti') }}" placeholder="Dokumen Bukti">
                        <label for="dok-bukti" class="col-form-label">Dokumen Bukti</label>
                    </div>
                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" name="distributorname" id="distributor-id"
                            value="{{ old('distributorname') }}" placeholder="Distributor">
                        <label for="distributor-id" class="col-form-label">Distributor</label>
                    </div>
                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" name="pemakainame" id="pemakai-id"
                            value="{{ old('pemakainame') }}" placeholder="Pemakai">
                        <label for="pemakai-id" class="col-form-label">Pemakai</label>
                    </div>
                    <div class="form-floating mb-3">

                        <input type="text" class="form-control" name="lokasiname" id="lokasi-id"
                            value="{{ old('lokasiname') }}" placeholder="Lokasi">
                        <label for="lokasi-id" class="col-form-label">Lokasi</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" placeholder="Date" class="form-control" name="tanggalbeliname"
                            value="{{ old('tanggalbeliname', date('Y-m-d')) }}" id="tanggal-beli-id">
                        <label for="tanggal-beli-id" class="col-form-label">Tanggal Pembelian</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" min="1" value="{{ old('periodname') }}" max="100"
                            name="periodname" id="period-id" placeholder="Period">
                        <label for="period-id" class="col-form-label">Periode Bulan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="statusname" id="status-id">
                            @foreach ($codeStatus as $key => $row)
                            <option value="{{ $row->tblitemstatus_id }}" {{ old('statusname')==$row->tblitemstatus_id ?
                                'selected' : '' }}>
                                {{ $row->tblitemstatus_name }}</option>
                            @endforeach
                        </select>

                        <label for="status-id" class="form-label">Status</label>
                    </div>
                    <div class="form-floating mb-3">

                        <textarea name="note" style="height: 100px" class="form-control" id="note-id"
                            placeholder="note">{{ old('note') }}</textarea>
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
                    <div class="modal-footer">
                        <button type="submit" id="submitbtn" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
            </form>
        </div>
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
