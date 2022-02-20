<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\itemCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    public $messages = [
        'categorycode.required' => 'Kode Kategori wajib diisi',
        'categorycode.min' => 'Kode Kategori Minimal :min Karakter',
        'categorycode.max' => 'Kode Kategori Maximal :max Karakter',
        'categorycode.unique' => 'Kode Kategori sudah ada sebelumnya.',
        'categoryname.required' => 'Nama Kategori wajib diisi',
        'categoryname.max' => 'Nama Kategori Maximal :max Karakter.',
        'categoryname.unique' => 'Nama Kategori sudah ada sebelumnya.',
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

        $category = itemCategory::orderBy('tblitemcategory_code', 'asc')->paginate(10);
        $requestParam = '';

        return view('category.index', compact('category', 'requestParam'));
    }

    public function add(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'categorycode' => 'required|min:4|max:4|unique:tbl_gr_m_item_category,tblitemcategory_code',
            'categoryname' => 'required|max:50|unique:tbl_gr_m_item_category,tblitemcategory_name',
        ], $this->messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $idAuth = Auth::user()->id;

        $category = new itemCategory;
        $category->tblitemcategory_code = strtoupper($req->categorycode);
        $category->tblitemcategory_name = $req->categoryname;
        $category->tblitemcategory_createdBy = $idAuth;
        $category->tblitemcategory_modifyBy = $idAuth;
        $category->save();


        Session::flash('success','Data berhasil tertambah');

        return redirect()->back();
    }

    public function viewdetail($id)
    {
        $category = itemCategory::find($id);

        return view('category.view', compact('category'));
    }

    public function edit($id)
    {
        $category = itemCategory::find($id);

        return view('category.edit', compact('category'));
    }

    public function editdetail($id, Request $req)
    {
        $category = itemCategory::find($id);

        $validator = Validator::make($req->all(), [
            'categorycode' => 'required|min:4|max:4',
            'categoryname' => 'required|max:50',
        ], $this->messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $idAuth = Auth::user()->id;

        $category->tblitemcategory_code = strtoupper($req->categorycode);
        $category->tblitemcategory_name = $req->categoryname;
        $category->tblitemcategory_createdBy = $idAuth;
        $category->tblitemcategory_modifyBy = $idAuth;
        $category->save();

        Session::flash('success','Data berhasil terupdate');
        return redirect(route('category'));
    }

    public function search(Request $req)
    {

        if($req->param == ""){
            Session::flash('error','Pencarian tidak terisi');
            return redirect()->back();
        }
        $category = itemCategory::where('tblitemcategory_name', 'like', $req->param . '%')->orWhere('tblitemcategory_code', 'like', $req->param . '%')->orderBy('tblitemcategory_createdOn', 'desc')->paginate(10);
        $requestParam = $req->param;

        return view('category.index', compact('category', 'requestParam'));
    }
}
