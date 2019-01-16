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
    						<li class="tabbed-full"><img src="{{url('assets/images/flayer/mim.png')}}"></li>
							</ul>
							<ul class="tabbed-nav-list list-unstyled">
								<li class="tabbed-full left event">
									<i class="mdi mdi-pencil"></i> | Muslim Parenting
								</li>
								<li class="tabbed-full left event">
									<i class="mdi mdi-account-circle"></i> | Ustadz Hasan Faruqi
								</li>
								<li class="tabbed-full left event">
									<i class="mdi mdi-calendar"></i> | Sabtu, 1 Jan 2019 16.00 - 18.00
								</li>
								<li class="tabbed-full left event">
									<i class="mdi mdi-map"></i> | Masjid Al-Kautsar Bandung
								</li>
							</ul>
							<ul class="tabbed-nav-list list-unstyled">
	  						<li class="tabbed-full left">
									<iframe style="width:100%;height:300px" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Masjid Al-Kautsar Bandung&amp;key=AIzaSyBI1Pm7HmAYs4MhYJgFO2MfjBMwOrYWtJE" allowfullscreen="">Memuat peta..</iframe>
								</li>
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
<div class="action_footer">
	<a class="btn btn-primary" href="https://www.google.com/maps?q=Al%20Kautsar%20Mosque%20bandung" target="_blank" ><i class="mdi mdi-directions"></i> Arah Lokasi</a>
	<a class="btn btn-success" href="javascript:void()" onclick="QuranJS.callModal('event/join/10')"><i class="mdi mdi-calendar-check"></i> Hadir</a>
</div>
@endsection
