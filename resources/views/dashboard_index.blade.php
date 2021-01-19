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
			<!--div class="ads-middle" style="background: #ffffff;color: #000;" target="_blank">
				<label class="label label-danger">Promo</label><a href="https://api.whatsapp.com/send?phone=6285956331813" target="_blank"> Akses semua konten gratis <label class="label label-danger">Promo</label><br> <span style="font-size: 17px"><strong>Japri via WA  <i style="font-size: 14px" class="fa fa fa-whatsapp"></i> 085956331813</strong></span></a>
			</div-->

			  <div id="content" class="boxcontent">
			  	<div class="dash-profile">
						<div class="ads-middle">
							@if(session('sess_id'))
							<div class="dropdown">
								<button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;min-width: 300px;background: none;border: 0px;font-weight: bold;">
									{{empty($classDetail->class)?'Pilih Kelas  Halaqah':$classDetail->class}}
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu choose-class" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px">
									@foreach($listClasses as $class)
									<li><a href="{{$class->lock_key?'javascript:QuranJS.callModal("dashboard/confirmClass?id_class='.$class->id.'")':url('dashboard/setClass?id_class='.$class->id)}}">{{$class->class}} {!!$class->lock_key?'<i style="color:#ff8b33" class="mdi mdi-octagram"></i>':''!!}</a></li>
									@endforeach
								</ul>
							</div>
							@else
							<strong>{{!empty($classDetail)?$classDetail->class:'Belum ada kelas'}}</strong>
							@endif
						</div>
			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{session('sess_name')?session('sess_name'):'Tamu'}}</h4>
								@foreach($listSubscriptions as $subscription)
								<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
								<span class='label label-primary'><!--Paket {{ucfirst($level[$subscription->level])}}--> Santri Aktif ( {{$daysLeft}} hari )</span>
								@endforeach
								@if(session('sess_id_class') && !empty($subClassDetail))
								<h2 class='label label-danger'>Kelas : {{$subClassDetail->class}}</h2>
								@endif
								@if(session('sess_name'))
								<h2 class='label label-success'>Points : {{$total_points}}</h2>
								@endif

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
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan');@if(!empty(session('sess_id'))) location.href='{{url('memoz')}}' @else QuranJS.callModal('auth/login') @endif" ><i class="mdi mdi-file"></i>Ziyadah</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarhafalan');@if(!empty(session('sess_id'))) QuranJS.memozList() @else QuranJS.callModal('auth/login') @endif" ><i class="mdi mdi-library"></i>Hafalan</a>  </li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="javascript:void(0)" onclick="fbq('track', 'clickDaftarMurajaah');@if(!empty(session('sess_id'))) QuranJS.callModal('memoz/murajaah') @else QuranJS.callModal('auth/login') @endif" ><i class="mdi mdi-refresh"></i>Muraja'ah <sup class="text-white label label-danger">{{$counterMurajaah>0?$counterMurajaah:''}}</sup></a>  </li>
								<li  class="tabbed-nav-list-item"><a class="tabbed-nav-link"  href="javascript:;" onclick="@if(!empty(session('sess_id'))) QuranJS.callModal('quiz/form') @else QuranJS.callModal('auth/login') @endif;fbq('track', 'clickQuizForm')"><i class="mdi mdi-help-circle"></i> Quiz</a></li>
								<li class="tabbed-nav-list-item quran-menu">
									<a class="tabbed-nav-link" href="javascript:void(0)"onclick="fbq('track', 'clickBaca');QuranJS.bookmarkModal('{{addslashes(@$_COOKIE['coo_mushaf_bookmark_title'])}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')">
										<i class="mdi mdi-book-open-variant"></i>Al-Qur'an
										@if(@$_COOKIE['coo_mushaf_bookmark_title'])
										<i class="mdi mdi-bookmark bookmark-sign-menu"></i>
										@endif
									</a>
								</li>
								<li  class="tabbed-nav-list-item"><a class="tabbed-nav-link"  href="{{url('content_learning')}}" ><i class="mdi mdi-image-filter-drama"></i> E-Learning</a></li>
								<li  class="tabbed-nav-list-item"><a class="tabbed-nav-link"  href="{{url('profile/top_user')}}" ><i class="mdi mdi-account-network"></i> Top Santri</a></li>
								<li  class="tabbed-nav-list-item"><a class="tabbed-nav-link"  href="javascript:;" onclick="@if(!empty(session('sess_id'))) QuranJS.callModal('memoz/summary') @else QuranJS.callModal('auth/login') @endif;fbq('track', 'clickQuizForm')"><i class="mdi mdi-target"></i> Pencapaian</a></li>
								<li class="tabbed-nav-list-item"><a class="tabbed-nav-link" href="{{url('todo')}}"><i class="mdi mdi-calendar-check"></i> AmalanYaumi</a></li>
								<li class="tabbed-nav-list-item">
									<a class="tabbed-nav-link" href="{{url('quran/mapping')}}"><i class="mdi mdi-map"></i> Quran Mapping
									<sup class="text-white label label-danger">New</sup>
								</a>

								<!--li class="tabbed-nav-list-item">
									<a class="tabbed-nav-link" href="{{url('dzikir')}}"><i class="mdi mdi-clock"></i> Al-Matsurats
									<sup class="text-white label label-danger">New</sup>
								</a-->
								@if((session('sess_role')==1 || session('sess_role')==2) && (session('sess_id_sub_class')))
                  <li class="tabbed-nav-list-item" style="background-color:#ffdbdb;color:#000">
                      <a style="color:#000"  class="tabbed-nav-link" href="<?php echo url('profile/list')?>"><i class="mdi mdi-file-document" ></i> Laporan</a>

								</li>
								@endif
								@if(session('sess_role')==1 || session('sess_role')==2)
								<li  class="tabbed-nav-list-item" style="background-color:#ffdbdb;"><a style="color:#000" class="tabbed-nav-link" href="{{url('memoz/correction_ihsan')}}"><i class="mdi mdi-arrow-up-box"></i> Koreksi Ihsan</a></li>
								@endif

							</ul>
						</div>
					</div>
			  	</div>
				  <!-- /dash-profile -->

					<div class="ads-middle" style="background: #ffffff;color: #000;" >
						<a  href="https://arrayahstore.com/chat/wa-aplikasi/" target="_blank">
							<img src="{{url('assets/images/gabung.png')}}" style="width: 91%;clear: both;float: none;"/>
						</a>
					</div>
					<br>
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
									<li class="correction-list-item memoid-{{$row->id_user}}">
										<div class="koreksi-box">
											<div class="koreksi-avatar img-circle">
												<a href="{{url('profile/detail/'.$row->id_user)}}"><img src="{{getAvatar($row)}}"  class="img-circle"></a>
											</div>
											<div class="koreksi-desc">
												<span class="username"><a href="{{url('profile/detail/'.$row->id_user)}}">{{$row->name}}  <sup class="badge">{{getAge($row)}}</sup></a></span>
												<span class="ayat-target">
													<a class="ayat-target-link" href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a>
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
									<a class="btn-green btn" href="javascript:void(0)" onclick="fbq('track', 'clickMemozLain');@if(!empty(session('sess_id'))) QuranJS.memozOthers(1,'')  @else QuranJS.callModal('auth/login') @endif">Lainnya</a>
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
													@if(session('sess_role')==1 || session('sess_role')==2)
														@foreach($row->listSubscriptions as $subscription)
														<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
														<sup class='label label-primary'>Paket {{ucfirst($level[$subscription->level])}} ( {{$daysLeft}} hari ) </sup>
														@endforeach
													@endif
												</span>
											</a>

												<span class="ayat-target">
													<a class="ayat-target-link" href="javascript:void(0)">{{$row->surah}} : {{$ayat_target}}</a>
												</span>
												<br>
												<span class="jumlah-koreksi">{{Carbon::createFromTimeStamp((strtotime($row->updated_at)))->diffForHumans()}} &bullet; <i class="fa fa-commenting"></i> {{empty($row->count_correction)?0:$row->count_correction}}
					&bullet;
					<i class="mdi mdi-book-open-variant"></i> {{empty($row->visitor)?0:$row->visitor}}</span>
												<div class="koreksi-action">
													@if(session('sess_role')==1 || session('sess_role')==2)
														<a  href="{{url('memoz/correction/'.$row->surah_start.'/'.$ayat_target.'/'.$row->id)}}" class="koreksi-action-link" onclick="fbq('track', 'clickKoreksi');">Koreksi</a>
													@endif
													<a  href="{{url('memoz/surah/'.$row->surah_start.'/'.$ayat_target)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a>
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
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/dragend.min.js')}}"></script>

@endsection
