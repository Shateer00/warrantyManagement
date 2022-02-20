<?php

namespace App\Http\Controllers;

use App\itemBrand;
use App\itemCategory;
use App\itemModel;
use App\itemStatus;
use App\itemWarranty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current = Carbon::now('WIB');
        // dd($current);

        $totalBrand = itemBrand::count();
        $totalCategory = itemCategory::count();
        $totalModel = itemModel::count();
        $totalWarranty = itemWarranty::count();

        return view('home',
        [
            'currentDate'=>$current,
            'totalBrand'=>$totalBrand ,
            'totalCategory'=>$totalCategory,
            'totalModel'=>$totalModel,
            'totalWarranty'=>$totalWarranty
        ]);
    }
}
