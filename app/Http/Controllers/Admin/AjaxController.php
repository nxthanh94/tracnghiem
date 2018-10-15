<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\chitiethoadon;
use App\danhmuc1;
use App\danhmuc;
use App\danhmuchsx;

class AjaxController extends Controller
{
    public function getloaiphong($id){
        $danhmuc = danhmuc1::where('id_danhmuc','=',$id)->get();
        foreach($danhmuc as $dm){
            $id = $dm['id'];
            $name = $dm['name_vn'];
            echo "<option value='$id'>$name</option>";
        }
	}

	public function getdanhmuchsx($id){
        $danhmuc = danhmuchsx::where('id_danhmuc','=',$id)->get();
        foreach($danhmuc as $dm){
            $id = $dm['id'];
            $name = $dm['name_vn'];
            echo "<option value='$id'>$name</option>";
        }
	}
}
