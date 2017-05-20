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

			  <div id="content" class="boxcontent">
			  	<div class="dash-profile">
			  		<h3>Assamualaikum, wr wb, {{session('sess_name')}}</h3>
			  		<img src="{{getAvatar($detailProfile)}}" style="width: 100px;height: 100px" class="img-circle">
			  		<a class="btn btn-green" href="{{url('profile/edit')}}">Edit Profile</a>
			  		<a class="btn btn-green" href="javascript:void(0)" onclick="QuranJS.bookmarkModal('{{@$_COOKIE['coo_mushaf_bookmark_title']}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')">Bacaan Terakhir</a>
			  		<a class="btn btn-green" href="javascript:void(0)" onclick="QuranJS.memozList()">Hafalan</a>
			  		<a class="btn btn-green">Bookmark</a>
			  		<a class="btn btn-green" href="javascript:void(0)" onclick="QuranJS.correctionList()">Koreksi <sup>New</sup></a>
			  	</div>
			  	<hr>
			  	<h4 class="boxcontent-label">Butuh Koreksi</h4>
				  @if(!empty($needCorrections))
			  		<ul class="correction-list list-unstyled">
						  @foreach($needCorrections as $row)
			  		<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
					  <li class="correction-list-item">
					  	<img src="{{getAvatar($row)}}" style="width: 50px;height: 50px" class="img-circle">
			  			<span class="username">{{$row->name}}</span>
			  			<span class="ayat-target"><a href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a></span>
			  			<span class="spacer1">&bullet;</span> <i class="fa fa-check-square-o">{{empty($row->count_correction)?0:$row->count_correction}} koreksi</i>
			  		</li>
					  @endforeach
				  	</ul>
				  	<a href="javascript:void(0)" onclick="QuranJS.needCorrections(0)">Lainnya</a>
			  	@endif

			  	<h4 class="boxcontent-label">Hafalan lain</h4>
				  @if(!empty($listMemoz))
			  		<ul class="correction-list list-unstyled">
						  @foreach($listMemoz as $row)
			  		<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
					  <li class="correction-list-item">
					  	<img src="{{getAvatar($row)}}" style="width: 50px;height: 50px" class="img-circle">
			  			<span class="username">{{$row->name}}</span>
			  			<span class="ayat-target"><a href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a></span>
			  		</li>
					  @endforeach
				  	</ul>
				  	<a href="javascript:void(0)" onclick="QuranJS.memozOthers()">Lainnya</a>
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