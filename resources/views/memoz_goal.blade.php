<ul class="goal">
@foreach($listSurah as $surah)
<li style="width: 31%;float:left !important;margin: 3px">
	<div class="progress" style="height: 40px;"> 
	<?php 
		$progressStyle = 'progress-bar-success';
		if($surah->percent<99 && $surah->percent>=75){
			$progressStyle = '';
		}elseif($surah->percent<75 && $surah->percent>=25){
			$progressStyle = 'progress-bar-warning';
		}elseif($surah->percent<25 && $surah->percent>=0){
			$progressStyle = 'progress-bar-danger';
		}
		 
	?>
		<div class="progress-bar {{$progressStyle}} progress-bar-striped" role="progressbar" aria-valuenow="{{$surah->percent * 100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$surah->percent}}%;">
			<div class="progress-label" style="width: 100px;">
				<strong>{{$surah->id}}. {{$surah->surah_name}}</strong><br> <sup style="color:#000">{{$surah->countAyat}} / {{$surah->ayat}} ({{$surah->percent}}%)</sup>
			</div>
		</div>

	 </div>
</li>
@endforeach
</ul>