<ul class="goal">
@foreach($listSurah as $surah)
<li>
	<strong>{{$surah->id}}. {{$surah->surah_name}}</strong> <sup>{{$surah->countAyat}} / {{$surah->ayat}}</sup>
	<div class="progress"> 

		<div class="progress-bar" role="progressbar" aria-valuenow="{{$surah->percent * 100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$surah->percent}}%;">
		</div>
	 </div>
</li>
@endforeach
</ul>