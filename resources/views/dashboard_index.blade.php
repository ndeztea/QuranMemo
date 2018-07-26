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
			<!--div class="ads-middle" style="background: #ffffff;color: #000;" onclick="fbq('track', 'clickUmrohSutanFatih');QuranJS.callModal('umroh')"><img src="{{url('assets/images/sutanfatih_logo.png')}}">Umroh Murah Sutan Fatih Tour and Travel<br> <span style="font-size: 17px"><strong>Mulai dari 18,5jt!</strong></span></div-->
			<div class="ads-middle" style="background: #ffffff;color: #000;" onclick="fbq('track', 'clickPromoTShirtWomb');QuranJS.callModal('promo');"><label class="label label-danger">New</label> Promo T-Shirt QuranMemo<br> <span style="font-size: 17px"><strong>Tema Womb</strong> </span></div>
			  <div id="content" class="boxcontent">
			  	<div class="dash-profile">

			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{session('sess_name')?session('sess_name'):'Tamu'}}</h4>
								@foreach($listSubscriptions as $subscription)
								<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
								<span class='label label-primary'>Paket {{ucfirst($level[$subscription->level])}} ( {{$daysLeft}} hari )</span>
								@endforeach
							</div>
							<!--form name="uploadForm" method="post" enctype="multipart/form-data" action="{{url('memoz/uploadRecordedMobile/134')}}">
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
							<ul class="tabbed-nav-list list-unstyled">
							<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan');@if(!empty(session('sess_id'))) location.href='{{url('memoz')}}' @else QuranJS.callModal('auth/login') @endif" ><i class="mdi mdi-file"></i>Hafalan Baru</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan');@if(!empty(session('sess_id'))) QuranJS.memozList() @else QuranJS.callModal('auth/login') @endif" ><i class="mdi mdi-library"></i>Daftar Hafalan</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickKoreksi');@if(!empty(session('sess_id'))) QuranJS.correctionList('','') @else QuranJS.callModal('auth/login') @endif"><i class="mdi mdi-checkbox-multiple-marked-circle"></i> Koreksi <sup class="text-white label label-danger">{{$counterCorrection>0?$counterCorrection.' new ':''}}</sup></a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" onclick="fbq('track', 'clickSummaryTarget');@if(!empty(session('sess_id'))) QuranJS.callModal('memoz/summary') @else QuranJS.callModal('auth/login') @endif"><i class="mdi mdi-target"></i> Statistik</a></li>
								
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)"onclick="fbq('track', 'clickBaca');QuranJS.bookmarkModal('{{@$_COOKIE['coo_mushaf_bookmark_title']}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')"><i class="mdi mdi-book-open-variant"></i>Baca </a></li>
								
								<!--li class="tabbed-nav-list-item"><a class="tabbed-nav-link" onclick="fbq('track', 'clickJuz');QuranJS.callModal('mushaf/juz')" ><i class="mdi mdi-bookmark"></i> Pilih Juz</a></li-->
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickEditProfile');@if(!empty(session('sess_id'))) location.href='{{url('profile/edit')}}' @else QuranJS.callModal('auth/login') @endif"><i class="mdi mdi-account-edit"></i>Edit Profile</a></li>
								

							</ul>
						</div>
					</div>
			  	</div>
				  <!-- /dash-profile -->
				  <div class="ads-middle" onclick="fbq('track', 'clickDonasiFahimQuran');QuranJS.callModal('donasi')"><img src="{{url('assets/images/FahimQuran.png')}}">Donasi Pembangunan Pasantren Tahfidz <br>FahimQuran Plus</div>
						<span class="clear"></span>
				  <div class="timeline-koreksi filter">
				  		<ul class="nav nav-tabs" role="tablist">

						    <li role="presentation"  class="active"><a href="#sedanghafalan" aria-controls="hafalan" role="tab" data-toggle="tab">Sedang <br> Menghafal</a></li>
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
									<li class="correction-list-item memoid-{{$row->id}}"">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<img src="{{getAvatar($row)}}"  class="img-circle">
											</div>
											<div class="koreksi-desc">
												<span class="username">{{$row->name}}  <sup class="badge">{{getAge($row)}}</sup></span>
												<span class="ayat-target">
													<a class="ayat-target-link" href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a>
													<!--span class="spacer1">&bullet;</span> 
													<span class="jumlah-koreksi"><i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}} koreksi</span-->
												</span>
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
												<div class="koreksi-action">
													<!--a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a-->
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
												</div>
											</div>
											<!--/koreksi-desc-->
										</div>
									</li>
									@endforeach
									</ul>
									<a class="btn-green btn" href="javascript:void(0)" onclick="fbq('track', 'clickMemozLain');@if(!empty(session('sess_id'))) QuranJS.memozOthers(1,'')  @else QuranJS.callModal('auth/login') @endif">Lainnya</a>
								@endif
						    </div>
						    <div role="tabpanel" class="tab-pane" id="butuhkoreksi">
						    	@if(!empty($needCorrections))
								<ul class="correction-list list-unstyled">
								@foreach($needCorrections as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item memoid-{{$row->id}}">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<img src="{{getAvatar($row)}}"  class="img-circle">
											</div>
											<div class="koreksi-desc">
												<span class="username">{{$row->name}} 
													<sup class="badge">{{getAge($row)}}</sup>
													@if(session('sess_role')==1 || session('sess_role')==2)
														@foreach($row->listSubscriptions as $subscription)
														<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
														<sup class='label label-primary'>Paket {{ucfirst($level[$subscription->level])}} ( {{$daysLeft}} hari ) </sup>
														@endforeach
													@endif
												</span>
												
												<span class="ayat-target">
													<a class="ayat-target-link" href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}">{{$row->surah}} : {{$ayat_target}}</a>
													<span class="spacer1">&bullet;</span> 
													<span class="jumlah-koreksi"><i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}} koreksi</span>
												</span>
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
												<div class="koreksi-action">
													<a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a>
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
												</div>
											</div>
											<!--/koreksi-desc-->
										</div>
									</li>
									@endforeach
									</ul>
									<a class="btn-green btn" href="javascript:void(0)" onclick="fbq('track', 'clickMemozLain');@if(!empty(session('sess_id'))) QuranJS.needCorrections(0)  @else QuranJS.callModal('auth/login') @endif">Lainnya</a>
								@endif
						    </div>
						    <div role="tabpanel" class="tab-pane active" id="sedanghafalan">
						    	@if(!empty($listMemoz))
									<ul class="correction-list list-unstyled">
										@foreach($listMemoz as $row)
									<?php $ayat_target = $row->ayat_end==0?$row->ayat_start:$row->ayat_start.'-'.$row->ayat_end?>
									<li class="correction-list-item memoid-{{$row->id}}"">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<img src="{{getAvatar($row)}}"  class="img-circle">
											</div>
											<div class="koreksi-desc">
												<span class="username">{{$row->name}}  <sup class="badge">{{getAge($row)}}</sup></span>
												<span class="ayat-target"><a class="ayat-target-link" href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a></span>	
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}}</span>
												<div class="koreksi-action">
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
												</div>
											</div>
										</div>
									</li>
									@endforeach
									</ul>
									<a href="javascript:void(0)" class="btn-green btn" onclick="fbq('track', 'clickHafalanLain');@if(!empty(session('sess_id'))) QuranJS.memozOthers('','')  @else QuranJS.callModal('auth/login') @endif ">Lainnya</a>
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
   	if('{{$starting}}'=='yes' && '{{session('sess_id')}}'==''){
        QuranJS.callModal('auth/login')
    }else if('{{@$_GET['promo']}}'!='hide'){
   		QuranJS.callModal('promo')
   	}
});
$('.btn-trigger-dashboard').click(function() {
	$(".fa",this).toggleClass("fa-angle-up fa-angle-down");
});
</script>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection