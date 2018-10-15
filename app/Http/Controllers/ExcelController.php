<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phong;
use App\cauhoi;
use App\cbcc;
use Excel;
use DB;
use Illuminate\Support\Facades\Input;


class ExcelController extends Controller
{
    public function Export($id)
    {
        $arItems = phong::find($id);
        Excel::create('Bất Động Sản',function($excel) use ($arItems){
            $excel->sheet('clients',function($sheet) use ($arItems){
                $sheet->loadView('Export',['arItems' => $arItems]);
            });
        })->export('xlsx');
    }

    public function ExportAll()
    {
        $arItems = phong::all();
        Excel::create('Bất Động Sản',function($excel) use ($arItems){
            $excel->sheet('clients',function($sheet) use ($arItems){
                $sheet->loadView('ExportAll',['arItems' => $arItems]);
            });
        })->export('xlsx');
    }

    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $danhmuc) {
                    foreach ($danhmuc as $key => $value) {
                        $insert[] = [
                            'name' => $value->name, 
                            'a' => $value->a, 
                            'b' => $value->b, 
                            'c' => $value->c,
                            'd' => $value->d,
                            'dapan' => $value->dapan,
                            'id_linhvuc' => $value->id_linhvuc,
                            'id_cauhoi' => $value->id_cauhoi,
                        ];
                    }
                }
                if(!empty($insert)){
                    DB::table('cauhoi')->insert($insert);
                    return redirect()->route('admin.cauhoi.index');
                }
            }
        }
        return back();
    }

    public function downloadExcel($type)
    {
        $data = cauhoi::get()->toArray();
        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function import_cbcc()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $danhmuc) {
                    foreach ($danhmuc as $key => $value) {
                        $insert[] = [
                            'name' => $value->name, 
                            'donvi' => $value->donvi, 
                            'madonvi' => $value->madonvi, 
                        ];
                    }
                }
                if(!empty($insert)){
                    DB::table('cbcc')->insert($insert);
                    return redirect()->route('admin.cbcc.index');
                }
            }
        }
        return back();
    }
}
