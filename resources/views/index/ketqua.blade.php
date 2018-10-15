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
			<div class="col-lg-6 list_content" style="padding-bottom:120px">
				<br/>
				
				@foreach($arCheck as $key1 => $value)
				<?php
				$arDapan = explode(':', $value);
				$check = DB::table('cauhoi')->where('id',$arDapan[0])->where('dapan',$arDapan[1])->get();
				$kq_item =array('cauhoi' =>$arDapan[0],'dapan' =>$arDapan[1], 'diem'=>0);
				if(count($check)>=1){
					$kq_item['diem'] = 4;
				}
				$ketqua[] =$kq_item; 
				?>
				@endforeach
				@foreach($ketqua as $key => $KQ)
				<?php 
				$diem = $diem + $KQ['diem']; 
				if($KQ['diem'] == 4){
					$caudung = $caudung + 1;
				}else{
					$causai = $causai + 1;
				}
				?>
				@endforeach

				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<tbody>
						<tr class="odd " >
							<td width="40%;">Ngày thi</td>
							<td>{{ $arKetqua['updated_at'] }}</td>
						</tr>
						<tr class="odd " >
							<td>Họ và tên</td>
							<td>{{ $arName['name'] }}</td>
						</tr>
						<tr class="odd " >
							<td>Số câu đúng</td>
							<td>{{ $caudung }}</td>
						</tr>
						<tr class="odd " >
							<td>Số câu sai</td>
							<td>{{ $causai }}</td>
						</tr>
						<tr class="odd " >
							<td>Thời gian còn</td>
							<td>{{ $arKetqua['time'] }}</td>
						</tr>
						<tr class="odd " >
							<td>Điểm</td>
							<td>{{ $diem }}/100</td>
						</tr>
						<tr class="odd " >
							<td colspan="2"><a href="{{ route('public.index.ctkq') }}">Xem chi tiết</a></td>
						</tr>
					</tbody>
				</table>
				
				
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