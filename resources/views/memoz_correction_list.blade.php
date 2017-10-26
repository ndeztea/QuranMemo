
	@if($start==0)
	<div class="memoz-list">
	@endif
		@if(!empty($list))
			@foreach($list as $row)
			<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
			<div class="memoz-item memoz-{{$row->id}}">
			<div class="memoz-body">
				<div class="memoz-body-inner" style="{{$row->status==1?'':'background-color: rgba(255, 168, 0, 0.31)'}}">
					<div class="memoz-tr" style="text-align: center;">
						<?php $days = Carbon::createFromTimeStamp((strtotime($row->date_updated)))->diffForHumans()?>
						<span class="tr-days" style="width: auto;">{{intval($days)}}</span>
						<span class="tr-label">{{str_replace(intval($days), '', $days)}}</span>
					</div>
					<!--/memoz-time-remaining(tr)-->
					<div class="memoz-content" >
						<div class="memoz-content-top">
							<a class="memoz-link-surah" href="#">
								{{$row->name}}
							</a>
						</div>
						<!--/memoz-content-top-->
						<div class="memoz-content-bot">
							<p>{{str_limit($row->note,100,'...')}}</p>
						</div>
					</div>
					<!--/memoz-content-->
					<div class="memoz-check-hafalan">
						<a class="memoz-check-link" href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id_memo_target.'/'.$row->id)}}" onclick="fbq('track', 'clickLihatKoreksi')">
							<span class="memoz-link-area"><i class="fa fa-check-square{{$row->status==1?'-o':''}}"></i></span>
							<span class="check-label">Lihat</span>
						</a>
						
					</div>
					<!--/memoz-check-hafalan-->
				</div>
				<!--/memoz-body-inner-->
				
			</div>
			<!--/memoz-body-->
		</div>
		<!--/memoz-item-->
			@endforeach
			@if($start==0)
				<a href="javascript:void(0)" onclick="QuranJS.correctionList('next','{{$idMemo}}')" class="btn btn-green btn-loadmore">Selanjutnya</a>
			@endif
		@else
			@if($start==0)
			<p style="margin: 10px" class="alert alert-warning">Koreksi belum ada</p>
			@endif
		@endif
	@if($start==0)
	</div>
	@endif