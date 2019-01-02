@extends('layouts.master')

@section('title', 'Daftar QuranMemo')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content edit-profile-block" style="background:none !important">
			<div class="edit-profile-form">
				<div class="dropdown">
		              <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;min-width: 300px;background: none;border: 0px;font-weight: bold;font-size: 20px">
		                {{ucfirst($type)}}
		                <span class="caret"></span>
		              </button>
		              <ul class="dropdown-menu choose-type" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px">
		                <li><a href="{{url('profile/top_user?type=pekanan')}}">Pekanan</a></li>
		                <li><a href="{{url('profile/top_user?type=bulanan')}}">Bulanan</a></li>
		                <li><a href="{{url('profile/top_user?type=tahunan')}}">Tahunan </a></li>
		                <li><a href="{{url('profile/top_user?type=seluruhnya')}}">Seluruhnya</a></li>
		             </ul>
		            </div>
		        <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="{{empty($gender)?'active':''}}" style="width: 33.33%"><a href="{{url('profile/top_user?type='.$type)}}">Semuanya</a></li>
					<li role="presentation" class="{{$gender=='m'?'active':''}}"  style="width: 33.33%"><a href="{{url('profile/top_user?type='.$type)}}&gender=m">Ikhwan</a></li>
					<li role="presentation" class="{{$gender=='f'?'active':''}}"  style="width: 33.33%"><a href="{{url('profile/top_user?type='.$type)}}&gender=f">Akhwat</a></li>
				</ul>
				<table class="top_user table">
				<?php $no = 0?>
				@foreach($list as $row)
				<?php $no++?>
				<tr class="list_top_user">
					<td class="no_top_user" width="50">#{{$no}}</td>
					<td class="detail">
						<a href="{{url('profile/detail/'.$row->id)}}"><img src="{{getAvatar($row)}}" class="avatar img-circle"> <span class="name">{{$row->name}}</span>
						</a>
					@if(session('sess_role')==1)
					<br><a href="https://api.whatsapp.com/send?phone={{$row->hp}}" target="_blank" class="label label-success"><i class="fa fa-whatsapp"></i> {{$row->hp}}</a>
					@endif
					</td>
					<td class="no_top_user" align="center"><span class="border_points img-circle">{{$row->points}}</span></td>
				</tr>
				@endforeach
				</table>
			</div>
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
