<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\DangtinRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use App\kythi;
use App\cauhoi;
use App\ketqua;
use App\cbcc;
use App\User;

class IndexController extends Controller
{

    public function index(){
        $arItems = kythi::get();

        return view("index.index",[
            'arItems' => $arItems,
        ]);
    }

    public function kythi($slug, $id){
        $arKythi = kythi::find($id);

        $arKiemtra = DB::table('kythi as kt')
        ->join('ketqua as kq','kt.id','=','kq.id_kythi')
        ->where('kt.id','=',$id)
        ->where('kt.active','=',1)
        ->where('kq.active','=',1)
        ->where('kq.id_user',Auth::user()->id)
        ->count();
        if($arKiemtra > 0){
            echo "<script type='text/javascript'>
            alert('Bạn đã làm bài thi');
            window.location = '";
            echo route('public.index');
            echo "'
            </script>";
        }else{
            $arKiemtra = kythi::where('id',$id)->where('active',1)->first();
            $arCheck = explode(',',$arKythi['cauhoi']);
            $arItems = cauhoi::whereIn('id',$arCheck)->get();
            return view("index.kythi",[
                'arItems' => $arItems,
                'arCheck' => $arCheck,
            ]);
        }
        
    }

    public function thi(Request $request){
        if($request->ajax()){
            $arKetQua = new ketqua;

            $arMang = implode("," , $request->myRadio);
            $arKetQua->ketqua = ltrim($arMang, ",");
            $arActive = kythi::where('id',$request->idkt)->first();
            if($arActive['active'] == 0){
                $arKetQua->active = 0;
            }else{
                $arKetQua->active = 1;
            }
            $arKetQua->id_kythi = $request->idkt;
            $arKetQua->time = $request->time;
            $arKetQua->id_user = Auth::user()->id;

            $arKetQua->save();
        };
    }

    public function ketqua(){
        $id = Auth::user()->id;
        $id_cbcc = Auth::user()->id_cbcc;
        $arName = cbcc::find($id_cbcc);
        $username = Auth::user()->username;
        $arKetqua = ketqua::where('id_user',$id)->orderBy('id','desc')->first();
        $arCheck = explode(',',$arKetqua['ketqua']);
        $arKythi = kythi::find($arKetqua['id_kythi']);
        $arCH = explode(',',$arKythi['cauhoi']);
        $arCauHoi = DB::table('cauhoi')->whereIn('id',$arCH)->get();
        $diem = 0;
        $caudung = 0;
        $causai = 0;
        $ketqua = array();

        return view("index.ketqua",[
            'arKetqua' => $arKetqua,
            'arName' => $arName,
            'arCheck' => $arCheck,
            'arCauHoi' => $arCauHoi,
            'diem' => $diem,
            'caudung' => $caudung,
            'causai' => $causai,
            'ketqua' => $ketqua,
        ]);

    }

    public function ctkq(){
        $id = Auth::user()->id;
        $id_cbcc = Auth::user()->id_cbcc;
        $arName = cbcc::find($id_cbcc);
        $username = Auth::user()->username;
        $arKetqua = ketqua::where('id_user',$id)->orderBy('id','desc')->first();

        $arKythi = kythi::find($arKetqua['id_kythi']);
        $arCheck = explode(',',$arKythi['cauhoi']);
        $arItems = cauhoi::whereIn('id',$arCheck)->get();

        return view('index.chitiet',[ 
            'arKetqua' => $arKetqua,
            'arItems' => $arItems,
        ]);
    }

    public function nguoidung(){
        $id = Auth::user()->id;
        $arUsers = User::find($id);

        return view('index.nguoidung',[
            'arUsers' => $arUsers,
        ]);
    }

    public function postnguoidung(Request $request){
        $id = Auth::user()->id;
        $arUsers = User::find($id);

        if(trim($request->password) != ''){
           $arUsers->password = bcrypt(trim($request->password)) ;
        }
        $arUsers->phone = $request->phone;
        $arUsers->diachi = $request->diachi;
        $arUsers->mota = $request->mota;

        $arUsers->update();

        $request->session()->flash('msg','Sửa thành công');
        return redirect()->back();
    }

}
