@extends('templates.public.template')

@section('main')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">
					Kết quả
				</h3>
			</div>
			<!-- /.col-lg-12 -->
			<?php
			$arCheck = explode(',',$arKetqua['ketqua']);

			$arKythi = DB::table('kythi')->find(2);
			$arCH = explode(',',$arKythi['cauhoi']);
			$arCauHoi = DB::table('cauhoi')->whereIn('id',$arCH)->get();
			$diem = 0;
			$ketqua = array();
			?>
			<br/>

			<div class="col-lg-10 list_content" style="padding-bottom: 100px;">
				@foreach($arCheck as $key1 => $value)
				<?php
				$arDapan = explode(':', $value);
				$check = DB::table('cauhoi')->where('id',$arDapan[0])->where('dapan',$arDapan[1])->get();
				$kq_item =array('cauhoi' =>$arDapan[0],'dapan' =>$arDapan[1], 'diem'=>0);
				if(count($check)>=1){
					$kq_item['diem'] = 1;
				}
				$ketqua[] =$kq_item; 
				?>

				@foreach($arItems as $key => $arItem)
				@if($key1 == $key)
				<div class="num{{$key + 1}}">
					<div class="cauhoi">
						<h4>Câu số {{ $key + 1}}: </h4>
						<div class="noidung">
							{{ $arItem['name'] }}
						</div>
					</div>
					<div class="dapan" style="padding-left: 20px">
						<div class="DaRatio">
							<input type="radio" name="check{{$key + 1}}" value="a" data="{{$key + 1}}"
							@if($arDapan[1] == 'a') checked="" @endif>
							<span >a. {{ $arItem['a'] }} @if($arItem['dapan'] == 'a' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>

						</div>
						<div class="DaRatio">
							<input type="radio" name="check{{$key + 1}}" value="b" data="{{$key + 1}}"
							@if($arDapan[1] == 'b') checked="" @endif>
							<span>b. {{ $arItem['b'] }} @if($arItem['dapan'] == 'b' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif </span>
						</div>
						<div class="DaRatio">
							<input type="radio" name="check{{$key + 1}}" value="c" data="{{$key + 1}}"
							@if($arDapan[1] == 'c') checked="" @endif>
							<span>c. {{ $arItem['c'] }} @if($arItem['dapan'] == 'c' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>
						</div>
						<div class="DaRatio">
							<input type="radio" name="check{{$key + 1}}" value="d" data="{{$key + 1}}"
							@if($arDapan[1] == 'd') checked="" @endif>
							<span>d. {{ $arItem['d'] }} @if($arItem['dapan'] == 'd' ) <i class="fa fa-check" style="color: #5cb85c;"></i>  @endif</span>
						</div>
					</div>
				</div>
				@endif
				@endforeach
				@endforeach
			</div>
		</div>



	</div>
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->
@endsection