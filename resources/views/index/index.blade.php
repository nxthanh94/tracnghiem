@extends('templates.public.template')

@section('main')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
		<div class="col-md-12">
			<div class="item_header">
				<div class="logo">
					<img src="{{ $url_public }}/admin/images/logo.jpg" >
				</div>
				<div class="item_title">
					<h3>TỔNG CỤC HẢI QUAN
					<span>CỤC HẢI QUAN TỈNH QUẢNG NAM</span>
					</h3>
				</div>
			</div>
			<div class="item_content">
				  HỆ THỐNG HỖ TRỢ KIẾN THỨC <br />
				ĐỂ CHUẨN BỊ ĐÁNH GIÁ NĂNG LỰC <br />
				CỦA CÁN BỘ, CÔNG CHỨC
			</div>
			<div class="item_footer">
				<h3>CỤC HẢI QUAN TỈNH QUẢNG NAM</h3>
				<h4>Đường Lê Thánh Tông- An Phú- Tam Kỳ- Quảng Nam</h4>
			</div>
		</div>

		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<span id="time" style="display: none" >50:00</span>
<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
@endsection