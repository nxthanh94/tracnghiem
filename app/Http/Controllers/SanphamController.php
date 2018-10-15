<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sanpham;
use App\hangsx;
use App\hoadon;
use App\chitiethoadon;
use App\phanhoi;
use App\User;
use App\thanhtoan;
use App\phong;
use App\danhmuc1;
use App\danhmuc;
use App\tienich;
use App\danhmuchsx;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Response;

class SanphamController extends RightController
{

    public function index(){
        $arDanhMuc = danhmuc::get();
        $arHuyen = danhmuchsx::where('id_danhmuc','=',1)->get();
        $arItems = phong::where('hienthi','=',1)->orderBy('id','desc')->paginate(15);
        return view('phong.index',[
            'arHuyen' => $arHuyen,
            'arDanhMuc' => $arDanhMuc,
            'arItems' => $arItems,
        ]);
    }

    public function quanhuyen($slug, $id){
        $arDanhMuc1 = danhmuc::get();
        $arHuyen = danhmuchsx::where('id_danhmuc','=',1)->get();
        $arItems = phong::where('id_hangsx','=',1)->where('id_danhmuchsx','=',$id)->where('hienthi','=',1)->orderBy('id','desc')->paginate(15);
        $arDanhmuc = phong::where('id_danhmuchsx','=',$id)->first();
        if(isset($arDanhmuc->id_danhmuchsx)){
            $arName = danhmuchsx::where('id','=',$arDanhmuc->id_danhmuchsx)->first();
            $namedm = $arName['name_vn'];
            return view('phong.quanhuyen',[
                'arItems' => $arItems,
                'arName' => $arName,
                'namedm' => $namedm,
                'arHuyen' => $arHuyen,
                'arDanhMuc1' => $arDanhMuc1,
            ]);
        }
        else{
            return view('phong.capnhat',[
                'arItems' => $arItems
            ]);
        }
    }

    public function kieunha($slug, $id){
        $arDanhMuc1 = danhmuc::get();
        $arHuyen = danhmuchsx::where('id_danhmuc','=',1)->get();
        $arItems = phong::where('id_danhmuc','=',$id)->where('hienthi','=',1)->orderBy('id','desc')->paginate(15);
        $arDanhmuc = phong::where('id_danhmuc','=',$id)->first();
        if(isset($arDanhmuc->id_danhmuc)){
            $arName = danhmuc::where('id','=',$arDanhmuc->id_danhmuc)->first();
            $namedm = $arName['name_vn'];
            return view('phong.quanhuyen',[
                'arItems' => $arItems,
                'arName' => $arName,
                'namedm' => $namedm,
                'arDanhMuc1' => $arDanhMuc1,
                'arHuyen' => $arHuyen,
            ]);
        }
        else{
            return view('phong.capnhat',[
                'arItems' => $arItems
            ]);
        }
    }

    public function xemphong($slug, $id){
        $arItems = phong::find($id);
        $arDanhMuc1 = danhmuc::get();
        $arHuyen = danhmuchsx::where('id_danhmuc','=',1)->get();
        if(isset($arItems->id_danhmuc)){
            $arLienQuan = phong::where('id_danhmuc','=',$arItems->id_danhmuc)->where('id','!=',$id)->where('hienthi','=',1)->orderBy('id','desc')->take(3)->get();
        }

        return view('phong.detail',[
            'arItems' => $arItems,
            'arLienQuan' => $arLienQuan,
            'arDanhMuc1' => $arDanhMuc1,
            'arHuyen' => $arHuyen,
        ]);
    }

    public function timkiem(Request $request){
        $arDanhMuc = danhmuc::get();
        $arHuyen = danhmuchsx::where('id_danhmuc','=',1)->get();
        $tukhoa = $request->tukhoa;
        $city = $request->city;
        $category = $request->category;

        $arSanpham = phong::where('id','!=',0);
        if($city != ""){
            $arSanpham->where('id_danhmuchsx',$city);
        }
        if($category != ""){
            $arSanpham->where('id_danhmuc',$category);
        }
        
        if($tukhoa != "")
            $arSanpham->where('ten_vn','like',"%$tukhoa%")
        ->orWhere('chitiet_vn','like',"%$tukhoa%");

        $houses = $arSanpham->where('hienthi','=',1)->paginate(15);
        $Count = $arSanpham->count();

        return  view('phong.search',[
            'tukhoa' => $tukhoa,
            'city' => $city,
            'category' => $category,
            'arCat' => $this->_arCat,
            'arCat1' => $this->_arCat1,
            'arItems' => $houses,
            'Count' => $Count,
            'arDanhMuc' => $arDanhMuc,
            'arHuyen' => $arHuyen,
        ]);

    }


}
