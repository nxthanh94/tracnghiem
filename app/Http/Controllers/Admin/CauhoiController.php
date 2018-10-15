<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\cauhoi;
use App\linhvuc;
use App\phanquyen;
use Illuminate\Support\Facades\DB;
use Image;

class CauhoiController extends Controller
{
    public function index(){
        $arItems = DB::table('cauhoi')->get();
        
        return view('admin.cauhoi.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd(){
        $arItems = linhvuc::all();
        return view('admin.cauhoi.add',[
            'arItems' => $arItems
        ]);
    }

    public function postadd(Request $request){
        $name = $request->name;
        $id_cauhoi = $request->id_cauhoi;
        $linhvuc = $request->linhvuc;
        $a = $request->a;
        $b = $request->b;
        $c = $request->c;
        $d = $request->d;
        $dapan = $request->dapan;
        $arUsers = array(
            'name' => $name,
            'id_cauhoi' => $id_cauhoi,
            'id_linhvuc'     => $linhvuc,
            'a' => $a,
            'b' => $b,
            'c'     => $c,
            'd' => $d,
            'dapan' => $dapan,
        );

        
        cauhoi::insert($arUsers);

        $request->session()->flash('msg','Thêm thành công');
        return redirect()->route('admin.cauhoi.index');
    }

    public function getEdit($id, Request $request){
        $arItems = linhvuc::all();
        $arCauhoi = cauhoi::find($id);
        return view('admin.cauhoi.edit',[
            'arCauhoi' => $arCauhoi,
            'arItems' => $arItems,
        ]);
    }

    public function postedit($id, Request $request){
        $arCauhoi = cauhoi::find($id);

        $arCauhoi->name = $request->name;
        $arCauhoi->id_cauhoi = $request->id_cauhoi;
        $arCauhoi->id_linhvuc = $request->linhvuc;
        $arCauhoi->a = $request->a;
        $arCauhoi->b = $request->b;
        $arCauhoi->c = $request->c;
        $arCauhoi->d = $request->d;
        $arCauhoi->dapan = $request->dapan;

        $arCauhoi->update();

        $request->session()->flash('msg','Cập nhật thành công');
        return redirect()->route('admin.cauhoi.index');
    }

    public function del($id, Request $request){
        $arCauhoi = cauhoi::find($id);
        
        $arCauhoi->delete();
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.cauhoi.index');
        


    }


}
