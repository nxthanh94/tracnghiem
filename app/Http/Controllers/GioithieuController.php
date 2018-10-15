<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gioithieu;
use Illuminate\Http\Response;

class GioithieuController extends RightController
{

    public function detail($slug, $id){
    	$arItems = gioithieu::find($id);
    	return view('aboutus.index',[
    		'arItems' => $arItems
    	]);
    }

}
