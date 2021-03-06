<?php

namespace App\Http\Controllers;

use App\itemWarranty;
use Illuminate\Http\Request;
use PDF;
use App\User;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function PDFGenerate(Request $request,$id)
    {
        $warranty = DB::table('tbl_gr_t_item_warranty')->join
        ('tbl_gr_m_item_model',
        'tbl_gr_m_item_model.tblitemmodel_id',
        '=',
        'tbl_gr_t_item_warranty.tblitemmodel_id'
        )
        ->join(
            'tbl_gr_m_item_category',
            'tbl_gr_m_item_model.tblitemcategory_id',
            '=',
            'tbl_gr_m_item_category.tblitemcategory_id'
        )
        ->join(
            'tbl_gr_m_item_brand',
            'tbl_gr_m_item_brand.tblitembrand_id',
            '=',
            'tbl_gr_m_item_model.tblitembrand_id'
        )->where('tblitemwarranty_id','=',$id)->get();
        // return view('PDFOutput', ['Warranty'=>$warranty]);
        // dd($warranty);
        $pdf = PDF::loadview('PDFOutput',['Warranty'=>$warranty]);
        return $pdf->stream('Warranty.pdf');
    	// return $pdf->download('laporan-pegawai.pdf');
    }
}
