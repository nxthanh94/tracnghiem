@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Chi tiết</h3>
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
            <?php
            $arCheck = explode(',',$arKetqua['ketqua']);

            $arKythi = DB::table('kythi')->find(2);
            $arCH = explode(',',$arKythi['cauhoi']);
            $arCauHoi = DB::table('cauhoi')->whereIn('id',$arCH)->get();
            $diem = 0;
            $ketqua = array();
            ?>
            @foreach($arCheck as $key1 => $value)
            <?php
            $arDapan = explode(':', $value);
            $check = DB::table('cauhoi')->where('id',$arDapan[0])->where('dapan',$arDapan[1])->get();
            $kq_item =array('cauhoi' =>$arDapan[0],'dapan' =>$arDapan[1], 'diem'=>0);
            if(count($check)>=1){
              $kq_item['diem'] = 1;
            }
            $ketqua[] =$kq_item; 
            ?>

            @foreach($arItems as $key => $arItem)
            @if($key1 == $key)
            <div class="num{{$key + 1}}">
              <div class="cauhoi">
                <h4>Câu số {{ $key + 1}}: </h4>
                <div class="noidung">
                  {{ $arItem['name'] }}
                </div>
              </div>
              <div class="dapan" style="padding-left: 20px">
                <div class="DaRatio">
                  <input type="radio" name="check{{$key + 1}}" value="a" data="{{$key + 1}}"
                  @if($arDapan[1] == 'a') checked="" @endif>
                  <span >a. {{ $arItem['a'] }} @if($arItem['dapan'] == 'a' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>

                </div>
                <div class="DaRatio">
                  <input type="radio" name="check{{$key + 1}}" value="b" data="{{$key + 1}}"
                  @if($arDapan[1] == 'b') checked="" @endif>
                  <span>b. {{ $arItem['b'] }} @if($arItem['dapan'] == 'b' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif </span>
                </div>
                <div class="DaRatio">
                  <input type="radio" name="check{{$key + 1}}" value="c" data="{{$key + 1}}"
                  @if($arDapan[1] == 'c') checked="" @endif>
                  <span>c. {{ $arItem['c'] }} @if($arItem['dapan'] == 'c' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>
                </div>
                <div class="DaRatio">
                  <input type="radio" name="check{{$key + 1}}" value="d" data="{{$key + 1}}"
                  @if($arDapan[1] == 'd') checked="" @endif>
                  <span>d. {{ $arItem['d'] }} @if($arItem['dapan'] == 'd' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /page content -->
@endsection