@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Kết quả sát hạch</h3>
      </div>

    </div>

    <div class="clearfix"></div>
    @if( Session::get('msg') != '')
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          {{ Session::get('msg') }}
        </div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Kỳ thi</th>
                  <th>Kết quả</th>
                  <th>Điểm</th>
                  <th width="100px;">Thao tác</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $arCheck = explode(',',$arItem['ketqua']);
                $ketqua = array();
                $diem = 0;
                $caudung = 0;
                $causai = 0;
                $urlEdit = route('admin.ketqua.sathachxem', $arItem['id']);
                $urlDel  = route('admin.ketqua.del', $arItem['id']); 
                ?>
                <tr>
                  <td>{{ $key }}</td>
                  <?php
                  $arUser = DB::table('users')->where('id','=',$arItem['id_user'])->first(); 
                  ?>
                  <td>{{ $arUser['username'] }}</td>
                  <?php
                  $arKythi = DB::table('kythi')->where('id','=',$arItem['id_kythi'])->first(); 
                  ?>
                  <td>{{ $arKythi['name'] }}</td>
                  @foreach($arCheck as $key1 => $value)
                  <?php
                  $arDapan = explode(':', $value);
                  $check = DB::table('cauhoi')->where('id',$arDapan[0])->where('dapan',$arDapan[1])->get();
                  $kq_item =array('cauhoi' =>$arDapan[0],'dapan' =>$arDapan[1], 'diem'=>0);
                  if(count($check)>=1){
                    $kq_item['diem'] = 2;
                  }
                  $ketqua[] = $kq_item; 
                  ?>
                  @endforeach
                  @foreach($ketqua as $key2 => $KQ)
                  <?php 
                  $diem = $diem + $KQ['diem']; 
                  if($KQ['diem'] == 2){
                    $caudung = $caudung + 1;
                  }else{
                    $causai = $causai + 1;
                  }
                  ?>
                  @endforeach
                  <td>{{ $caudung }}/50</td>
                  <td>{{ $diem }}</td>
                  <td>
                    <a class="btn btn-success btn-xs" href="{{ $urlEdit }}">
                      <i class="fa fa-eye"></i> Xem
                    </a>
                    <a  href="{{ $urlDel }}" class="btn btn-primary btn-xs" onclick="return confirm('Bạn chắc muốn xóa không ?');">
                      <i class="fa fa-trash-o"> Xóa</i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /page content -->
@endsection