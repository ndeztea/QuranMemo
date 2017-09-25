<ul class="juz-list clearfix">
@foreach($juzs as $juz)
	<li>
		<a href="{{url('mushaf/juz/'.$juz->id)}}" onclick="fbq('track', 'clickToJuzPage');"><strong>{{arabicNum($juz->id)}}</strong> &dot; <strong class="juz-indo-head">{{$juz->id}}</strong> <br><span class="juz-arabic">{{$juz->juz_arabic}}</span> <span class="juz-indo">{{$juz->juz_indo}}</span></a>
	</li>
@endforeach
</ul>