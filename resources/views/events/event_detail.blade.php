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
    						<li class="tabbed-full"><br> <img src="http://localhost/QuranMemo/public/assets/images/partners/tafaqquh.png"></li>
							</ul>

						<ul class="tabbed-nav-list list-unstyled">
  						<li class="tabbed-full left">Map</li>
						</ul>
						<ul class="tabbed-nav-list list-unstyled">

							<li class="tabbed-full left"><label>Judul Kajian : </label>Muslim Parenting</li>
							<li class="tabbed-full left"><label>Pemateri :</label>Ustadz Hasan Faruqi</li>
							<li class="tabbed-full left"><label>Waktu : </label>Senin, 10 Januari 2019</li>
							<li class="tabbed-full left"><label>Tempat : </label>Masjid TSB</li>
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
	<button class="btn btn-danger" onclick="QuranJS.callModal('event/absent/10')">Hadir</button>
</div>
@endsection
