@extends('templates.public.template')

@section('main')

<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Sửa
        </h1>
      </div>
      <?php
      $id         = $arUsers['id'];
      $id_cbcc         = $arUsers['id_cbcc'];
      $username   = $arUsers['username'];
      $name   = $arUsers['name'];
      $password   = $arUsers['password'];
      $diachi   = $arUsers['diachi'];
      $dienthoai   = $arUsers['phone'];
      $mota   = $arUsers['mota'];
      ?>

      <div class="col-lg-7" style="padding-bottom:120px">
        <form action="{{ route('public.index.nguoidung')}}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label>Username</label>
            <input type="text" readonly="" class="form-control" name="username" placeholder="Vui lòng nhập Username" value="{{ $username }}" required  />
          </div>
          <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" class="form-control" name="password" placeholder="Vui lòng nhập mật khẩu" value=""  />
          </div>
          <div class="form-group">
            <label>Họ tên</label>
            <?php 
            $arName = DB::table('cbcc')->where('id',$id_cbcc)->first();
            ?>
            <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập họ tên" value="{{ $arName['name'] }}" required />
          </div>
          <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" class="form-control" name="phone" placeholder="Vui lòng nhập số điện thoại" value="{{ $dienthoai }}" required />
          </div>
          <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" class="form-control" name="diachi" placeholder="Vui lòng nhập địa chỉ" value="{{ $diachi }}" required />
          </div>
          <div class="form-group">
            <label>Giới thiệu bản thân</label>
            <textarea name="mota" class="form-control" rows="3">{{ $mota }}</textarea>
          </div>
          <button type="submit" class="btn btn-default">Sửa</button>
          <button type="reset" class="btn btn-default">Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
@endsection