<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ $url_public }}/admin/css/reset.css" type="text/css" rel="stylesheet" />
    <link href="{{ $url_public }}/admin/css/style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header col-md-12">
            <div class="col-md-12 text-center">
                <p>HỆ THỐNG HỔ TRỢ KIẾN THỨC CHO CÁN BỘ CÔNG CHỨC!</p>
            </div>
        </div>
        <div class="main">
            <div class="main_header">
                <img src="{{ $url_public }}/admin/images/logo.jpg" width="100px">
            </div>
            <div class="main_body">
                <p>hệ thống quản trị website<span class="glyphicon glyphicon-chevron-right"></span></p> 
                 @if(Session::get('msg') != "")
                    <p style="color: red">{{ Session::get('msg') }}</p>
                @endif
                  <div class="panel-body">
                        <form role="form" action="{{ route('public.auth.login') }}" method="POST">
                        {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="username" name="username" type="text" required >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password" required value="">
                                </div>
                                <button type="submit" class="btn btn-default">Đăng nhập</button>
                            </fieldset>


                        </form>
                    </div>
            </div>

        </div>
    </div>
</body>
</html>