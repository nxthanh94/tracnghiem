<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cbcc;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

class TaikhoanController extends Controller
{
    public function index(){
        $arItem = User::get();
        $arDanhmuc = array();
        foreach ($arItem as $key => $value) {
            $arDanhmuc[] = $value['id_cbcc'];
        }
        $arItems = DB::table('cbcc')->whereNotIn('id',$arDanhmuc)->get();
        
        return view('admin.taikhoan.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd($id){
        $arItems = cbcc::find($id); 
        return view('admin.taikhoan.add',[
            'arItems' => $arItems
        ]);
    }

    public function postadd($id, Request $request){
        $arUsers = new User;

        $picName = $request->picture;

        if($request->picture != ''){
            $image = $request->file('picture');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = storage_path('app/files/avata/' . $filename);
            Image::make($image->getRealPath())->resize(99, 99)->save($path);
            $tmp = explode('/',$filename);
            $picName = end($tmp);
        }

        $arUsers->username = trim($request->username);
        if(trim($request->password) != ''){
           $arUsers->password = bcrypt(trim($request->password)) ;
       }
       $arUsers->diachi = trim($request->diachi);
       $arUsers->phone = trim($request->phone);
       $arUsers->id_phanquyen = 2;
       $arUsers->id_cbcc = $request->linhvuc;
       $arUsers->diachi = $request->diachi;
       $arUsers->mota = $request->mota;
       $arUsers->status = 1;
       $arUsers->active = 0;
       $arUsers->picture = $picName;

       $arUsers->save();

       $request->session()->flash('msg','Tạo thành công');
       return redirect()->route('admin.user.index');
   }

}
