<div class="memoz_filter_{{$filter}}">
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
				<div class="memoz-content"  onclick="location.href='{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}'">
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
				</div>
				<!--/memoz-content-->
				<div class="memoz-check-hafalan">
					@if($row->status==0)
					<a class="memoz-check-link" href="javascript:void(0)"  onclick="QuranJS.updateStatusMemoz('{{$row->id}}','1','Ayat di surah ini sudah hafal?')">
						<span class="memoz-link-area"><i class="fa fa-circle-thin"></i></span>
						<span class="check-label">Hafal</span>
					</a>
					@else
					<a class="memoz-check-link" href="javascript:void(0)" onclick="QuranJS.updateStatusMemoz('{{$row->id}}','0','Hafalan ini belum di hafal dengan benar?')">
						<span class="memoz-link-area"><i class="fa fa-circle"></i></span>
						<span class="check-label">Lupa</span>
					</a>
					@endif
				</div>
				<!--/memoz-check-hafalan-->
			</div>
			<!--/memoz-body-inner-->
			<div class="memoz-action">
				<a onclick="QuranJS.formMemoModal('{{$row->id}}')" href="javascript:void(0)" class="left"><i class="fa fa-edit" ></i>  Edit</a>
				&nbsp;
				<a href="javascript:void(0)" onclick="QuranJS.deleteMemoz('{{$row->id}}')" class="right"><i class="fa fa-remove"></i> Hapus</a>
				&nbsp;
				<a href="javascript:void(0)"  class="right"><i class="fa fa-stop-circle"></i> Rekam</a>
			</div>
			<!--/memoz-action-->
		</div>
		<!--/memoz-body-->
	</div>
	<!--/memoz-item-->
	@endforeach
	@if($start==0)
		<a href="javascript:void(0)" onclick="QuranJS.memozFilter({{$filter}},'next')" class="btn btn-green btn-loadmore">Selanjutnya</a>
	@endif
@else
	@if($start==0)
	<p class="alert alert-warning no-content-center">Hafalan belum ada</p>
	@endif
@endif
</div>
<script>
$('.memoz-check-link').click(function() {

    $(".memoz-link-area i",this).toggleClass("fa-check-circle fa-circle-thin");
});
</script>