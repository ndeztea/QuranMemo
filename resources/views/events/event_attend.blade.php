@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')

<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<div class="single-column dashboard-wrap">
			  <div id="content" class="boxcontent">
					<div class="collapse in" id="dashboard-items">
						<div class="tabbed-nav">
    					<ul class="tabbed-nav-list list-unstyled">
    						<li class="tabbed-full"><img src="{{url('events/'.$event->image)}}"></li>
							</ul>
							<ul class="tabbed-nav-list list-unstyled">
								<li class="tabbed-full left event">
									<form action="{{url('event/attend/'.$event->id)}}" method="post">
										<input type="text" placeholder="Attend Code" value="{{$code_access}}" name="code_access" style="border: 1px dashed #a2a39a;
								    margin: 5px 0px;
								    width: 100%;
								    font-size: 30px;
								    text-align: center;">
										<button class="btn btn-primary" style="width:100%;font-size:20px"><i class="mdi mdi-magnify"></i> Cari</button>
									</form>
								</li>
							</ul>
							<ul class="tabbed-nav-list list-unstyled">
								<li>
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="{{$gender==''?'active':''}}" style="width: 33.33%"><a href="{{url('event/attend/'.$event->id)}}">Semuanya</a></li>
										<li role="presentation" class="{{$gender=='m'?'active':''}}" style="width: 33.33%"><a href="{{url('event/attend/'.$event->id)}}?gender=m">Ikhwan</a></li>
										<li role="presentation" class="{{$gender=='f'?'active':''}}" style="width: 33.33%"><a href="{{url('event/attend/'.$event->id)}}?gender=f">Akhwat</a></li>
									</ul>
									<p>
										<br>
									Total jemaah : <strong>{{count($attendList)}} orang</strong>
								</p>
									<?php $a=1?>
									<table class="table table-striped">
										<tbody>
											@foreach($attendList as $attend)
												<tr class="{{$attend->attend==1?'success':''}}">
													<td style="width:20px">{{$a++}}.</td>
													<td>{{$attend->name}}<br><i>{{$attend->code_access}}</i>
														<br>
														@if($attend->attend==1)
														<a href="{{url('event/cancelAbsent/'.$attend->code_access)}}" class="btn btn-warning"><i class="mdi mdi-refresh"></i> Batal</a>
														<a href="{{url('event/cancelAttend/'.$event->id.'?code_access='.$attend->code_access)}}" class="btn btn-danger"><i class="mdi mdi-close"></i> Tidak hadir</a>
														@else
														<a href="{{url('event/absent/'.$attend->code_access)}}" class="btn btn-success"><i class="mdi mdi-check"></i> Hadir</a>
														<a href="{{url('event/cancelAttend/'.$event->id.'?code_access='.$attend->code_access)}}" class="btn btn-danger"><i class="mdi mdi-close"></i> Tidak hadir</a>
														@endif
													</td>
												<tr>
											@endforeach
										</tbody>
							</ul>
					</div>
				</div>
		</div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->
	</div>
<!-- end main main-content-wrap -->
</div>
@endsection
