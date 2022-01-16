<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\itemCategory;
use App\itemBrand;
use App\itemModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class modelController extends Controller
{
    public $messages = [
        'categorycode.required' => 'Kategori tidak dipilih',
        'brandcode.required' => 'Merek tidak dipilih',
        'modelcode.required' => 'Kode Model wajib diisi',
        'modelcode.unique' => 'Kode Model sudah ada sebelumnya.',
        'modelname.required' => 'Deskripsi Model wajib diisi',
        'modelname.max' => 'Deskripsi Model Maximal :max Karakter.',
        'modelname.unique' => 'Deskripsi Model sudah ada sebelumnya.',
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $brand = itemCategory::where('tblitembrand_code','like','ST-04')->orWhere('tblitembrand_id','like','5')->orderBy('tblitembrand_name','asc')->get();

        $codeCategory = itemCategory::orderBy('tblitemcategory_code','asc')->get();
        $codeBrand = itemBrand::orderBy('tblitembrand_code','asc')->get();
        $model = itemModel::join('tbl_gr_m_item_category','tbl_gr_m_item_category.tblitemcategory_id','=','tbl_gr_m_item_model.tblitemcategory_id')->join('tbl_gr_m_item_brand','tbl_gr_m_item_brand.tblitembrand_id','=','tbl_gr_m_item_model.tblitembrand_id')->orderBy('tblitemmodel_codeModel','asc')->paginate(10);
        $requestParam = '';

        return view('model.index', compact('codeCategory','codeBrand','model','requestParam'));
    }

    public function add(Request $req)
    {



        $validator = Validator::make($req->all(),[
            'modelcode' => 'required|unique:tbl_gr_m_item_model,tblitemmodel_codeModel',
            'categorycode' => 'required',
            'brandcode' => 'required',
            'modelname' => 'required|max:50|unique:tbl_gr_m_item_model,tblitemmodel_descriptionModel',
        ],$this->messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $idAuth = Auth::user()->id;

        $model = new itemModel();
        $model->tblitemcategory_id = $req->categorycode;
        $model->tblitembrand_id = $req->brandcode;
        $model->tblitemmodel_codeModel = $req->modelcode;
        $model->tblitemmodel_descriptionModel = $req->modelname;
        $model->tblitemmodel_createdBy = $idAuth;
        $model->tblitemmodel_modifyBy = $idAuth;
        $model->save();
         Session::flash('success','Data berhasil tertambah');

        return redirect()->back();
    }

    public function edit($id)
    {
        $codeCategory = itemCategory::orderBy('tblitemcategory_code','asc')->get();
        $codeBrand = itemBrand::orderBy('tblitembrand_code','asc')->get();
        $model = itemModel::find($id);

        return view('model.edit',compact('model','codeCategory','codeBrand'));
    }

    // public function viewdetail($id)
    // {
    //     $brand = itemCategory::find($id);

    //     return view('brand.view',compact('brand'));
    // }

    public function editdetail($id, Request $req)
    {
        $model = itemModel::find($id);


        $validator = Validator::make($req->all(),[
            'modelcode' => 'required',
            'categorycode' => 'required',
            'brandcode' => 'required',
            'modelname' => 'required|max:50',
        ],$this->messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $idAuth = Auth::user()->id;

        $model->tblitemcategory_id = $req->categorycode;
        $model->tblitembrand_id = $req->brandcode;
        $model->tblitemmodel_codeModel = $req->modelcode;
        $model->tblitemmodel_descriptionModel = $req->modelname;
        $model->tblitemmodel_createdBy = $idAuth;
        $model->tblitemmodel_modifyBy = $idAuth;
        $model->save();

        Session::flash('success','Data berhasil terupdate');


        return redirect(route('model'));
    }

    public function search(Request $req){

        if($req->param == ""){
            Session::flash('error','Pencarian tidak terisi');
            return redirect()->back();
        }
        $codeCategory = itemCategory::orderBy('tblitemcategory_code','asc')->get();
        $codeBrand = itemBrand::orderBy('tblitembrand_code','asc')->get();
        $model = itemModel::join('tbl_gr_m_item_category','tbl_gr_m_item_category.tblitemcategory_id','=','tbl_gr_m_item_model.tblitemcategory_id')->
        join('tbl_gr_m_item_brand','tbl_gr_m_item_brand.tblitembrand_id','=','tbl_gr_m_item_model.tblitembrand_id')->where('tblitemmodel_descriptionModel','like',$req->param.'%')->orWhere('tblitemmodel_codeModel','like',$req->param.'%')->orderBy('tblitemmodel_codeModel','asc')->paginate(10);
        $requestParam = '';

        return view('model.index', compact('codeCategory','codeBrand','model','requestParam'));
    }
}
