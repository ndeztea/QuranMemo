<div class="memoz-list">
	@if(!empty($list))
		@foreach($list as $row)
		<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
		<div class="memoz-item memoz-{{$row->id}}">
			<div class="memoz-body" onclick="location.href='{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id_memo_target.'/'.$row->id)}}'">
				<strong>{{$row->name}} ({{$row->email}})</strong>
				<br>
				<span class="memoz-target"> 
					<i>{{dayDiff(date('Y-m-d'),$row->date_updated)->days}} hari yang lalu</i>
				</span>
				<p>{{str_limit($row->note,100,'...')}}</p>
			</div>
		</div>
		@endforeach
	@else
	<p class="alert alert-warning">Koreksi belum ada</p>
	@endif
</div>