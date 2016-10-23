<div class="memoz-list">
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<div class="memoz-item memoz-{{$row->id}}">
		<div class="memoz-body" onclick="location.href='{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}'">
			<strong><a href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a></strong>
			<span class="memoz-target"> 
				<i>{{dayDiff($row->date_start,$row->date_end)->days}} hari</i>
				&bull; <i>@if($row->status==0) Belum Hafal @else Setor @endif</i>
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
</div>