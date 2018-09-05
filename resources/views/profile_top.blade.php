@extends('layouts.master')

@section('title', 'Daftar QuranMemo')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			<div class="dropdown">
	              <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;min-width: 300px;background: none;border: 0px;font-weight: bold;font-size: 20px">
	                {{ucfirst($type)}}
	                <span class="caret"></span>
	              </button>
	              <ul class="dropdown-menu choose-type" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px">
	                <li><a href="{{url('profile/top_user?type=mingguan')}}">Mingguan</a></li>
	                <li><a href="{{url('profile/top_user?type=bulanan')}}">Bulanan</a></li>
	                <li><a href="{{url('profile/top_user?type=tahunan')}}">Tahunan </a></li>
	                <li><a href="{{url('profile/top_user?type=seluruhnya')}}">Seluruhnya</a></li>
	             </ul>
	            </div>
			<table class="top_user table">
			<?php $no = 0?>
			@foreach($list as $row)
			<?php $no++?>
			<tr class="list_top_user">
				<td class="no_top_user" width="50">#{{$no}}</td>
				<td class="detail"><img src="{{getAvatar($row)}}" class="avatar"><span class="name">{{$row->name}}</span></td>
				<td class="no_top_user" align="center"><span class="border_points img-circle">{{$row->points}}</span></td>
			</tr>
			@endforeach
			</table>
		</div>
		<!-- main-content -->
	</div>
	<!-- main-content-wrap -->
</div>
<!-- wrap -->
<script>
$(document).ready(function(){
	$('#register_dob').datepicker({
            format: "yyyy-mm-dd",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
});
</script>
@endsection