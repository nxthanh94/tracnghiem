<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\linhvuc;
use Illuminate\Support\Facades\DB;

class LinhvucController extends Controller
{
    public function index(){
        $arItems = DB::table('linhvuc')->get();
        
        return view('admin.linhvuc.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd(){
        return view('admin.linhvuc.add');
    }

    public function postadd(Request $request){

        $name = $request->name;
        $arItems = array(
            'name'     => $name,
        );

        
        linhvuc::insert($arItems);

        $request->session()->flash('msg','Thêm thành công');
        return redirect()->route('admin.linhvuc.index');
    }

    public function getEdit($id, Request $request){
        $arItems = linhvuc::find($id);
        
        return view('admin.linhvuc.edit',[
            'arItems' => $arItems,
        ]);
        
    }

    public function postedit($id, Request $request){
        $arItems = linhvuc::find($id);

        $arItems->name     = $request->name; 
        $arItems->update();

        $request->session()->flash('msg','Cập nhật thành công');
        return redirect()->route('admin.linhvuc.index');
    }

    public function del($id, Request $request){
        $arItems = linhvuc::find($id);
        $arItems->delete();
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.linhvuc.index');
    }
}
