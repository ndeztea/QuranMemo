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
					<div class="dash-profile">
						<!--div class="ads-middle" style="background-color: #54b7ac;">
														<strong>Belum ada kelas</strong>
													</div-->
			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="http://localhost/QuranMemo/public/assets/images/avatar/guest.png">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">Tamu</h4>
							</div>

							<button class="btn btn-trigger-dashboard" type="button" data-toggle="collapse" data-target="#dashboard-items" aria-expanded="false" aria-controls="dashboard-items">
								<i class="fa fa-angle-up"></i>
							</button>
						</div>
						<!--/dash-profile-detail-->
					</div>
					<!--/dash-profile-detail-wrap -->
					<div class="collapse in" id="dashboard-items">
						<div class="tabbed-nav">
    					<ul class="tabbed-nav-list list-unstyled">
    						<li class="tabbed-full">Kode Voucher <br> <strong>1234539</strong></li>
							</ul>
							<ul class="tabbed-nav-list list-unstyled">
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="location.href='{{url('event/kssm')}}'"><i class="mdi mdi-calendar-check"></i>KSSM</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarMurajaah'); QuranJS.callModal('auth/login') "><i class="mdi mdi-calendar"></i>Kajian<sup class="text-white label label-danger"></sup></a>  </li>
						    <li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarMurajaah'); QuranJS.callModal('auth/login') "><i class="mdi mdi-cash-100"></i>Donasi<sup class="text-white label label-danger"></sup></a>  </li>
						    <li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarMurajaah'); QuranJS.callModal('auth/login') "><i class="mdi mdi-book-open"></i>Baca Al-Qur'an<sup class="text-white label label-danger"></sup></a>  </li>
						    <li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan'); QuranJS.callModal('auth/login') "><i class="mdi mdi-library"></i>Tahfidz</a>  </li>
						    <li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan'); QuranJS.callModal('auth/login') "><i class="mdi mdi-video"></i>Media</a>  </li>
							</ul>



							</div>
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
