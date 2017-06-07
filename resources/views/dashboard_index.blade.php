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
		<div class="single-column dashboard-wrap">
			<!--div class="page-title">
				<h2>Dashboard</h2>
			</div-->

			  <div id="content" class="boxcontent">
			  	<div class="dash-profile">

			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail"  style="background: url('http://localhost/QuranNote/public/assets/images/dzuhur.jpg')">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{session('sess_name')}} <sup><i class="fa fa-certificate"><span>P</span></i></sup></h4>
								<span class='qm-badge'>Level Muqamah</span>
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

								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="QuranJS.memozList()"><i class="mdi mdi-library"></i>Menghafal</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)"onclick="QuranJS.bookmarkModal('{{@$_COOKIE['coo_mushaf_bookmark_title']}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')"><i class="mdi mdi-book-open-variant"></i>Baca</a></li>
								
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" onclick="QuranJS.callModal('mushaf/juz')" ><i class="mdi mdi-bookmark"></i> Pilih Juz</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" onclick="QuranJS.callModal('memoz/summary')"><i class="mdi mdi-target"></i> Summary Target</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="QuranJS.correctionList()"><i class="mdi mdi-checkbox-multiple-marked-circle"></i> Koreksi <sup class="text-white">New</sup></a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="{{url('profile/edit')}}"><i class="mdi mdi-account-edit"></i>Edit Profile</a></li>
								

							</ul>
						</div>
					</div>
			  	</div>
				  <!-- /dash-profile -->
				  <div class="timeline-koreksi filter">
				  		<ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#koreksi" aria-controls="koreksi" role="tab" data-toggle="tab">Timeline Koreksi</a></li>
						    <li role="presentation"><a href="#hafalan" aria-controls="hafalan" role="tab" data-toggle="tab">Sedang menghafal</a></li>
						</ul>
						<!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="koreksi">
						    	@if(!empty($needCorrections))
							<ul class="correction-list list-unstyled">
								@foreach($needCorrections as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<img src="{{getAvatar($row)}}"  class="img-circle">
											</div>
											<div class="koreksi-desc">
												<span class="username">{{$row->name}}</span>
												<span class="ayat-target"><a href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a></span>
												<span class="spacer1">&bullet;</span> <i class="fa fa-commenting"> {{empty($row->count_correction)?0:$row->count_correction}} koreksi</i>
											</div>
											<!--/koreksi-desc-->
										</div>
									</li>
									@endforeach
									</ul>
									<a class="btn-green btn" href="javascript:void(0)" onclick="QuranJS.needCorrections(0)">Lainnya</a>
								@endif
						    </div>
						    <div role="tabpanel" class="tab-pane" id="hafalan">
						    	@if(!empty($listMemoz))
									<ul class="correction-list list-unstyled">
										@foreach($listMemoz as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<img src="{{getAvatar($row)}}"  class="img-circle">
											</div>
											<div class="koreksi-desc">
												<span class="username">{{$row->name}}</span>
												<span class="ayat-target"><a href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a></span>
											</div>
										</div>
									</li>
									@endforeach
									</ul>
									<a href="javascript:void(0)" class="btn-green btn" onclick="QuranJS.memozOthers()">Lainnya</a>
								@endif
						    </div>
						  </div>
			  	
			  </div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->	
	</div>
<!-- end main main-content-wrap -->	
</div>
<script>
$('.btn-trigger-dashboard').click(function() {

    $(".fa",this).toggleClass("fa-angle-up fa-angle-down");
});
</script>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection