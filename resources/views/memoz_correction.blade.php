@extends('layouts.master')

@section('title', 'Daftar Santri')

@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content ">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
	<!-- /backdrop -->
		<div class="single-column edit-profile-block" style="background: #FFF">
			<div class="container-fluid">
					<div class="row">
						<div class="edit-profile-block" style="background: #FFFFFF;padding: 20px;min-height: 400px;margin-bottom: 20px">
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
													<sup class='label label-primary'>Paket Ihsan ( {{$daysLeft}} hari ) </sup>
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
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('#date').datepicker({
			format: "yyyy-mm-dd",
			dateFormat: "yyyy-mm-dd",
			altFormat: "yyyy-mm-dd",
			clearBtn: true,
			autoclose: true,
			todayHighlight: true,
			onSelect: function(date) {
				alert(date);

			}
	});

	$('#date').bind('onSelect', function() {alert('a') });

})
</script>

@endsection
