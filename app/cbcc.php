<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class cbcc extends Model
{
    protected $table = "cbcc";
    protected $primaryKey = "id";
    public $timestamps = false;

    public function getList(){
    	return  DB::table('cbcc as c')->
    	join('users as u','c.id','=','u.id_cbcc')->
    	select('*','c.id as cid','u.id as uid')->get();
    }

}
