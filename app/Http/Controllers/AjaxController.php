<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\danhmuc1;
use App\danhmuc;
use App\danhmuchsx;
use Lang, Session;
use Illuminate\Http\Response;

class AjaxController extends RightController
{   
    public function __construct () {
        $lang = Session::get('locale');
        if ($lang != null) \App::setLocale($lang);
    }
    
    public function getloaiphong($id){
        $danhmuc = danhmuc1::where('id_danhmuc','=',$id)->get();
        echo "<option value='0'>All</option>";
        foreach($danhmuc as $dm){
            $id = $dm['id'];
            $name = $dm['name'];
            echo "<option value='$id'>$name</option>";
        }
	}

	public function getdanhmuchsx($id){
        $danhmuc = danhmuchsx::where('id_danhmuc','=',$id)->get();
        echo "<option value='0'>All</option>";
        foreach($danhmuc as $dm){
            $id = $dm['id'];
            $name = $dm['name_'.Session::get('locale')];
            echo "<option value='$id'>$name</option>";
        }
	}
}

