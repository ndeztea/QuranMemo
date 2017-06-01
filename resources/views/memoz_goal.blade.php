<ul class="goal">
@foreach($listSurah as $surah)
<li>
	<strong>{{$surah->id}}. {{$surah->surah_name}}</strong> <sup>{{$surah->countAyat}} / {{$surah->ayat}} ({{$surah->percent}}%)</sup>
	<div class="progress" style="height: 7px"> 
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
		</div>
	 </div>
</li>
@endforeach
</ul>