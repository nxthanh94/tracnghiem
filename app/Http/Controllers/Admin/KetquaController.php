<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\kythi;
use App\ketqua;
use App\cauhoi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class KetquaController extends Controller
{
    public function sathach(){
        $arItems = DB::table('ketqua')->where('active',1)->get();
        
        return view('admin.ketqua.sathach',[
            'arItems' => $arItems
        ]);
    }

    public function sathachxem($id){
        $arKetqua = ketqua::where('id',$id)->orderBy('id','desc')->first();

        $arKythi = kythi::find($arKetqua['id_kythi']);
        $arCheck = explode(',',$arKythi['cauhoi']);
        $arItems = cauhoi::whereIn('id',$arCheck)->get();

        return view('admin.ketqua.sathachxem',[ 
            'arKetqua' => $arKetqua,
            'arItems' => $arItems,
        ]);
    }

    public function luyentap(){
        $arItems = DB::table('ketqua')->where('active',0)->get();
        
        
        return view('admin.ketqua.luyentap',[
            'arItems' => $arItems,
        ]);
    }

    public function luyentapxem($id){
        $arKetqua = ketqua::where('id',$id)->orderBy('id','desc')->first();

        $arKythi = kythi::find($arKetqua['id_kythi']);
        $arCheck = explode(',',$arKythi['cauhoi']);
        $arItems = cauhoi::whereIn('id',$arCheck)->get();

        return view('admin.ketqua.luyentapxem',[ 
            'arKetqua' => $arKetqua,
            'arItems' => $arItems,
        ]);
    }

    public function del($id, Request $request){
        $arItems = ketqua::find($id);
        $arItems->delete();
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->back();
    }

    
}
