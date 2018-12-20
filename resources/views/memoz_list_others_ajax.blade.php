<div class="memoz_filter_others">
@if(!empty($list))
	<ul class="correction-list list-unstyled">
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<li class="correction-list-item">
		<div class="koreksi-box">
			<div class="koreksi-avatar img-circle">
				<img src="{{getAvatar($row)}}"  class="img-circle">
			</div>
			<div class="koreksi-desc">
				<span class="username">{{$row->name}} <sup class="badge">{{getAge($row)}}</sup></span>
				<span class="ayat-target"><a href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a></span>	
				<br>
				<span class="jumlah-koreksi"><i class="mdi mdi-clock"></i> {{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
				<div class="koreksi-action">
					<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalakan');">Hafalkan</a>
				</div>
			</div>
		</div>
	</li>
	@endforeach
	</ul>

	@if($start==0 && $listCount>10)
		<a href="javascript:void(0)" onclick="QuranJS.memozOthers('{{$filter}}','next')" class="btn btn-green btn-loadmore">Selanjutnya</a>
	@endif
@else
	@if($start==0)
	<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
	@endif
@endif
</div>