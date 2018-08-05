<div class="memoz_filter_{{$filter}}">
@if(!empty($list))
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<div class="memoz-item memoz-{{$row->id}}">
		<div class="memoz-body">
			<div class="memoz-body-inner">
				
					@if ($filter==3)
					<?php 
						$days_murajaah = 0;
						if (!empty($row->murajaah_date)){
							$days_murajaah = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($row->murajaah_date)),false);
						}
						?>
						
						@if ($days_murajaah == 0)
						<div class="memoz-tr tr-murajaah">
							<span class="tr-label">Belum Pernah Murajaah {{$days_murajaah}}</span>
						</div>
						@else
						<div class="memoz-tr">
							<span class="tr-label">Murajaah</span>
							<span class="tr-days" style="line-height: 25px;">{{str_replace('-','',$days_murajaah)}}</span>
							<span class="tr-label">hari lalu</span>
						</div>
						@endif
					@else
					<div class="memoz-tr">
						<?php $days = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($row->date_end)),false)?>
						<span class="tr-days">{{$days>0?$days:0}}</span>
						<span class="tr-label">hari lagi</span>
					</div>
					@endif
				
				<!--/memoz-time-remaining(tr)-->
				<div class="memoz-content"  onclick="fbq('track', 'clickHafalkanTarget');location.href='{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id.'?filter='.$filter)}}'">
					<div class="memoz-content-top">
						<a class="memoz-link-surah" href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id.'?filter='.$filter)}}">
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
				</div>
				<!--/memoz-content-->
				<div class="memoz-check-hafalan">
					@if($filter==3)
						<a class="memoz-check-link" href="javascript:void(0)"  onclick="fbq('track', 'clickSkipMurajaah');QuranJS.updateStatusMemoz('{{$row->id}}','3','Lewati murajaah hafalan ini?')">
							<span class="memoz-link-area"><i class="fa fa-forward"></i></span>
							<span class="check-label">Lewati</span>
						</a>
					@else
						@if($row->status==0)
						<a class="memoz-check-link" href="javascript:void(0)"  onclick="fbq('track', 'clickSudahHafal');QuranJS.updateStatusMemoz('{{$row->id}}','1','Ayat di surah ini sudah hafal?')">
							<span class="memoz-link-area"><i class="fa fa-circle-thin"></i></span>
							<span class="check-label">Hafal</span>
						</a>
						@else
						<a class="memoz-check-link" href="javascript:void(0)" onclick="fbq('track', 'clickLupa');QuranJS.updateStatusMemoz('{{$row->id}}','0','Hafalan ini belum di hafal dengan benar?')">
							<span class="memoz-link-area"><i class="fa fa-circle"></i></span>
							<span class="check-label">Lupa</span>
						</a>
						@endif
					@endif
				</div>
				<!--/memoz-check-hafalan-->
			</div>
			<!--/memoz-body-inner-->
			<div class="memoz-action">
				<a onclick="fbq('track', 'clickEditMemoz');QuranJS.formMemoModal('{{$row->id}}')" href="javascript:void(0)" class="left"><i class="fa fa-edit" ></i>  Edit</a>
				&nbsp;
				<a href="javascript:void(0)" onclick="fbq('track', 'clickHapusMemoz');QuranJS.deleteMemoz('{{$row->id}}')" class="right"><i class="fa fa-remove"></i> Hapus</a>
				&nbsp;
				@if($row->status==0)
				<a href="javascript:void(0)"  class="right" onclick="QuranJS.updateInProgress('{{$row->id}}')"><i class="fa fa-star{{$row->in_progress==0?'-o':''}}" ></i> In Progress</a>
				@else
				<a href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}"  class="right"><i class="fa fa-stop-circle"></i> Rekam</a>
				@endif
			</div>
			<!--/memoz-action-->
		</div>
		<!--/memoz-body-->
	</div>
	<!--/memoz-item-->
	@endforeach

	@if($start==0 && count($list)>=0)
		<a href="javascript:void(0)" onclick="QuranJS.memozFilter({{$filter}},'next')" class="btn btn-green btn-loadmore">Selanjutnya</a>
	@endif
@else
	@if($start==0)
	<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
	@endif
@endif
</div>