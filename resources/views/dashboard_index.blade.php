@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')

<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<!-- /backdrop -->
		<div class="single-column">
			<div class="page-title">
				<h2>Dashboard page</h2>
			</div>
			  <div id="content">
			  	<strong>Butuh Koreksi</strong>
			  	@if(!empty($needCorrections))
			  	<ul>
			  		@foreach($needCorrections as $row)
			  		<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
			  		<li>
			  			<strong>{{$row->name}}</strong><br/>
			  			<em><a href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a></em>
			  		</li>
			  		@endforeach
			  	</ul>    
			  	@endif
			  </div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->	
	</div>
<!-- end main main-content-wrap -->	
</div>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection