@extends('layouts.master')

@section('title', 'Profile')

@section('content')
@include('errors.errors_message')

<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<!-- /backdrop -->
		<div class="single-column dashboard-wrap">

			  <div id="content" class="boxcontent">
			  	<div class="dash-profile">
						<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{$detailProfile->name}} <sup class="badge">{{getAge($detailProfile)}}</sup></h4>
								<h2 class="label label-success">{{$classDetail->class}}</h2>
								{!!isset($subClassDetail)?'<h2 class="label label-danger">Kelas : '.$subClassDetail->class.'</a>':''!!}
							</div>

							<!--form name="uploadForm" method="post" enctype="multipart/form-data" action="http://localhost/QuranMemo/public/memoz/uploadRecordedMobile/134">
							<p><input id="uploadInput" type="file"  name="file"> </p>
							<p><input type="submit" value="Send file"></p>
							</form-->
							<button class="btn btn-trigger-dashboard" type="button" data-toggle="collapse" data-target="#dashboard-items" aria-expanded="false" aria-controls="dashboard-items">
								<i class="fa fa-angle-up"></i>
							</button>
						</div>
						<!--/dash-profile-detail-->
					</div>
					<!--/dash-profile-detail-wrap -->
					<div class="collapse in" id="dashboard-items">
						<div class="tabbed-nav">
							<ul class="tabbed-nav-list-profile list-unstyled">
								<li class="tabbed-nav-list-item">
									<div class="stats-number">{{$countPoints}}</div>
									<div class="stats-text">Points</div>
								</li>
								<li class="tabbed-nav-list-item" onclick="QuranJS.callModal('memoz/summary/{{$detailProfile->id}}')">
									<div class="stats-number">{{$countMemoz}}</div>
									<div class="stats-text">Hafalan</div>
								</li>
								<!--li class="tabbed-nav-list-item">
									<div class="stats-number">4</div>
									<div class="stats-text">Surat</div>
								</li>
								<li class="tabbed-nav-list-item">
									<div class="stats-number">4</div>
									<div class="stats-text">Points</div>
								</li>
								<li class="tabbed-nav-list-item">
									<div class="stats-number">4</div>
									<div class="stats-text">Mengkoreksi</div>
								</li>
								<li class="tabbed-nav-list-item">
									<div class="stats-number">4</div>
									<div class="stats-text">Dikoreksi</div>
								</li-->
							</ul>
							<br class="clearfix"/>
						</div>
					</div>
			  	</div>
				  <!-- /dash-profile -->
				  <!--div class="ads-middle" onclick="fbq('track', 'clickDonasiFahimQuran');QuranJS.callModal('donasi')"><img src="http://localhost/QuranMemo/public/assets/images/FahimQuran.png">Donasi Pembangunan Pasantren Tahfidz <br>FahimQuran Plus</div-->


						<span class="clear"></span>
				  <div class="timeline-koreksi filter">
				  		<ul class="nav nav-tabs" role="tablist">

						    <li role="presentation" class="active"><a href="#sedanghafalan" aria-controls="hafalan" role="tab" data-toggle="tab">Sedang <br> Menghafal</a></li>
						    <li role="presentation"><a href="#sudahhafal" aria-controls="hafalan" role="tab" data-toggle="tab">Sudah <br> Hafal</a></li>
						    <li role="presentation"><a href="#butuhkoreksi" aria-controls="koreksi" role="tab" data-toggle="tab">Butuh<br> Koreksi</a></li>
						</ul>
						<!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane" id="sudahhafal">
									@if(!empty($listDone))
								<ul class="correction-list list-unstyled">
								@foreach($listDone as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item memoid-{{$row->id_user}}">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<a href="{{url('profile/detail/'.$row->id_user)}}"><img src="{{getAvatar($row)}}"  class="img-circle"></a>
											</div>
											<div class="koreksi-desc">
												<span class="username"><a href="{{url('profile/detail/'.$row->id)}}">{{$row->name}}  <sup class="badge">{{getAge($row)}}</sup></a></span>
												<span class="ayat-target">
													<a class="ayat-target-link"  href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a>
													<!--span class="spacer1">&bullet;</span>
													<span class="jumlah-koreksi"><i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}} koreksi</span-->
												</span>
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
												<div class="koreksi-action">
													<!--a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a-->
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
												</div>
											</div>
											<!--/koreksi-desc-->
										</div>
									</li>
									@endforeach
									</ul>
								@endif
						    </div>
						    <div role="tabpanel" class="tab-pane" id="butuhkoreksi">
									@if(!empty($needCorrections))
									<ul class="correction-list list-unstyled">
									@foreach($needCorrections as $row)
										<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
										<li class="correction-list-item memoid-{{$row->id_user}}">
											<div class="koreksi-box">
												<div class="koreksi-avatar img-circle">
													<a href="{{url('profile/detail/'.$row->id_user)}}"><img src="{{getAvatar($row)}}"  class="img-circle"></a>
												</div>
												<div class="koreksi-desc">
														<a href="{{url('profile/detail/'.$row->id_user)}}"><span class="username">{{$row->name}}
														<sup class="badge">{{getAge($row)}}</sup>

													</span>
												</a>

													<span class="ayat-target">
														<a class="ayat-target-link" href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a>
													</span>
													<br>
													<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}} &bullet; <i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}}
						&bullet;
						<i class="mdi mdi-book-open-variant"></i> {{empty($row->visitor)?0:$row->visitor}}</span>
													<div class="koreksi-action">
														<a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a>
														<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
													</div>
												</div>
												<!--/koreksi-desc-->
											</div>
										</li>
										@endforeach
										</ul>
									@endif
								</div>
						    <div role="tabpanel" class="tab-pane active" id="sedanghafalan">
									@if(!empty($listMemoz))
									<ul class="correction-list list-unstyled">
										@foreach($listMemoz as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item memoid-{{$row->id}}">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<a href="{{url('profile/detail/'.$row->id_user)}}"><img src="{{getAvatar($row)}}"  class="img-circle"></a>
											</div>
											<div class="koreksi-desc">
												<a href="{{url('profile/detail/'.$row->id_user)}}"><span class="username">{{$row->name}}  <sup class="badge">{{getAge($row)}}</sup></span>
												<span class="ayat-target"><a class="ayat-target-link" href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a></span>
											</a>
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
												<div class="koreksi-action">
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
												</div>
											</div>
										</div>
									</li>
									@endforeach
									</ul>
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
$(document).ready(function(){
   	// show promo or not
   	if(''=='yes' && '3'==''){
        QuranJS.callModal('auth/login')
    }else if('hide'!='hide'){
   		//QuranJS.callModal('promo')
   	}

   	$(function() {
   	  $("#recommendation-memoz").dragend();


      $(".nav").click(function() {
        var page = $(event.target).data("page");
        $("#recommendation-memoz").dragend({
          scrollToPage: page
        });

        $(event.target).addClass("active");

      })

    });
});
$('.btn-trigger-dashboard').click(function() {
	$(".fa",this).toggleClass("fa-angle-up fa-angle-down");
});
</script>
        </div>

@endsection
