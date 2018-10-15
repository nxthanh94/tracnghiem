<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DataTables | Cục Hải Quan</title>

  <!-- Bootstrap -->
  <link href="{{ $url_admin }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ $url_admin }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ $url_admin }}/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="{{ $url_admin }}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="{{ $url_admin }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{ $url_admin }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="{{ $url_admin }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="{{ $url_admin }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="{{ $url_admin }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ $url_admin }}/build/css/custom.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="{{ $url_admin }}/js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="{{ $url_admin }}/js/ckfinder/ckfinder.js"></script>
  <script type="text/javascript">
    var baseURL = "{!! url('/') !!}";
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.flat').change(function() {
        var id = $(this).attr('data');
        var status = $(this).parent().find("input[type='checkbox']").val();
        $.ajax({
          url: '/admin/nguoi-dung/trang-thai/'+id+'/'+status,
          type: 'GET',
          cache: false,
          data:{
            id:id,
            status:status,
          },
          success: function(data){
            if(status == 0){
              $("input[type='checkbox']").val('1');
            }else{
              $("input[type='checkbox']").val('0');
            }
          }
        });
      });
    });
  </script>
  <style type="text/css">
  .item_header{
    margin-top: 20px;
    font-family: Time New Roman;
    float: left;
    width: 100%;
  }
  .item_header .logo{
    width: 120px;
    float: left;
  }
  .item_header .logo img{
    max-width: 100%;
  }
  .item_header .item_title{
    width: calc(100% - 120px);
    float: right;
    text-align: center;
  }
  .item_header .item_title h3{
    font-size: 20px;
    margin-top: 30px;
    margin-left: -170px;
  }
  .item_header .item_title h3 span{
    font-weight: bold;
    display: block;
    margin-top: 5px;
    position: relative;
  }
  .item_header .item_title h3 span:after{
    content: '';
    position: absolute;
    width: 200px;
    height: 2px;
    background: #000; 
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    margin-bottom: -10px;
  }
  .item_content{
    text-align: center;
    font-size: 34px;
    font-weight: bold;
    float: left;
    width: 100%;
    margin-top: 12vh;
    height: 37vh;
    font-family: Time New Roman;
  }
  .item_footer{
    float: left;
    text-align: center;
    font-family: Time New Roman;
    background: url(/../resources/assets/templates/public/admin/images/bg-footer.png);
    height: 147px;
    background-size: 100%;
    margin: 0 -20px;
    width: calc(100% + 40px);
    padding-top: 60px;
    color: #000;
  }
  .item_footer h3{
    font-size: 20px;
    font-weight: bold;
  }
  .item_footer h4{
    font-size: 20px;
    font-weight: bold;
  }
</style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col" id="left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"> <span>Cục Hải Quan</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          @if(Auth::check())
          <?php 
          $chao = Auth::user()->username;
          $hinhanh = Auth::user()->picture;
          $picUrl = asset("storage/app/files/avata/{$hinhanh}");
          ?>
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="{{ $picUrl }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>{{ $chao }}</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          @endif

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ </a>
                </li>
                <li><a href="/"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Giao diện thi </a>
                </li>
                <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin.user.index') }}">Danh sách User</a></li>
                    <li><a href="{{ route('admin.taikhoan.index') }}">Chưa có tài khoản</a></li>
                  </ul>
                </li>
                <li><a href="{{ route('admin.linhvuc.index') }}"><i class="fa fa-arrows" aria-hidden="true"></i> Lĩnh vực </a>
                </li>
                <li><a href="{{ route('admin.cbcc.index') }}"><i class="fa fa-book" aria-hidden="true"></i> Cán bộ công chức </a>
                </li>
                <li><a href="{{ route('admin.cauhoi.index') }}"><i class="fa fa-file" aria-hidden="true"></i> Câu hỏi </a>
                </li>
                <li><a><i class="fa fa-file-text" aria-hidden="true"></i> Bố cục đề thi <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin.kythi.index') }}">Kỳ thi</a></li>
                    <li><a href="{{ route('admin.ketqua.sathach') }}">Kết quả sát hạch</a></li>
                    <li><a href="{{ route('admin.ketqua.luyentap') }}">Kết quả luyện tập</a></li>
                  </ul>
                </li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php 
                  $chao = Auth::user()->username;
                  $id = Auth::user()->id;
                  $hinhanh = Auth::user()->picture;
                  $picUrl = asset("storage/app/files/avata/{$hinhanh}");
                  ?>
                  <img src="{{ $picUrl }}" alt="">{{ $chao }}
                  
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="{{ route('admin.user.edit',$id) }}"> Profile</a></li>
                  <li><a href="{{ route('public.auth.logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
              @endif

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

