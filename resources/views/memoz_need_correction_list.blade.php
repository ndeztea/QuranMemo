<div class="corrections_filter_others">
@if(!empty($list))
	<ul class="correction-list list-unstyled">
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<li class="correction-list-item">
		<div class="koreksi-box">
			<div class="koreksi-avatar img-circle">
				<a href="{{url('profile/detail/'.$row->id_user)}}"><img src="{{getAvatar($row)}}"  class="img-circle"></a>
			</div>
			<div class="koreksi-desc">
					<a href="{{url('profile/detail/'.$row->id_user)}}"><span class="username">{{$row->name}}</a>
					<sup class="badge">{{getAge($row)}}</sup>
					@if(session('sess_role')==1 || session('sess_role')==2)
						@foreach($row->listSubscriptions as $subscription)
						<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
						<sup class='label label-primary'>Paket {{ucfirst($level[$subscription->level])}} ( {{$daysLeft}} hari ) </sup>
						@endforeach
					@endif
				</span>
				<span class="ayat-target">
					<a class="ayat-target-link" href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a> <sup class='label label-primary'><i class="mdi mdi-library"></i> {{$row->id}}</sup>
					<br>
					<span class="jumlah-koreksi"></span>
				</span>
				<br>
				<span class="jumlah-koreksi"><i class="mdi mdi-clock"></i> {{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}} &bullet; <i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}}
					&bullet;
					<i class="mdi mdi-book-open-variant"></i> {{empty($row->visitor)?0:$row->visitor}}</span>
				<div class="koreksi-action">
					@if(session('sess_role')==1 || session('sess_role')==2)
					<a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a>
					@endif
					<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
				</div>
			</div>
			<!--/koreksi-desc-->
		</div>
	</li>
	@endforeach
	</ul>
	@if($start==0 && $listCount>10)
		<a href="javascript:void(0)" onclick="QuranJS.needCorrections('next')" class="btn btn-green btn-loadmore">Selanjutnya</a>
	@endif
@else
	@if($start==0)
	<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
	@endif
@endif
</div>
