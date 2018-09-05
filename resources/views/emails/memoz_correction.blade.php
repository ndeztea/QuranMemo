@extends('layouts.master_email')
@section('content')
<p>
Assalamualaikum, wr wb {{$emailData['name_target']}}
</p>
<div class="order-detail">
	<p>Hafalan antum sudah dikoreksi oleh <strong>{{$emailData['name_corrector']}}</strong> </p>
	<p>Target hafalan antum</p>
	<div class="price">{{$emailData['surah_start']->surah_name}} : {{$emailData['memoDetail']->ayat_start}} - {{$emailData['memoDetail']->ayat_end}}</div>
	<p>Untuk melihat detail koreksi buka app "QuranMemo Community"</p>
</div>

@endsection