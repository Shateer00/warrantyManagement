<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\itemCategory;
use App\itemBrand;
use App\itemModel;
use App\itemStatus;
use App\itemWarranty;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class warrantyController extends Controller
{
    public function index()
    {
        $codeCategory = itemCategory::orderBy('tblitemcategory_code', 'asc')->get();
        $codeBrand =    itemBrand::orderBy('tblitembrand_code', 'asc')->get();
        $codeStatus = itemStatus::orderBy('tblitemstatus_id', 'asc')->get();
        // $Warranty = itemWarranty::orderBy('tblitemwarranty_id','asc')->join()->get();
        // $codeModel = itemModel::orderBy('tblitemmodel_codeModel', 'asc')->get();
        $Warranty = itemWarranty::join('tbl_gr_m_item_model', 'tbl_gr_t_item_warranty.tblitemmodel_id', '=', 'tbl_gr_m_item_model.tblitemmodel_id')->join('tbl_gr_m_item_category', 'tbl_gr_m_item_category.tblitemcategory_id', '=', 'tbl_gr_m_item_model.tblitemcategory_id')->join('tbl_gr_m_item_brand', 'tbl_gr_m_item_brand.tblitembrand_id', '=', 'tbl_gr_m_item_model.tblitembrand_id')->orderBy('tblitemmodel_codeModel', 'asc')->paginate(10);
        $requestParam = '';
        // ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        return view('warranty.index', compact('codeCategory', 'codeBrand', 'codeStatus', 'Warranty', 'requestParam'));
    }

    public function getModel(Request $req)
    {
        $model = itemModel::where('tblitemcategory_id', '=', $req->CategoryCode)->where('tblitembrand_id', '=', $req->BrandCode)->get();
        $dataObj = array();
        foreach ($model as $m) {
            $stdClass = new \stdClass();
            $stdClass->id = $m->tblitemmodel_id;
            $stdClass->text = $m->tblitemmodel_codeModel . " - " . $m->tblitemmodel_descriptionModel;
            array_push($dataObj, $stdClass);
        }
        return json_encode($dataObj);
    }



    public function add(Request $req)
    {
        $messages = [
            'modelcode.required' => 'Kode Model wajib diisi',
            'categorycode.required' => 'Kode Katergori wajib diisi',
            'brandcode.required' => 'Kode Merek wajib diisi',
            'sntransaction.required' => 'SN wajib diisi',
            'dokbukti.required' => 'Dokumen Bukti wajib diisi',
            'distributorname.required' => 'Nama Distributor wajib diisi',
            'pemakainame.required' => 'Nama Pemakai wajib diisi',
            'lokasiname.required' => 'Nama Lokasi wajib diisi',
            'tanggalbeliname.required' => 'Tanggal Beli wajib diisi',
            'periodname.required' => 'Periode wajib diisi',
            'statusname.required' => 'Status wajib diisi',
            // 'note.required' => 'Note wajib diisi',
        ];


        $validator = Validator::make($req->all(), [
            'modelcode' => 'required',
            'categorycode' => 'required',
            'brandcode' => 'required',
            'sntransaction' => 'required',
            'dokbukti' => 'required',
            'distributorname' => 'required',
            'pemakainame' => 'required',
            'lokasiname' => 'required',
            'tanggalbeliname' => 'required',
            'periodname' => 'required',
            'statusname' => 'required',
            // 'note' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $idAuth = Auth::user()->id;
        // $model = new itemModel();
        // $model->tblitemcategory_id = $req->categorycode;
        // $model->tblitembrand_id = $req->brandcode;
        // $model->tblitemmodel_codeModel = $req->modelcode;
        // $model->tblitemmodel_descriptionModel = $req->modelname;
        // $model->tblitemmodel_createdBy = 532;
        // $model->tblitemmodel_modifyBy = 532;

        $transaction = new itemWarranty();
        // 'modelcode' => 'required',
        // 'categorycode' => 'required',
        // 'brandcode' => 'required',
        // 'sntransaction' => 'required',
        // 'dokbukti' => 'required',
        // 'distributorname' => 'required',
        // 'pemakainame' => 'required',
        // 'lokasiname' => 'required',
        // 'tanggalbeliname' => 'required',
        // 'periodname' => 'required',
        // 'statusname' => 'required',
        // 'mode' => 'required',
        $transaction->tblitemmodel_id = $req->modelcode;
        $transaction->tblitemwarrant_SN = $req->sntransaction;
        $transaction->tblitemwarrant_dokBukti = $req->dokbukti;
        $transaction->tblitemwarrant_distributor = $req->distributorname;
        $transaction->tblitemwarrant_username = $req->pemakainame;
        $transaction->tblitemwarrant_location = $req->lokasiname;
        $transaction->tblitemwarrant_purchaseDate = $req->tanggalbeliname;
        $transaction->tblitemwarrant_monthPeriod = $req->periodname;
        $transaction->tblitemstatus_id = $req->statusname;
        if ($req->note === null) {
            $transaction->tblitemwarrant_note = "";
        } else {
            $transaction->tblitemwarrant_note = $req->note;
        }
        $transaction->tblitemwarrant_createdBy = $idAuth;
        $transaction->tblitemwarrant_modifyBy = $idAuth;
        $transaction->save();

        return redirect()->back();
    }

    // public function viewdetail($id)
    // {
    //     $brand = itemCategory::find($id);

    //     return view('brand.view',compact('brand'));
    // }


    public function editdetail($id, Request $req)
    {
        $transaction = itemWarranty::find($id);
        $messages = [
            'modelcodeedit.required' => 'Kode Model wajib diisi',
            'categorycodeedit.required' => 'Kode Katergori wajib diisi',
            'brandcodeedit.required' => 'Kode Merek wajib diisi',
            'sntransaction.required' => 'SN wajib diisi',
            'dokbukti.required' => 'Dokumen Bukti wajib diisi',
            'distributorname.required' => 'Nama Distributor wajib diisi',
            'pemakainame.required' => 'Nama Pemakai wajib diisi',
            'lokasiname.required' => 'Nama Lokasi wajib diisi',
            'tanggalbeliname.required' => 'Tanggal Beli wajib diisi',
            'periodname.required' => 'Periode wajib diisi',
            'statusname.required' => 'Status wajib diisi',
            // 'note.required' => 'Note wajib diisi',
        ];


        $validator = Validator::make($req->all(), [
            'modelcodeedit' => 'required',
            'categorycodeedit' => 'required',
            'brandcodeedit' => 'required',
            'sntransaction' => 'required',
            'dokbukti' => 'required',
            'distributorname' => 'required',
            'pemakainame' => 'required',
            'lokasiname' => 'required',
            'tanggalbeliname' => 'required',
            'periodname' => 'required',
            'statusname' => 'required',
            // 'note' => 'required',
        ], $messages);
        $idAuth = Auth::user()->id;

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $transaction->tblitemmodel_id = $req->modelcodeedit;
        $transaction->tblitemwarrant_SN = $req->sntransaction;
        $transaction->tblitemwarrant_dokBukti = $req->dokbukti;
        $transaction->tblitemwarrant_distributor = $req->distributorname;
        $transaction->tblitemwarrant_username = $req->pemakainame;
        $transaction->tblitemwarrant_location = $req->lokasiname;
        $transaction->tblitemwarrant_purchaseDate = $req->tanggalbeliname;
        $transaction->tblitemwarrant_monthPeriod = $req->periodname;
        $transaction->tblitemstatus_id = $req->statusname;
        if ($req->note === null) {
            $transaction->tblitemwarrant_note = "";
        } else {
            $transaction->tblitemwarrant_note = $req->note;
        }
        $transaction->tblitemwarrant_createdBy = $idAuth;
        $transaction->tblitemwarrant_modifyBy = $idAuth;
        $transaction->save();



        return redirect(route('warranty'));
    }

    public function edit($id)
    {
        $codeCategory = itemCategory::orderBy('tblitemcategory_code', 'asc')->get();
        $codeBrand =    itemBrand::orderBy('tblitembrand_code', 'asc')->get();
        $codeStatus = itemStatus::orderBy('tblitemstatus_id', 'asc')->get();
        // $Warranty = itemWarranty::orderBy('tblitemwarranty_id','asc')->join()->get();
        // $codeModel = itemModel::orderBy('tblitemmodel_codeModel', 'asc')->get();
        $Warranty = itemWarranty::join('tbl_gr_m_item_model', 'tbl_gr_t_item_warranty.tblitemmodel_id', '=', 'tbl_gr_m_item_model.tblitemmodel_id')->join('tbl_gr_m_item_category', 'tbl_gr_m_item_category.tblitemcategory_id', '=', 'tbl_gr_m_item_model.tblitemcategory_id')->join('tbl_gr_m_item_brand', 'tbl_gr_m_item_brand.tblitembrand_id', '=', 'tbl_gr_m_item_model.tblitembrand_id')->orderBy('tblitemmodel_codeModel', 'asc')->find($id);

        return view('warranty.edit', compact('Warranty', 'codeCategory', 'codeBrand', 'codeStatus'));
    }

    public function search(Request $req)
    {


        $codeCategory = itemCategory::orderBy('tblitemcategory_code', 'asc')->get();
        $codeBrand =    itemBrand::orderBy('tblitembrand_code', 'asc')->get();
        $codeStatus = itemStatus::orderBy('tblitemstatus_id', 'asc')->get();
        // $model = itemModel::join('tbl_gr_m_item_category','tbl_gr_m_item_category.tblitemcategory_id','=','tbl_gr_m_item_model.tblitemcategory_id')->
        // join('tbl_gr_m_item_brand','tbl_gr_m_item_brand.tblitembrand_id','=','tbl_gr_m_item_model.tblitembrand_id')->where('tblitemmodel_descriptionModel','like','%'.$req->param.'%')->orderBy('tblitemmodel_codeModel','asc')->paginate(10);
        // dd($model);
        // $req = '';

        $Warranty = itemWarranty::join('tbl_gr_m_item_model', 'tbl_gr_t_item_warranty.tblitemmodel_id', '=', 'tbl_gr_m_item_model.tblitemmodel_id')->join('tbl_gr_m_item_category', 'tbl_gr_m_item_category.tblitemcategory_id', '=', 'tbl_gr_m_item_model.tblitemcategory_id')->join('tbl_gr_m_item_brand', 'tbl_gr_m_item_brand.tblitembrand_id', '=', 'tbl_gr_m_item_model.tblitembrand_id')->where('tblitemwarrant_SN', 'like', $req->param . '%')->orderBy('tblitemmodel_codeModel', 'asc')->paginate(10);
        $requestParam = $req->param;

        return view('warranty.index', compact('codeCategory', 'codeBrand', 'codeStatus', 'Warranty', 'requestParam'));
    }
}
