@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>{{ $arDanhsach['name'] }}</h3>
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
            <a onclick="javaScript:window.history.back();" class="btn btn-primary">Back</a>
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
                  <th>Câu hỏi</th>
                  <th>Mã câu hỏi</th>
                  <th>Lĩnh vực</th>
                  <th>Đáp án</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $urlEdit = route('admin.cauhoi.edit', $arItem['id']);
                $urlDel  = route('admin.cauhoi.del', $arItem['id']); 
                ?>
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $arItem['name'] }}</td>
                  <td>{{ $arItem['id_cauhoi'] }}</td>
                  <?php
                  $arLinhvuc = DB::table('linhvuc')->where('id','=',$arItem['id_linhvuc'])->first(); 
                  ?>
                  <td>{{ $arLinhvuc['name'] }}</td>
                  <td>{{ $arItem['dapan'] }}</td>
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