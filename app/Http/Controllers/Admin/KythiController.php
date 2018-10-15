<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\kythi;
use App\cauhoi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class KythiController extends Controller
{
    public function index(){
        $arItems = DB::table('kythi')->get();
        
        return view('admin.kythi.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd(){
        return view('admin.kythi.add');
    }

    public function postadd(Request $request){
        $arItems = DB::table('linhvuc')->get();
        $p = $request->all();

        return view('admin.kythi.chon',[
            'p' => $p,
            'arItems' => $arItems
        ]);
    }

    public function postchon(Request $request){
        $arKythi = new kythi;

        $string = implode(",", Input::get('table_records'));
        $arKythi->cauhoi =  $string;
        $arKythi->name = $request->name;
        $arKythi->active = 0;

        $Count = count(Input::get('table_records'));
        if($Count != 25){
            echo "<script type='text/javascript'>
            	alert('Số câu hỏi bắt buộc phải 25');
            	window.location = '";
                    echo route('admin.kythi.index');
            echo "'
            </script>";
        }else{
            $arKythi->save();
            $request->session()->flash('msg','Tạo đề thi thành công');
            return redirect()->route('admin.kythi.index');
        }
    }

    public function danhsach(Request $request, $id)
    {
        $arDanhsach = kythi::find($id);
        $arCauhoi = explode(',',$arDanhsach['cauhoi']);

        $arItems = cauhoi::whereIn('id',$arCauhoi)->get();

        return view('admin.kythi.danhsach',[
            'arItems' => $arItems,
            'arDanhsach' => $arDanhsach,
        ]);

    }

    public function getEdit($id, Request $request){
        $arItems = kythi::find($id);
        
        return view('admin.kythi.edit',[
            'arItems' => $arItems,
        ]);
        
    }

    public function postedit($id, Request $request){
        $arItems = DB::table('linhvuc')->get();
        $p = $request->all();
        $arKythi = kythi::find($id);
        $arCheck = explode(',',$arKythi['cauhoi']);

        return view('admin.kythi.sua',[
            'p' => $p,
            'arItems' => $arItems,
            'arCheck' => $arCheck,
            'arKythi' => $arKythi,
        ]);
    }

    public function postsua($id, Request $request){
        $arKythi = kythi::find($id);

        $string = implode(",", Input::get('table_records'));
        $arKythi->cauhoi =  $string;
        $arKythi->name = $request->name;

        $Count = count(Input::get('table_records'));
        if($Count != 25){
            echo "<script type='text/javascript'>
            	alert('Số câu hỏi bắt buộc phải 25');
            	window.location = '";
                    echo route('admin.kythi.index');
            echo "'
            </script>";
        }else{
            $arKythi->update();
            $request->session()->flash('msg','Sửa đề thi thành công');
            return redirect()->route('admin.kythi.index');
        }
    }

    public function del($id, Request $request){
        $arItems = kythi::find($id);
        $arItems->delete();
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.kythi.index');
    }

    public function trangthai($id, $status){
        $arChitiet = kythi::find($id);
        if($status == 0){
            $arChitiet->active = 1; 

        }else{
         $arChitiet->active = 0; 
     }
     $arChitiet->save();

     return redirect()->route('admin.kythi.index');
 }
}
