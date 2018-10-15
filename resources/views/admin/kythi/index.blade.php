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
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <a href="{{ route('admin.kythi.add') }}" class="btn btn-primary">Thêm</a>
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
                  <th>Name</th>
                  <th>Thi sát hạch</th>
                  <th width="150px">Thao tác</th>
                </tr>
              </thead>


              <tbody>
                @foreach($arItems as $key => $arItem)
                <?php
                $status     = $arItem['active'];
                $id     = $arItem['id'];
                $urlEdit = route('admin.kythi.edit', $arItem['id']);
                $urlDel  = route('admin.kythi.del', $arItem['id']); 
                ?>
                <tr>
                  <td>{{ $arItem['id'] }}</td>
                  <td><a href="{{ route('admin.kythi.danhsach',$arItem['id'] )}}">{{ $arItem['name'] }}</a></td>
                  @if($status == 0)
                  <td>
                    <a href="{{ route('admin.kythi.trangthai', ['id' => $id, 'status' => $status])}}">
                      <center><img src="{{ $url_admin }}/img/publish_x.png"></center>
                    </a>
                  </td>
                  @else
                  <td >
                    <a href="{{ route('admin.kythi.trangthai', ['id' => $id, 'status' => $status])}}"">
                      <center><img src="{{ $url_admin }}/img/tick.png"></center>
                    </a>
                  </td> 
                  @endif
                  <td>
                    <a class="btn btn-success btn-xs" href="{{ route('admin.kythi.danhsach',$arItem['id'] ) }}">
                      <i class="fa fa-eye" aria-hidden="true"></i> Xem
                    </a>
                    <a class="btn btn-success btn-xs" href="{{ $urlEdit }}">
                      <i class="fa fa-pencil"></i> Sửa
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