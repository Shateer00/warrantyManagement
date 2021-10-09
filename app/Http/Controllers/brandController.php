<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\itemBrand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class brandController extends Controller
{

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
        $brand = itemBrand::orderBy('tblitembrand_code', 'asc')->paginate(10);
        $requestParam = '';

        return view('brand.index', compact('brand', 'requestParam'));
    }

    public function add(Request $req)
    {
        $messages = [
            'brandcode.required' => 'Kode Merek wajib diisi.',
            'brandcode.min' => 'Kode Merek Minimal :min Karakter.',
            'brandcode.max' => 'Kode Merek Maximal :max Karakter.',
            'brandcode.unique' => 'Kode Merek sudah ada sebelumnya.',
            'brandname.required' => 'Nama Merek wajib diisi.',
            'brandname.unique' => 'Nama Merek sudah ada sebelumnya.',
            'brandname.max' => 'Nama Merek Maximal :max Karakter.',
        ];


        $validator = Validator::make($req->all(), [
            'brandcode' => 'required|min:4|max:4|unique:tbl_gr_m_item_brand,tblitembrand_code',
            'brandname' => 'required|max:100|unique:tbl_gr_m_item_brand,tblitembrand_name',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $idAuth = Auth::user()->id;

        $brand = new itemBrand;
        $brand->tblitembrand_code = strtoupper($req->brandcode);
        $brand->tblitembrand_name = $req->brandname;
        $brand->tblitembrand_createdBy = $idAuth;
        $brand->tblitembrand_modifyBy = $idAuth;
        $brand->save();

        return redirect()->back();
    }

    public function viewdetail($id)
    {
        $brand = itemBrand::find($id);

        return view('brand.view', compact('brand'));
    }

    public function edit($id)
    {
        $brand = itemBrand::find($id);

        return view('brand.edit', compact('brand'));
    }

    public function editdetail($id, Request $req)
    {
        $brand = itemBrand::find($id);

        $messages = [
            'brandcode.required' => 'Kode Merek wajib diisi.',
            'brandname.required' => 'Nama Merek wajib diisi.',
            'brandcode.min' => 'Kode Merek Minimal :min Karakter.',
            'brandcode.max' => 'Kode Merek Maximal :max Karakter.',
            'brandcode.exists' => 'Kode Merek sudah ada sebelumnya.',
            'brandname.exists' => 'Nama Merek sudah ada sebelumnya.'
        ];

        $validator = Validator::make($req->all(), [
            'brandcode' => 'required|min:4|max:4',
            'brandname' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $idAuth = Auth::user()->id;

        $brand->tblitembrand_code = strtoupper($req->brandcode);
        $brand->tblitembrand_name = $req->brandname;
        $brand->tblitembrand_createdBy = $idAuth;
        $brand->tblitembrand_modifyBy = $idAuth;
        $brand->save();

        return redirect(route('brand'));
    }

    public function search(Request $req)
    {

        $brand = itemBrand::where('tblitembrand_name', 'like', $req->param . '%')->orWhere('tblitembrand_code', 'like', $req->param . '%')->orderBy('tblitembrand_createdOn', 'desc')->paginate(10);
        $requestParam = $req->param;

        return view('brand.index', compact('brand', 'requestParam'));
    }
}
