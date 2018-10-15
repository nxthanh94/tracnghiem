<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trang quản trị admin">
    <meta name="author" content="">
    <title>Cục Hải Quan Quảng Nam</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ $url_public }}/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ $url_public }}/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ $url_public }}/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- DataTables CSS -->
    <link href="{{ $url_public }}/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ $url_public }}/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="{{ $url_public }}/bower_components/datatables-responsive/css/custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ $url_public }}/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="{{ $url_public }}/js/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
    <script type="text/javascript">
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds, id;
            var ar_item_check = new  Array();
            var url = window.location.pathname;
            var idkt = url.substring(url.lastIndexOf('-') + 1);
            var token = $("input[name='_token']").val();
            var time = '00:00';
            var x = setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);
                id = 0;

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    id = id + 1;
                    var i;
                    for( i = 1; i <= 25; i++){
                        var myRadio = $("input[name = check"+i+"]:checked").val();
                        var idch = $("input[name=check"+i+"]").parent().parent().find('.idch').text();
                        if(myRadio == null){
                            myRadio = 'x';
                        }
                        ar_item_check[i] = idch+':'+myRadio;
                    }
                    $.ajax({ 
                        url : '/thi',
                        type: 'post', 
                        cache: false,
                        data:{
                            myRadio:ar_item_check,
                            idkt:idkt,
                            time:time,
                            _token:token,
                        },
                        success: function(data) {
                            alert("Bạn đã hết thời gian làm bài");
                            $(".loadGH").css({"display":"none"});
                            $(".loadKQ").css({"display":"block"});
                        }
                    });
                    
                    clearInterval(x);
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = 60 * 50,
            display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var ar_item_check = new  Array();

            $('.dapan input').on('change', function() {
                var id = $(this).attr('data');
                var idch = $(this).parent().parent().find('.idch').text();
                var time = $(this).parent().parent().parent().parent().parent().find('#time').text();
                var myRadio = $("input[name = check"+id+"]:checked").val();
                if(myRadio == null){
                    myRadio = 'x';
                }
                var token = $("input[name='_token']").val();
                var url = window.location.pathname;
                var idkt = url.substring(url.lastIndexOf('-') + 1);
                ar_item_check[id] = idch+':'+myRadio;
                var next = parseInt(id) + 1;
                $(".num"+id).css({"display":"none"});
                $(".num"+next).css({"display":"block"});
                $("."+id).addClass("done");
                $("."+next).addClass("active");
                $("."+id).removeClass("active");
                if(id == 25)
                {
                    var ar_item = new  Array();
                    var i = 0;
                    $('#khungdapan>ul>li>a').each(function(d){
                        var c = 1;
                        var hClass = $(this).hasClass('done');
                        if(hClass == false){
                            c += d ;
                            ar_item[i] = c;
                            i = i+1;
                        }
                    }); 
                    if(ar_item != ''){
                        alert("Bạn còn các câu: "+ar_item+" chưa hoàn thành.");
                    }
                    $.ajax({ 
                       url : '/thi',
                       type: 'post', 
                       cache: false,
                       data:{
                           myRadio:ar_item_check,
                           idkt:idkt,
                           time:time,
                           _token:token,
                       },
                       success: function(data) {
                    //         $(".loadGH").css({"display":"none"});
                    $(".loadKQ").css({"display":"block"});
                }
            });


                }
            });
            $('#khungdapan a').on('click', function() {
                var id = $(this).attr('class');
                var data = $(this).attr('data');

                if($('#khungdapan .done').on('click', function() {
                    var idd = $(this).attr('data');
                    $(".content").css({"display":"none"});
                    $(".num"+idd).css({"display":"block"});
                }));
                    if($('#khungdapan .active').on('click', function() {
                        var idd = $(this).attr('data');
                        $(".num"+idd).css({"display":"block"});
                        $("."+idd).addClass("active");
                    }));
                        $("#khungdapan a").removeClass("active");
                        $("."+id).addClass("active");
                        $(".content").css({"display":"none"});
                        $(".num"+id).css({"display":"block"});
                    });
        });
    </script>
    <script type="text/javascript">
        var baseURL = "{!! url('/') !!}";
    </script>
    <script type="text/javascript" src="{{ $url_public }}/js/func_ckfinder.js"></script>
</head>

<body>
    <?php
    $arActive = Auth::user()->active;
    $username = Auth::user()->username;
    ?>
    @if($arActive == 0)
    <div id="id01" class="modal">
        <form class="modal-content animate" action="{{ route('admin.user.capnhat',['id' => Auth::user()->id ]) }}" method="post">
            {{ csrf_field() }}
            <div class="imgcontainer">
                <h2>Thay đổi mật khẩu</h2>
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <label for="password_old"><b>Mật khẩu củ(*)</b></label>
            <input type="password" placeholder="" name="password_old" >
            <input type="hidden" value="{{ $username }}" name="username" >
            @if ($errors->Has ('password_old'))
            <p style="color:red;display: block;margin-top: 0px;"> {!!  $errors->First ('password_old') !!} </p>
            @endif
            @if( Session::get('msg') != '')
            <p style="color:red;display: block;margin-top: 0px;">{{ Session::get('msg') }}</p>
            @endif

            <label for="psw"><b>Mật khẩu mới(*)</b></label>
            <input type="password" placeholder="" name="password" >
            @if ($errors->Has ('password'))
            <p style="color:red;display: block;margin-top: 0px;"> {!!  $errors->First ('password') !!} </p>
            @endif

            <label for="psw"><b>Nhập lại mật khẩu mới(*)</b></label>
            <input type="password" placeholder="" name="password2" >
            @if ($errors->Has ('password2'))
            <p style="color:red;display: block;margin-top: 0px;"> {!!  $errors->First ('password2') !!} </p>
            @endif

            <button type="submit">Cập nhật</button>
            <button onclick="document.getElementById('id01').style.display='none'" style="float: right;">Trở về</button>
        </form>
    </div>
    @endif
    <script type="text/javascript">
        $(document).ready(function(e) { 
            $('#id01').fadeIn(300);
        });
    </script>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="/admin" style="background: #366CA2"><img src="{{ $url_public }}/admin/images/logo.jpg" width="" height="50px" style="margin-left: 70px;margin-top:-15px; "></a> -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user" >
                        <?php
                        $chao = "";
                        ?>
                        @if(Auth::check())
                        <?php 
                        $chao = Auth::user()->username;
                        ?>
                        <li>
                            <a href="{{ route('public.index.nguoidung') }}"><i class="fa fa-user fa-fw"></i> {{ $chao }}</a>
                        </li>
                        @else
                        @endif
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('public.auth.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li><a href="{{ route('public.index') }}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ </a>
                        </li>
                        <?php 
                        $username = Auth::user()->username;
                        ?>
                        @if($username == 'admin')
                        <li><a href="{{ route('admin.index.index') }}"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Vào trang Admin </a>
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-gamepad" aria-hidden="true"></i> Luyện tập<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
                                $arKyThi = DB::table('kythi')->where('active','!=',1)->get(); 
                                ?>
                                <form method="GET" action="" id="apform">
                                    <select class="form-control" id="list_change">
                                        <option value="" selected>Chọn lĩnh vực</option>
                                        @foreach($arKyThi as $key => $KyThi)
                                        <?php
                                        $nameSeo = str_slug($KyThi['name']); 
                                        ?>
                                        <option value="{{ route('public.index.kythi',['slug' => $nameSeo, 'id' => $KyThi['id'] ]) }}">{{ $KyThi['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Đồng ý" class="btn btn-primary">
                                </form>
                            </ul>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('#list_change').change(function(){
                                        var $option = $(this).find('option:selected');
                                        var value = $option.val();
                                        $('#apform').attr('action', value);
                                    });
                                });
                            </script>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php
                        $arCount = DB::table('kythi')->where('active','=',1)->count(); 
                        ?>
                        @if($arCount == 0)
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('.thikd').click(function(event) {
                                    alert("Chưa có kỳ thi khả dụng");
                                });
                            });
                        </script>
                        @endif
                        <li class="thikd">
                            <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Thi sát hạch<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php
                                $arKyThi = DB::table('kythi')->where('active','=',1)->get(); 
                                ?>
                                <form method="GET" action="" id="apformthi">
                                    <select class="form-control" id="list_change_thi">
                                        <option value="" selected>Chọn lĩnh vực</option>
                                        @foreach($arKyThi as $key => $KyThi)
                                        <?php
                                        $nameSeo = str_slug($KyThi['name']); 
                                        $arketqua = DB::table('ketqua')->where('id_user',Auth::user()->id)->where('active','=',1)->where('id_kythi',$KyThi['id'])->count(); 
                                        ?>
                                        
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                $('#list_change_thi').change(function(){
                                                    var $option = $(this).find('option:selected');
                                                    var value = $option.val();
                                                    $('#apformthi').attr('action', value);
                                                });
                                            })
                                        </script>
                                        @if($arketqua > 0)
                                        <option value="dathi">{{ $KyThi['name'] }}</option>
                                        @else
                                        <option value="{{ route('public.index.kythi',['slug' => $nameSeo, 'id' => $KyThi['id'] ]) }}">{{ $KyThi['name'] }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Đồng ý" class="btn btn-primary dathi">
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#apformthi').on("submit", function(event) {
                                            $form = $(this);
                                            var value = $form.attr('action');
                                            if(value == 'dathi'){
                                                event.preventDefault();
                                                alert('Bạn đã làm bài thi');
                                            };
                                        });
                                    });
                                </script>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

