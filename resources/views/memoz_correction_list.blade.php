@if($start==0)
<div class="memoz-list">
@endif
	@if(!empty($list))
		@foreach($list as $row)
		<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
		<div class="memoz-item memoz-{{$row->id}}">
			<div class="memoz-body" onclick="location.href='{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id_memo_target.'/'.$row->id)}}'">
				<strong>{{$row->name}}</strong>
				<br>
				<span class="memoz-target"> 
					<i>{{dayDiff(date('Y-m-d'),$row->date_updated)->days}} hari yang lalu</i>
				</span>
			</div>
			<p>{{str_limit($row->note,100,'...')}}</p>
		</div>
		@endforeach
		@if($start==0)
			<a href="javascript:void(0)" onclick="QuranJS.correctionList('next','{{$idMemo}}')" class="btn btn-green btn-loadmore">Selanjutnya</a>
		@endif
	@else
		@if($start==0)
		<p class="alert alert-warning">Koreksi belum ada</p>
		@endif
	@endif
@if($start==0)
</div>
@endif