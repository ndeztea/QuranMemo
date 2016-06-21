<ul class="juz-list clearfix">
@foreach($surahs as $surah)
	<li>
		<a href="{{url('mushaf/changeSurah/'.$surah->id)}}">{{$surah->id}}. {{$surah->surah_name}} <br> ({{$surah->type}})</a>
	</li>
@endforeach
</ul>