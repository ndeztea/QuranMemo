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
							<?php if(session('sess_id')>0):?>
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="{{$type=='upcoming'?'active':''}}"  style="width: 50%"><a href="{{url('event?type=upcoming')}}">Jadwal Selanjutnya</a></li>
								<li role="presentation" class="{{$type=='archive'?'active':''}}"  style="width: 50%"><a href="{{url('event?type=archive')}}">Arsip</a></li>
							</ul>
							<?php endif?>
							<?php if(!empty($events)):?>
	  						<?php foreach ($events as $event): ?>
									<ul class="tabbed-nav-list list-unstyled">
		    						<li class="tabbed-full">
											<a href="{{url('event/'.$event->id)}}"><img src="{{url('events/'.$event->image)}}"></a>
											@if (session('sess_role')>0)
											<br><br>
											<a href="{{url('admin/event/form/'.$event->id)}}" class="btn btn-primary">Edit</a>
											<a href="{{url('admin/event/remove/'.$event->id)}}" class="btn btn-danger">Hapus</a>
											@endif
										</li>
									</ul>
								<?php endforeach; ?>
							<?php else:?>
								<ul class="tabbed-nav-list list-unstyled">
									<li class="tabbed-full">
										Jadwal kajian tidak ada
									</li>
								</ul>
							<?php endif?>
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
