@extends('templates.public.template')

@section('main')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row loadGH">
			<form action="" method="post">
				{{ csrf_field() }}
				<div class="col-lg-12">
					<h3 class="page-header">
						Thời gian còn lại <span id="time" style="color: red">50:00</span>
					</h3>
				</div>
				<!-- /.col-lg-12 -->
				<div class="col-lg-10 list_content">

					@foreach($arItems as $key => $arItem)
					<div class="content num{{$key + 1}}">
						<div class="cauhoi">
							<h4>Câu số {{ $key + 1}}: </h4>
							<div class="noidung">
								{{ $arItem['name'] }}
							</div>
						</div>
						<div class="dapan" style="padding-left: 20px">
							<span class="idch" style="visibility: hidden;">{{ $arItem['id']}}</span>
							<div class="DaRatio">
								<input type="radio" name="check{{$key + 1}}" value="a" data="{{$key + 1}}">
								<span >a. {{ $arItem['a'] }}</span>
							</div>
							<div class="DaRatio">
								<input type="radio" name="check{{$key + 1}}" value="b" data="{{$key + 1}}">
								<span>b. {{ $arItem['b'] }}</span>
							</div>
							<div class="DaRatio">
								<input type="radio" name="check{{$key + 1}}" value="c" data="{{$key + 1}}">
								<span>c. {{ $arItem['c'] }}</span>
							</div>
							<div class="DaRatio">
								<input type="radio" name="check{{$key + 1}}" value="d" data="{{$key + 1}}">
								<span>d. {{ $arItem['d'] }}</span>
							</div>
						</div>
					</div>
					@endforeach
					<div id="khungdapan">
						<ul>
							@foreach($arItems as $key => $arItem)
							<li>
								<a href="javascript:void(0)" class="{{$key + 1}}" data="{{ $key + 1}}">{{ $key + 1}}</a>
							</li>
							@endforeach
						</ul>
					</div>

				</div>

			</form>

			

		</div>
		<!-- /.row -->
		<div class="row loadKQ" style="text-align: center;">
			<!-- <h3 style="margin-bottom: 20px;">Chúc mừng bạn vừa hoàn thành xong bài test.</h3> -->
			<div class="xemkq">
				<a href="{{ route('public.index.ketqua') }}" >Nộp bài</a>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
@endsection