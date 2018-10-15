<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::pattern('id','([0-9]*)');
Route::pattern('id1','([0-9]*)');
Route::pattern('slug','(.*)');
Route::pattern('slug1','(.*)');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', function () {
		return view('index.index');
	});

	Route::get('/redirect/{social}', 'SocialAuthController@redirect');
	Route::get('/callback/{social}', 'SocialAuthController@callback');

	Route::get('',[
		'as' => 'public.index', 
		'uses' => 'IndexController@index'
	]);

	Route::post('cap-nhat/{id}',[
		'uses' => 'Admin\UsersController@capnhat',
		'as'  => 'admin.user.capnhat'
	]);

	Route::get('ky-thi/{slug}-{id}',[
		'uses' => 'IndexController@kythi',
		'as' => 'public.index.kythi'
	]);

	Route::post('thi',[
		'uses' => 'IndexController@thi',
		'as' => 'public.index.thi'
	]);

	Route::get('ket-qua.html',[
		'uses' => 'IndexController@ketqua',
		'as' => 'public.index.ketqua'
	]);

	Route::get('chi-tiet-ket-qua.html',[
		'uses' => 'IndexController@ctkq',
		'as' => 'public.index.ctkq'
	]);

	Route::get('excel/{id}',[
		'as' => 'public.excel', 
		'uses' => 'ExcelController@Export'
	]);

	Route::get('excel',[
		'as' => 'public.excel.all', 
		'uses' => 'ExcelController@ExportAll'
	]);

	Route::post('importExcel', 'ExcelController@importExcel');
	Route::post('import-cbcc', 'ExcelController@import_cbcc');
	Route::get('downloadExcel/{type}', 'ExcelController@downloadExcel');

	Route::get('dang-tin',[
		'uses' => 'IndexController@dangtin',
		'as' => 'public.index.dangtin'
	]);

	Route::get('dang-tin/{id}',[
		'uses' => 'IndexController@dangtinchitiet',
		'as' => 'public.index.dangtinchitiet'
	]);

	Route::post('dang-tin/{id}/xac-nhan',[
		'uses' => 'IndexController@xacnhan',
		'as' => 'public.index.xacnhan'
	]);

	Route::post('dang-tin-thanh-cong',[
		'uses' => 'IndexController@thanhcong',
		'as' => 'public.index.thanhcong'
	]);

	Route::get('dang-nhap',[
		'uses' => 'IndexController@dangnhap',
		'as' => 'public.index.dangnhap'
	]);

	Route::get('nguoi-dung',[
		'uses' => 'IndexController@nguoidung',
		'as' => 'public.index.nguoidung'
	]);

	Route::post('nguoi-dung',[
		'uses' => 'IndexController@postnguoidung',
		'as' => 'public.index.nguoidung'
	]);
});
//////////////////////////////////////////////////////////////////
//Quản lý admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware' => 'auth','middleware' =>'role'], function () {
	Route::get('',[
		'uses' => 'IndexController@index',
		'as'  => 'admin.index.index'
	]);

	//Quản lý users
	Route::group(['prefix' => 'nguoi-dung'], function () {
		Route::get('',[
			'uses' => 'UsersController@index',
			'as'  => 'admin.user.index'
		])->middleware('role1');

		Route::get('add',[
			'uses' => 'UsersController@getadd',
			'as'  => 'admin.user.add'
		])->middleware('role1');

		Route::post('add',[
			'uses' => 'UsersController@postadd',
			'as'  => 'admin.user.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'UsersController@getedit',
			'as'  => 'admin.user.edit'
		])->middleware('role1');

		Route::post('edit/{id}',[
			'uses' => 'UsersController@postedit',
			'as'  => 'admin.user.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'UsersController@del',
			'as' => 'admin.user.del'
		])->middleware('role1');

		Route::get('/trang-thai/{id}/{status}',[
			'uses' => 'UsersController@trangthai',
			'as'  => 'admin.user.trangthai'
		])->middleware('role1');
	});

	//Quản lý cbcc chưa có tk 
	Route::group(['prefix' => 'danh-sach-chua-co-tai-khoan'], function () {
		Route::get('',[
			'uses' => 'TaikhoanController@index',
			'as'  => 'admin.taikhoan.index'
		]);

		Route::get('add/{id}',[
			'uses' => 'TaikhoanController@getadd',
			'as'  => 'admin.taikhoan.add'
		]);

		Route::post('add/{id}',[
			'uses' => 'TaikhoanController@postadd',
			'as'  => 'admin.taikhoan.add'
		]);

	});

	//Quản lý lĩnh vực
	Route::group(['prefix' => 'linh-vuc'], function () {
		Route::get('',[
			'uses' => 'LinhvucController@index',
			'as'  => 'admin.linhvuc.index'
		]);

		Route::get('add',[
			'uses' => 'LinhvucController@getadd',
			'as'  => 'admin.linhvuc.add'
		]);

		Route::post('add',[
			'uses' => 'LinhvucController@postadd',
			'as'  => 'admin.linhvuc.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'LinhvucController@getedit',
			'as'  => 'admin.linhvuc.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'LinhvucController@postedit',
			'as'  => 'admin.linhvuc.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'LinhvucController@del',
			'as' => 'admin.linhvuc.del'
		]);
	});

	//Quản lý ky thi
	Route::group(['prefix' => 'ky-thi'], function () {
		Route::get('',[
			'uses' => 'KythiController@index',
			'as'  => 'admin.kythi.index'
		]);

		Route::post('chon-cau-hoi',[
			'uses' => 'KythiController@postchon',
			'as'  => 'admin.kythi.postchon'
		]);

		Route::get('danh-sach-chon-cau-hoi/{id}',[
			'uses' => 'KythiController@danhsach',
			'as'  => 'admin.kythi.danhsach'
		]);

		Route::get('add',[
			'uses' => 'KythiController@getadd',
			'as'  => 'admin.kythi.add'
		]);

		Route::post('add',[
			'uses' => 'KythiController@postadd',
			'as'  => 'admin.kythi.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'KythiController@getedit',
			'as'  => 'admin.kythi.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'KythiController@postedit',
			'as'  => 'admin.kythi.edit'
		]);

		Route::post('sua-cau-hoi/{id}',[
			'uses' => 'KythiController@postsua',
			'as'  => 'admin.kythi.postsua'
		]);

		Route::get('del/{id}',[
			'uses' => 'KythiController@del',
			'as' => 'admin.kythi.del'
		]);

		Route::get('/trang-thai/{id}/{status}',[
			'uses' => 'KythiController@trangthai',
			'as'  => 'admin.kythi.trangthai'
		]);
	});

	//Quản lý cbcc
	Route::group(['prefix' => 'can-bo-cong-chuc'], function () {
		Route::get('',[
			'uses' => 'CBCCController@index',
			'as'  => 'admin.cbcc.index'
		]);

		Route::get('add',[
			'uses' => 'CBCCController@getadd',
			'as'  => 'admin.cbcc.add'
		]);

		Route::post('add',[
			'uses' => 'CBCCController@postadd',
			'as'  => 'admin.cbcc.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'CBCCController@getedit',
			'as'  => 'admin.cbcc.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'CBCCController@postedit',
			'as'  => 'admin.cbcc.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'CBCCController@del',
			'as' => 'admin.cbcc.del'
		]);
	});

	//Quản lý cauhoi
	Route::group(['prefix' => 'cau-hoi'], function () {
		Route::get('',[
			'uses' => 'CauhoiController@index',
			'as'  => 'admin.cauhoi.index'
		]);

		Route::get('add',[
			'uses' => 'CauhoiController@getadd',
			'as'  => 'admin.cauhoi.add'
		]);

		Route::post('add',[
			'uses' => 'CauhoiController@postadd',
			'as'  => 'admin.cauhoi.add'
		]);

		Route::get('edit/{id}',[
			'uses' => 'CauhoiController@getedit',
			'as'  => 'admin.cauhoi.edit'
		]);

		Route::post('edit/{id}',[
			'uses' => 'CauhoiController@postedit',
			'as'  => 'admin.cauhoi.edit'
		]);

		Route::get('del/{id}',[
			'uses' => 'CauhoiController@del',
			'as' => 'admin.cauhoi.del'
		]);
	});

	//Quản lý kết quả
	Route::group(['prefix' => 'ket-qua'], function () {
		Route::get('sat-hach',[
			'uses' => 'KetquaController@sathach',
			'as'  => 'admin.ketqua.sathach'
		]);

		Route::get('sat-hach/{id}',[
			'uses' => 'KetquaController@sathachxem',
			'as'  => 'admin.ketqua.sathachxem'
		]);

		Route::get('luyen-tap',[
			'uses' => 'KetquaController@luyentap',
			'as'  => 'admin.ketqua.luyentap'
		]);

		Route::get('luyen-tap/{id}',[
			'uses' => 'KetquaController@luyentapxem',
			'as'  => 'admin.ketqua.luyentapxem'
		]);

		Route::get('del/{id}',[
			'uses' => 'KetquaController@del',
			'as' => 'admin.ketqua.del'
		]);

	});
});

//login
Route::group(['namespace' => 'Auth','prefix' => 'auth'], function () {
	Route::get('login',[
		'uses'=> 'AuthController@getLogin',
		'as' => 'public.auth.login'
	]);

	Route::post('login',[
		'uses'=> 'AuthController@postLogin',
		'as' => 'public.auth.login'
	]);

	Route::get('logout',[
		'uses'=> 'AuthController@logout',
		'as' => 'public.auth.logout'
	]);

});

//thong báo
Route::get('noaccess', function(){
	return view('errors.404');
});


//Đăng kí

Route::get('dang-ki',[
	'uses' => 'IndexController@getadd',
	'as'  => 'auth.dangki'
]);

Route::post('dang-ki',[
	'uses' => 'IndexController@postadd',
	'as'  => 'auth.dangki'
]);



