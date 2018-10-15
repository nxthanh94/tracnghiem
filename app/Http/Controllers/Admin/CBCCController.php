<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cbcc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

class CBCCController extends Controller
{
    public function index(){
        $arItems = DB::table('cbcc')->get();
        
        return view('admin.cbcc.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd(){
        return view('admin.cbcc.add');
    }

    public function postadd(Request $request){
        $picName = $request->picture;

        if($request->picture != ''){
            $image = $request->file('picture');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/files/avata/' . $filename);
            Image::make($image->getRealPath())->resize(99, 99)->save($path);
            $tmp = explode('/',$filename);
            $picName = end($tmp);
        }

        $name = $request->name;
        $donvi = $request->donvi;
        $madonvi = $request->madonvi;
        $arItems = array(
            'name'     => $name,
            'donvi'     => $donvi,
            'madonvi'     => $madonvi,
            'picture' => $picName,
        );

        
        cbcc::insert($arItems);

        $request->session()->flash('msg','Thêm thành công');
        return redirect()->route('admin.cbcc.index');
    }

    public function getEdit($id, Request $request){
        $arItems = cbcc::find($id);
        
        return view('admin.cbcc.edit',[
            'arItems' => $arItems,
        ]);
        
    }

    public function postedit($id, Request $request){
        $arItems = cbcc::find($id);

        $picNameOld = $arItems['picture'];
        $picNameNew = $request->picture;
        if($picNameNew != ''){
            $image = $request->file('picture');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/files/avata/' . $filename);
            Image::make($image->getRealPath())->resize(99, 99)->save($path);
            $tmp = explode('/',$filename);
            $picName = end($tmp);

            if($picNameOld != ''){
                Storage::delete("files/avata/{$picNameOld}");
            }
        }else{
            $picName = $picNameOld;
        }

        $arItems->name     = $request->name; 
        $arItems->donvi     = $request->donvi; 
        $arItems->madonvi     = $request->madonvi;
        $arItems->picture = $picName; 

        $arItems->update();

        $request->session()->flash('msg','Cập nhật thành công');
        return redirect()->route('admin.cbcc.index');
    }

    public function del($id, Request $request){
        $arItems = cbcc::find($id);
        $arItems->delete();
        $request->session()->flash('msg','Xóa thành công');
        return redirect()->route('admin.cbcc.index');
    }
}
