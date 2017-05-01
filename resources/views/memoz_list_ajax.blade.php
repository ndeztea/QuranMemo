@if(!empty($list))
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<div class="memoz-item memoz-{{$row->id}}">
		<div class="memoz-body" onclick="location.href='{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}'">
			<a class="memoz-link-surah" href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}"><strong>{{$row->surah}} : {{$ayat_target}}</strong></a>
			<span class="memoz-target"> 
				<i>{{dayDiff($row->date_start,$row->date_end)->days}} hari lagi</i>
				<span class="spacer1">&bull;</span> <i>@if($row->status==0) Belum Hafal @else Hafal dan Menunggu koreksi @endif</i>
			</span>
			<p>{{$row->note}}</p>
		</div>
		<div class="memoz-action">
			<a onclick="QuranJS.formMemoModal('{{$row->id}}')" href="javascript:void(0)" class="left"><i class="fa fa-edit" ></i>  Edit</a>
			&nbsp;
			<a href="javascript:void(0)" onclick="QuranJS.deleteMemoz('{{$row->id}}')" class="right"><i class="fa fa-remove"></i> Hapus</a>
		</div>
	</div>
	@endforeach
@else
<p class="alert alert-warning">Hafalan belum ada</p>
@endif