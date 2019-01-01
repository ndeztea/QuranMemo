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
    					<ul class="tabbed-nav-list list-unstyled two-row">
    						<li class="tabbed-full"><img src="{{url('assets/images/flayer/mim.png')}}"></li>
								<li class="tabbed-full"><img src="{{url('assets/images/flayer/mim.png')}}"></li>
								<li class="tabbed-full"><img src="{{url('assets/images/flayer/mim.png')}}"></li>
								<li class="tabbed-full"><img src="{{url('assets/images/flayer/mim.png')}}"></li>
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
