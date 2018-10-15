@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Kỳ thi</h3>
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
    <form action="{{ route('admin.kythi.postchon') }}" method="post">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <input type="submit" value="Tạo đề thi" class="btn btn-success">
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <style type="text/css">
              .buttonFinish{
                display: none;
              }
            </style>
            <!-- Smart Wizard -->
            <div id="wizard" class="form_wizard wizard_horizontal">
              <ul class="wizard_steps">
                @foreach($arItems as $key => $arItem)
                <li>
                  <a href="#step-{{ $arItem['id'] }}">
                    <span class="step_no">{{ $key + 1 }}</span>
                    <span class="step_descr">
                      Step {{ $key + 1 }}<br />
                      <small>{{ $arItem['name'] }}</small>
                    </span>
                  </a>
                </li>
                @endforeach
              </ul>
                {{ csrf_field() }}
                <input class="form-control" name="name" value="{{ $p['name']}}" required="" type="hidden" />
              @foreach($arItems as $key => $arItem)
              <?php
              $arCauHoi = DB::table('cauhoi')->where('id_linhvuc','=',$arItem['id'])->get(); 
              ?>
              <div id="step-{{ $arItem['id'] }}">
                <div class="table-responsive" style="overflow: auto;height: 500px">
                  <table class="table table-striped jambo_table bulk_action">
                    <thead>
                      <tr class="headings">
                        <th>
                          <input type="checkbox" id="check-all" class="flat">
                        </th>
                        <th class="column-title">Câu hỏi </th>
                        <th class="column-title">Mã câu hỏi </th>
                        <th class="column-title">Lĩnh vực </th>
                        <th class="bulk-actions" colspan="7">
                          <a class="antoo" style="color:#fff; font-weight:500;">Tổng  ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                        </th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      @foreach($arCauHoi as $key => $CauHoi)
                      <tr class="even pointer">
                        <td class="a-center ">
                          <input type="checkbox" class="flat" name="table_records[]" value="{{ $CauHoi['id'] }}">
                        </td>
                        <td class=" ">{{ $CauHoi['name'] }}</td>
                        <td class=" ">{{ $CauHoi['id_cauhoi'] }} </td>
                        <?php
                        $arName = DB::table('linhvuc')->where('id','=',$CauHoi['id_linhvuc'])->first(); 
                        ?>
                        <td class=" ">{{ $arName['name'] }} <i class="success fa fa-long-arrow-up"></i></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div>
              @endforeach
            </div>
            <!-- End SmartWizard Content -->
          </div>
        </div>
      </div>
              </form>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection