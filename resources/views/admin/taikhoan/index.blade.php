@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main" id="right_col">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Danh sách chưa có tài khoản</h3>
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
                  <th>Họ và tên</th>
                  <th>Mã đơn vị</th>
                  <th>Tên đơn vị</th>
                  <th width="100px">Hình ảnh</th>
                  <th width="100px">Thao tác</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $hinhanh     = $arItem['picture'];
                $picUrl         = asset("storage/app/files/avata/{$hinhanh}");
                ?>
                <tr>
                  <td>{{ $arItem['id'] }}</td>
                  <td>{{ $arItem['name'] }}</td>
                  <td>{{ $arItem['madonvi'] }}</td>
                  <td>{{ $arItem['donvi'] }}</td>
                  <td>
                    @if($hinhanh != '')
                    <img src="{{ $picUrl }}" alt="" class="img-circle img-responsive">
                    @else 
                    - Chưa up hình -
                    @endif
                  </td>
                  <td>
                    <a class="btn btn-success btn-xs" href="{{ route('admin.taikhoan.add',$arItem['id']) }}">
                      <i class="fa fa-pencil"></i> Tạo tài khoản
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