<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\cbcc;
use App\phanquyen;
use Illuminate\Support\Facades\DB;
use Image;

class UsersController extends Controller
{
    public function index(){
        $arItems = DB::table('users')->get();
        
        return view('admin.user.index',[
            'arItems' => $arItems
        ]);
    }

    public function getadd(){
        $arItems = User::get();
        $arDanhmuc = array();

        foreach ($arItems as $key => $value) {
            $arDanhmuc[] = $value['id_cbcc'];
        }

        return view('admin.user.add',[
            'arItems' => $arItems,
            'arDanhmuc' => $arDanhmuc,
        ]);
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

        $username = $request->username;
        $password = bcrypt(trim($request->password));
        $phone = $request->phone;
        $diachi = $request->diachi;
        $mota = $request->mota;
        $phone = $request->phone;
        $phanquyen = 2;
        $status = 1;
        $active = 0;
        $id_cbcc = $request->linhvuc;
        $arUsers = array(
            'username' => $username,
            'password' => $password,
            'phone' => $phone,
            'id_phanquyen'     => $phanquyen,
            'id_cbcc'     => $id_cbcc,
            'picture' => $picName,
            'diachi' => $diachi,
            'mota' => $mota,
            'active' => $active,
            'status' => $status,
        );

        
        User::insert($arUsers);

        $request->session()->flash('msg','Thêm thành công');
        return redirect()->route('admin.user.index');
    }

    public function getEdit($id, Request $request){
        $arUsers = User::find($id);
        if((Auth::user()->id != 1) && ($id == 1 || $arUsers['id_phanquyen'] == 2 && (Auth::user()->id != $id))){
            $request->session()->flash('msg','Bạn không được sửa thành viên này');
            return redirect()->back();
        }else{
            return view('admin.user.edit',[
                'arUsers' => $arUsers,
            ]);
        }
        
    }

    public function postedit($id, Request $request){
        $arUsers = User::find($id);

        $picNameOld = $arUsers['picture'];
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
        $arUsers->username = trim($request->username);
        if(trim($request->password) != ''){
            $arUsers->password = bcrypt(trim($request->password)) ;
        }
        $arUsers->phone = trim($request->phone);
        $arUsers->diachi = $request->diachi;
        $arUsers->mota = $request->mota;
        $arUsers->picture = $picName;

        $arUsers->update();

        $request->session()->flash('msg','Cập nhật thành công');
        return redirect()->route('admin.user.index');
    }

    public function capnhat($id, Request $request){

        $this->validate($request, [
            'password_old' => 'required',
            'password' => 'required|min:5|max:100',
            'password2' => 'required|same:password',
        ],
        [
            'password_old.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
            'password.min' => 'Chiều dài danh mục từ 5-100 ký tự',
            'password.max' => 'Chiều dài danh mục từ 5-100 ký tự',
            'password2.required' => 'Không được để trống',
            'password2.same' => 'Mật khẩu không trùng khớp',
        ]);

        $arUsers = User::find($id);


        if(trim($request->password) != ''){
            $arUsers->password = bcrypt(trim($request->password)) ;
        }
        $password_old = $request->password_old ;
        $username = $request->username ;
        $arUsers->active = 1;

        if (Auth::attempt(['username' => $username ,'password' => $password_old])) {
            $arUsers->update();
        }
        else{
            $request->session()->flash('msg','Mật khẩu cũ không đúng');
        }
        return redirect()->back();
    }

    
    public function del($id, Request $request){
        $arUsers = User::find($id);
        if($arUsers['username'] != 'admin'){
            $picName = $arUsers['picture'];
            if($picName != ''){
                Storage::delete("files/avata/{$picName}");
            }
            $arUsers->delete();
            $request->session()->flash('msg','Xóa thành công');
            return redirect()->route('admin.user.index');
        }else{
            $request->session()->flash('msg','Không thể xóa tài khoản này');
            return redirect()->route('admin.user.index');
        }

    }

    public function trangthai(Request $request, $id, $status){
        if($request->ajax()){
            $id = $request->id;
            $status = $request->status;
            $arChitiet = User::find($id);
            if($status == 0){
                $arChitiet->status = 1; 
            }else{
                $arChitiet->status = 0; 
            }
            $arChitiet->save();
            return $status;
        }
    }


}
