<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\sanpham;

class RightController extends Controller
{
   	public $_arCat;
    public $_arCat1;
    public function __construct()
    {
    	$arCat = DB::table("tuyendung")->orderBy('id','=','desc')->take(4)->get();
    	$arCat1 = DB::table("news")->orderBy('id','=','desc')->take(4)->get();
        $this->_arCat = $arCat;
        $this->_arCat1 = $arCat1;
    }

  
}
