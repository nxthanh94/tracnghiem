<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request){
    	$username = trim($request->username);
    	$password = trim($request->password);

        if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 1])) {
            if(Auth::user()->id_phanquyen == 1 ){
                return redirect()->route('admin.index.index');
            }
            else{
                return redirect()->route('public.index');
            }
        }elseif(Auth::attempt(['username' => $username, 'password' => $password, 'status' => 0])){
            $request->session()->flash('msg','Tài khoản bạn đã bị khóa');
            return redirect()->back();
        }else{
            $request->session()->flash('msg','Sai username/email hoặc mật khẩu');
            return redirect()->back();
        }
    }
    public function logout(){
      Auth::logout();
      return redirect()->route('public.index');
  }
}
