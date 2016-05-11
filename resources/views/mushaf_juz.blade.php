<ul>
@foreach($juzs as $juz)
	<li>
		<a href="{{url('mushaf/page/'.$juz->page)}}"><strong>{{$juz->id}}</strong> <span class="juz-arabic">{{$juz->juz_arabic}}</span> <span class="juz-indo">{{$juz->juz_indo}}</span></a>
	</li>
@endforeach
</ul>