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
  						<?php foreach ($events as $event): ?>
								<ul class="tabbed-nav-list list-unstyled">
	    						<li class="tabbed-full">
										<a href="{{url('event/'.$event->id)}}"><img src="{{url('events/'.$event->image)}}"></a>
									</li>
								</ul>
							<?php endforeach; ?>
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
