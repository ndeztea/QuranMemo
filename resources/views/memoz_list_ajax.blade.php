@if(!empty($list))
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<div class="memoz-item memoz-{{$row->id}}">
		<div class="memoz-body" onclick="location.href='{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}'">
			<div class="memoz-tr">
				<span class="tr-days">{{dayDiff($row->date_start,$row->date_end)->days}}</span>
				<span class="tr-label">hari lagi</span>
			</div>
			<!--/memoz-time-remaining(tr)-->
			<div class="memoz-content">
				<div class="memoz-content-top">
					<a class="memoz-link-surah" href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">
						{{$row->surah}} : {{$ayat_target}}
					</a>
					<span class="memoz-status"> 
						<i>@if($row->status==0) Belum Hafal @else Hafal dan Menunggu koreksi @endif</i>
					</span>
				</div>
				<!--/memoz-content-top-->
				<div class="memoz-content-bot">
					<p>{{$row->note}}</p>
				</div>
				<div class="memoz-action">
					<a onclick="QuranJS.formMemoModal('{{$row->id}}')" href="javascript:void(0)" class="left"><i class="fa fa-edit" ></i>  Edit</a>
					&nbsp;
					<a href="javascript:void(0)" onclick="QuranJS.deleteMemoz('{{$row->id}}')" class="right"><i class="fa fa-remove"></i> Hapus</a>
				</div>
				<!--/memoz-action-->
			</div>
			<!--/memoz-content-->
			<div class="memoz-check-hafalan">
				Hafal
			</div>
		</div>
	</div>
	<!--/memoz-item-->
	@endforeach
@else
<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
@endif