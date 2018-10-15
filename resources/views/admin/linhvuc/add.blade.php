@extends('templates.admin.template')

@section('main')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Lĩnh vực</h3>
      </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Thêm</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form class="form-horizontal form-label-left" novalidate action="{{ route('admin.linhvuc.add') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="item form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12">Lĩnh vực</label>
                      <div class="col-md-10 col-sm-10 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" name="name" placeholder="Vui lòng nhập thông tin" required="required" type="text">
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="x_panel" style="padding: 5px 5px 0px 5px;background: #E6E9ED;">
                  <div class="x_content">
                    <button type="reset" class="btn btn-dark" style="float: left;">Reset</button>
                    <button id="send" type="submit" class="btn btn-dark" style="float: right;">Thêm</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@endsection