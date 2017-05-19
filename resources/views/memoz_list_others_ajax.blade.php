<div class="memoz_filter_others">
@if(!empty($list))
	@foreach($list as $row)
	<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
	<div class="memoz-item memoz-{{$row->id}}">
		<div class="memoz-body">
			<div class="memoz-body-inner">
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
					</div>
					<!--/memoz-content-top-->
					<div class="memoz-content-bot">
						<p>{{$row->note}}</p>
					</div>
				</div>
				<!--/memoz-content-->
			</div>
			<!--/memoz-body-inner-->
		</div>
		<!--/memoz-body-->
	</div>
	<!--/memoz-item-->
	@endforeach
	@if($start==0)
		<a href="javascript:void(0)" onclick="QuranJS.memozOthers('next')" class="btn btn-green btn-loadmore">Selanjutnya</a>
	@endif
@else
	@if($start==0)
	<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
	@endif
@endif
</div>