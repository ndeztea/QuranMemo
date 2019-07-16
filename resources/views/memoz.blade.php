<script>
	location.href = 'https://play.google.com/store/apps/details?id=com.ndeztea.quranmemocommunity'
</script>
@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = $tempCountSpaces = $countSpaces = '';  ?>
@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<!-- /backdrop -->
		<div class="single-column">
			<!--div class="page-title">
				<h1 class="pull-left">Menghafal</h1>
				@if(empty($_SERVER['HTTP_X_REQUESTED_WITH']))
    			<a class="pull-right gp-link" target="_blank"  href="https://play.google.com/store/apps/details?id=com.ndeztea.quranmemo"><img src="{{url('assets/images/button-google-play.png')}}"  alt="Download di Google Play" width="150"></a>
    			@endif

			</div-->

			@if (empty($ayats))
			<div class="nav-top clearfix">
				<div style="display:{{!empty($ayats)?'none':''}}">
					<div class="select-surah">
						<form class="form-inline" action="<?php echo url('memoz/search')?>" method="post">
								<!--span class="search-title">Surah</span-->
								<div class="form-group">
									<select name="surah_start"  id="surah_start" class="form-control surah_start_temp">
										@foreach($surahs as $surah)
										<option {{$surah->id==$surah_start?'selected':''}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}} {{$surah->ayat}} ayat)</option>
										@endforeach
									</select>
								</div>
								<div class="form-group display-inline-block-xs">
									<div class="input-group memoz-form">
									  <input class="form-control search_ayat ayat_start_temp" id="ayat_start"  name="ayat_start" placeholder="Ayat" aria-label="Ayat"  value="{{$ayat_start?$ayat_start:''}}">
									  <span class="input-group-addon">Sampai Ayat</span>
									  <input class="form-control search_ayat ayat_end_temp" id="ayat_end"  name="ayat_end" id="ayat_end" placeholder="Ayat" aria-label="Ayat"  value="{{$ayat_end?$ayat_end:''}}">
									</div>
								</div>
								<a class="btn btn-cari-ayat" onclick="@if(!empty(session('sess_id'))) QuranJS.submitMemoz('{{$level}}') @else QuranJS.callModal('auth/login') @endif" href="javascript:void(0)"  style="width: 100% !important"><i class="fa fa-search"></i> Hafalkan Ayat</a>

								@if(session('sess_id'))
								<a class="btn btn-cari-ayat btn-last-memoz" onclick="fbq('track', 'clickDaftarHafalanPage');QuranJS.memozList()" href="javascript:void(0)" style="width: 49% !important"><i class="fa fa-file-text"></i> Daftar Hafalan</a>
									@if(session('sess_role')==1 || session('sess_role')==2 || session('sess_id')==$memoDetail->id_user)
									<a class="btn btn-cari-ayat btn-last-memoz" onclick="fbq('track', 'clickDaftarKoreksiPage');QuranJS.correctionList('','')" href="javascript:void(0)"  style="width: 49% !important"><i class="fa fa-check-squarequare-o"></i> Daftar Koreksi</a>
									@endif
								@endif
						</form>
					</div>
				</div>
			</div>
			@else
			<input type="hidden" class="surah_start_temp" value="{{$surah_start}}"/>
			<input type="hidden" class="ayat_start_temp" value="{{$ayat_start}}"/>
			<input type="hidden" class="ayat_end_temp" value="{{$ayat_end}}"/>
			@endif
			@if(!empty($memoDetail->id) && ($memoDetail->id_user == session('sess_id') || (session('sess_role')==1 || session('sess_role'))==2))
				<div class="nav-top clearfix">
					@if($memoDetail->id_user == session('sess_id'))
						@if($murajaahSection)
							<a class="btn" href="javascript:;" onclick="fbq('track', 'clickMurajaahSelesai');QuranJS.updateStatusMemoz('{{$memoDetail->id}}','3','Murajaah sudah selesai?')"><i class="fa fa-cog fa-spin fa-3x fa-fw label-status-loading " style="display:none"></i> <i class="fa fa-check-square"></i></i> Selesai</a>
							@if($linkNextMurajaah!='')
								<a class="btn" href="{{$linkNextMurajaah}}"><i class="fa fa-step-forward"></i></i> Selanjutnya</a>
							@endif
						@else

						<div class="dropdown">
			              <button class="dropdown-toggle status_memoz" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Status : <span class="text_status_memoz">{{$text_status}}</span>
			                <span class="caret"></span>
			              </button>
			              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px;font-size: 24px">
			              	<li><a  href="javascript:;" onclick="fbq('track', 'clickBelumHafal');QuranJS.updateStatusMemoz('{{$memoDetail->id}}','0','Target hafalan ini belum hafal?')"><i class="mdi mdi-lightbulb-outline"></i> Belum hafal</a>
			              	</li>
			              	@if(!empty($memoDetail->record))
			              	<li><a  href="javascript:;" onclick="fbq('track', 'clickButuhKoreksi');QuranJS.updateStatusMemoz('{{$memoDetail->id}}','2','Pastikan kualitas rekaman bagus untuk memudahkan asatidz kami mengkoreksi hafalanmu, setor hafalan sekarang?')"><i class="mdi mdi-send"></i> Setorkan hafalan</a>
			              	</li>
			              	@endif
			              	<li><a  href="javascript:;" onclick="fbq('track', 'clickSudahHafal');QuranJS.updateStatusMemoz('{{$memoDetail->id}}','1','Target hafalan ini sudah hafal?')"><i class="mdi mdi-lightbulb-on "></i> Sudah hafal</a>
			              	</li>
			              </ul>
			            </div>

						@endif
					@endif
					<!--a  href="javascript:void(0)" class="btn" style="font-weight: bold"><i class="mdi mdi-library"></i> {{$memoDetail->id}}</a-->
					<i class="fa fa-cog fa-spin fa-3x fa-fw label-status-loading " style="display:none"></i>
					@if(!empty($memoDetail->id) && (session('sess_role')==1 || session('sess_role')==2 || session('sess_id')==$memoDetail->id_user))
					<a onclick="fbq('track', 'clickDaftarKoreksiMemoz');QuranJS.correctionList('','{{$memoDetail->id}}')" href="javascript:void(0)" class="btn"><i class="fa fa-check-square-o"></i> Daftar koreksi</a>
					@endif
					@if (!empty($memoDetail->record) && (Request::segment(2)!='correction'))
					<div class="player">
						<audio  controls  controlsList="nodownload" src="@if(!empty($memoDetail->record)){{ @url($memoDetail->record)}} @endif" class="@if(empty($memoDetail->record)) disabled @endif" id="audio"></audio>
					</div>
					@endif
				</div>
			@endif
			<input type="hidden" name="repeat" class="repeat" value="1" />
			<input type="hidden" name="muratal" class="muratal" value="1" />
			<input type="hidden" name="tajwid" class="tajwid" value=""/>


			<!-- /nav-top -->
			<input type="hidden" name="puzzle_ayat" id="puzzle_ayat" value="">
			<input type="hidden" name="puzzle_word" id="puzzle_word" value="">
			@if(!empty($ayats))
			<div class="">
				<div class="">
					<div class="">
						<div class="mushaf mushaf-hafalan">
							@if(session('sess_id') && !empty($ayats) && Request::segment(2)!='correction')
							<div class="clearfix"></div>
							<div class="timeline-koreksi memoz-filter filter">
						  		<ul class="nav nav-tabs" role="tablist">
								    <li role="presentation" class="active"><a  onclick="fbq('track', 'clickLinier');QuranJS.stepMemoz('1',this);"><i class="fa fa-chevron-circle-right"></i> Linier</a></li>
								    <li role="presentation" ><a  onclick="fbq('track', 'clickRekam');optionsRecord()" style="color:red"><i class="fa fa-microphone"></i>  Rekam</a></li>
								    <li role="presentation"><a  onclick="fbq('track', 'clickPuzzle');QuranJS.stepMemoz('5',this);" ><i class="fa fa-puzzle-piece"></i> Puzzle</a></li>
								</ul>
							</div>
							@endif
							<div class="clearfix surah_title head_surah_1 center">{{$header_title}}</div>
							@if(Request::segment(2)!='correction')
							<div class="step-wrap">
								<div class="steps clearfix btn-group btn-breadcrumb" role="group" aria-label="steps">
									<a href="javascript:void(0)" onclick="fbq('track', 'clickStep1');QuranJS.stepMemoz('1','')" class="btn btn-default steps_1 selected"># 1</a>
									<a href="javascript:void(0)" onclick="fbq('track', 'clickStep2');QuranJS.stepMemoz('2','')" class="btn btn-default steps_2"># 2</a>
									<a href="javascript:void(0)" onclick="fbq('track', 'clickStep3');QuranJS.stepMemoz('3','')" class="btn btn-default steps_3"># 3</a>
									<!--a href="javascript:void(0)" onclick="QuranJS.stepMemoz('4');QuranJS.showAyat('start')" class="btn btn-default steps_4"># 4</a>
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('5');" class="btn btn-default steps_5"># 5</a-->
								</div>
							</div>

							<!-- /step-wrap -->
							<!--div class="pull-right hafalan-actions">
								<button class="btn"  data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('memoz/create')">Simpan Hafalan</button>
								<button class="btn btn-success">Sudah Hafal</button>
							</div-->
							<!-- /hafalan-actions -->
							<div class="clearfix"></div>
							<div class="steps_desc">
								<div class="alert alert-success">
									<p> Hafalkan dengan teliti target hafalan arabic dan terjemahannya, ulangi muratal sebanyak-banyaknya sampai hafal</p>
								</div>
							</div>
							<div class="memoz_nav">
								<a href="javascript:;" class="btn btn-start" onclick="fbq('track', 'clickBacaAwal');QuranJS.showAyat('start')">Awal</a>
								<a href="javascript:;" class="btn btn-middle" onclick="fbq('track', 'clickBacaTengah');QuranJS.showAyat('middle')">Tengah</a>
								<a href="javascript:;" class="btn btn-end" onclick="fbq('track', 'clickBacaAkhir');QuranJS.showAyat('end')">Akhir</a>
								<a href="javascript:;" class="btn btn-mix" onclick="fbq('track', 'clickBacaAwalAkhir');QuranJS.showAyat('mix')">Awal+Akhir</a>
								<a href="javascript:;" class="btn btn-random" onclick="fbq('track', 'clickAcak');QuranJS.showAyat('random')">Acak</a>
							</div>
							@else

								@if(!empty($correctionDetail))
								<div class="correction-detail">
									<div class="koreksi-avatar img-circle">
										<img src="{{getAvatar($userCorrector)}}"  class="img-circle">
									</div>
									<span>{{$userCorrector->name}} </span>
									<br>
									<span><i class="mdi mdi-clock"></i> {{Carbon::createFromTimeStamp((strtotime($correctionDetail->date_updated)))->diffForHumans()}}</span>
									@if($correctionDetail->status_memoz_correction===0 || $correctionDetail->status_memoz_correction>1)
									<span class="status_memoz_result">
										{!! memoz_status_result($correctionDetail->status_memoz_correction) !!}
									</span>
									<div class="status_memoz clearfix" style="text-align: center;font-size:18px">
										{{$correctionDetail->points}} Points
									</div>
									@endif
									<br class="clearfix">
									<p> {{$correctionDetail->note}}</p>

									@if($correctionDetail->record_file)
									<audio  style="width:100%" controls controlsList="nodownload" src="{{url($correctionDetail->record_file)}}"></audio>
									@endif
								</div>
								@else
								<div class="correction-detail">
									<!--strong>Nama Penghafal :</strong><br-->
									<div class="koreksi-avatar img-circle">
										<img src="{{getAvatar($userMemoz)}}"  class="img-circle">
									</div>
									<span>{{$userMemoz->name}} </span>
									@if(session('sess_role')>0)
										@foreach($listSubscriptions as $subscription)
										<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($subscription->expired_date)),false)?>
										<span class='label label-primary'>Paket {{ucfirst($levelArr[$subscription->level])}} ( {{$daysLeft}} hari )</span>
										@endforeach
									@endif
									<br>
									<span><i class="mdi mdi-clock"></i> {{Carbon::createFromTimeStamp((strtotime($memoDetail->updated_at)))->diffForHumans()}}</span>
									<br class="clearfix">
									<p> Dengarkan rekaman, dan bandingkan dengan ayat-ayat hafalan apakah betul atau salah, jika ada ayat yang salah klik ayatnya, dan kirimkan koreksi ke penghafal dengan catatan yang diperlukan.</p>
									</div>
								@endif



							@endif
							<script>
								QuranJS.totalAyat = {{count($ayats)}}
							</script>

							<?php  $a=0; ?>
							@foreach($ayats as $ayat)
							@if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) || ($ayat->surah==1 && $ayat->ayat==1))
							<a name="head_surah_{{$ayat->surah}}"></a>
							<div class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_0 play_0 surah_title head_surah_{{$ayat->surah}}"  >
								<div class="surah_name">
									<strong>{{$ayat->surah}}. Surah {{$ayat->surah_name}}</strong><br/>
									<small>{{$ayat->type}} ( turun  #{{$ayat->order}} ) | {{$ayat->count_ayat}} ayat </small>
								</div>
								@if(($ayat->surah!=1 || $ayat->ayat!=1))
									@if($ayat->surah!=9)
									<div class="head_surah" >
									بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
									</div>
									<script>QuranJS.headSurah=1;</script>
									<?php endif?>
								@else
								<?php $a++; ?>
								@endif
								<div class="clearfix"></div>
							</div>
							<!-- /ayat-section -->
							<?php $a++;?>
							@endif

							@if($ayat->surah==1 && $ayat->ayat==1)
							<?php $a--;?>
							@endif

							<div class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_{{$ayat->ayat}}">
								@if($a!=0)
								<div id="play_{{$a}}"></div>
								@endif
								<div class="arabic arabic_{{$a}}">

									<span class="content_ayat clearfix">
										<?php $arr_ayats = (explode(' ', trim($ayat->text)));$per=0;
										$countSpaces = count($arr_ayats);
										?>
										<script>
											QuranJS.totalAyatSpaces[{{$a}}] = {{$countSpaces}}
										</script>
										@foreach($arr_ayats as $per_ayat)
											<?php $per++;?>
											<span class="puzzle_border puzzle_no_border">
												<span class="ayat_arabic ayat_arabic_memoz per_words_<?php echo $per?> @if(isset($correctionDetail->correction)) @if(in_array('.arabic_'.$a.' .per_words_'.$per.'',$correctionDetail->correction)) wrong @endif @endif" onclick="QuranJS.correctionMemoz('{{$a}}','{{$per}}')"  data-css=".arabic_{{$a}} .per_words_{{$per}}">{{$per_ayat}}</span>
											</span>
										@endforeach

										<span class="no_ayat_arabic">
											<!--img src="{{url('assets/images/frame-ayat.png')}}"  alt="ayat"-->
											<span>{{arabicNum($ayat->ayat)}}</span>
										</span>
									</span>

								</div>
								<!-- PUZZLE -->
								<div class="puzzle puzzle_{{$a}}" style="display:none">
								<span class="content_ayat clearfix">
								<?php $per = 0?>
								@foreach($arr_ayats as $per_ayat)
									<?php $per++;?>
										<span class="arabic-puzzle" style="padding:0 10px"><a onclick="QuranJS.puzzleAnswer(this)" href="javascript:;" data-css=".arabic_{{$a}} .per_words_{{$per}}">{{$per_ayat}}</a></span>
								@endforeach
								</span>
								</div>
								<!-- END -->

								<div class="trans trans_{{$a}}">
									<!--span class="no_ayat"></span-->
									<span class="content_ayat">( {{$ayat->ayat}} ) {{$ayat->text_indo}}</span>
								</div>
								@if(Request::segment(2)!='correction')
								<div class="action-footer">
					                <div class="btn-group">
					                  <a class="btn btn-play-ayat play_{{$a}}" href="javascript:;" onclick="fbq('track', 'clickPutarMemoz');"><i class="fa fa-play"></i> Putar <span class="counter_play">0</span>x</a>
					                  <!--a class="btn btn-share-ayat" href="#"  onclick="QuranJS.callModal('bookmarks?url={{url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)}}')"><i class="fa fa-share-alt"></i> Berbagi</a-->
					                  <a class="memozed btn-share-ayat btn" style="display:none" href="javascript:void(0)" onclick="QuranJS.memorized('section_{{$ayat->page}}_{{$ayat->surah}}_{{$ayat->ayat}}')"><i class="fa fa-thumbs-up"></i> Hafal</a>
					                  <a class="btn-share-ayat btn counter_{{$a}}" href="javascript:void(0)" onclick="fbq('track', 'clickBacaCounter');QuranJS.updateCounter('counter_{{$a}}')"><i class="fa fa-volume-up"></i> Baca <span class="counter">0</span>x</a>
					                  <a class="btn btn-share-ayat tafsir" href="#" onclick="fbq('track', 'clickTafsir');QuranJS.callModal('{{'mushaf/tafsir/'.$ayat->surah.'/'.$ayat->ayat}}')"><i class="fa fa-book"></i> Tafsir</a>
					                </div>
					            </div>
					            @endif
							</div>

							<?php $prev_surah = $ayat->surah; $tempCountSpaces = $countSpaces?>
							<?php $a++;?>
							@endforeach

						</div>
						<!-- /mushaf -->

						<?php else:?>
							<div class="alert alert-warning memoz-message">
								<p>Tentukan surah dan ayat yang Anda ingin hafal, di sarankan target hafalan jangan terlalu panjang, perkirakan sesuai kemampuan hafalan Anda.</p>
								<!--p>Dalam proses hafalan terdapat 5 tahapan, yaitu : </p>
								<br>
								<ul>
									<li>Menghafal target hafalan arabic dan terjemahannya, jalankan dan dengarkan qori dengan teliti. Proses ini jangan terlalu lama dan lanjut ke tahap selanjutnya</li>
									<li>Menghafal target hafalan arabic nya saja, perhatikan tajwid nya dan tata letak hurufnya, dan bayangkan setiap gambaran hurufnya</li>
									<li>Menghafal target hafalan arabic dan terjemahanya, perhatikan terjemahan dari setiap kata arabic-nya</li>
									<li>Menghafal target hafalan terjemahanya, dalam tahap ini antum harus setidaknya hafal banyak arabic-nya, dan kuat kan hafalan dengan terjemahannya</li>
									<li>Menghafal target hafalan arabic dan terjemahannya, jalankan dan dengarkan qori dengan teliti, ulangi sampai berulang-ulang sampai hafal, dan yang perhatikan makhrajul huruf-nya</li>
								</ul>
								<br>
								<p>Jangan lupa untuk berdo'a kepada Allah Ta'ala untuk di mudahkan dalam penghafalan dan pemahaman terhadap target hafalan antum.</p-->

							</div>
							<!--div class="ads-middle" style="background: #ffffff;color: #000;" onclick="fbq('track', 'clickUmrohSutanFatih');QuranJS.callModal('umroh')"><img src="{{url('assets/images/sutanfatih_logo.png')}}">Umroh Murah Sutan Fatih Tour and Travel<br> <span style="font-size: 17px"><strong>Mulai dari 18,5jt!</strong></span></div-->
						<?php endif?>
					</div>
				</div>

			</div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->
	</div>
<!-- end main main-content-wrap -->
</div>
<input type="hidden" name="id" id="id" value="{{$id}}"/>
<div class="quran_recorder_cont">
	<div class="quran_recorder" style="display:none">
		<div class="action">
			<div class="player">
				<audio  controls  controlsList="nodownload" src="@if(!empty($memoDetail->record)){{ @url($memoDetail->record)}} @endif" class="@if(empty($memoDetail->record)) disabled @endif" id="audio"></audio>
			</div>
			@if(Request::segment(2)!='correction')
				<div class="action-record">
					  <!--button class="dropdown-toggle record_audio" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="font-size: 34px;background: none;border: 0px"><i class="fa fa-microphone" style="color:red"></i></span>
		                <span class="caret"></span>
		              </button-->
		              <!--button class="record_audio" type="button" aria-haspopup="true" aria-expanded="true" style="font-size: 34px;background: none;border: 0px" onclick="optionsRecord()"><i class="fa fa-microphone" style="color:red"></i></span>
		                <span class="caret"></span>
		              </button-->
		              <a class="button" style="font-size: 34px;" onclick="optionsRecord()"><i class="fa fa-microphone" style="color:red"></i></a>
					@if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
					<!--a class="button" style="font-size: 34px;" onclick="recordAudio('user');fbq('track', 'clickStartRekam');//vex.dialog.alert('Fitur dalam pengembangan, jika ingin mencoba rekaman bisa lewat browser chrome dan buka url https://quranmemo.com');"><i class="fa fa-microphone" style="color:red"></i></a-->
					@else
					<!--a class="button" style="font-size: 34px;" id="record" onclick="fbq('track', 'clickStartRekam');"><i class="fa fa-microphone" style="color:red"></i></a-->
					@endif

					<a class="button disabled one" id="stop" onclick="fbq('track', 'clickStopRekam');"><i class="fa fa-remove"></i></a>
					<!--span class="button disabled one" id="sec_counter"><span id="minutes">00</span>:<span id="seconds">00</span></i></span-->
					<!--span class="button disabled one" id="sec_counter">recording...</span-->
					<a class="button  @if(empty($memoDetail->record)) disabled @endif"  id="play_audio" onclick="fbq('track', 'clickPutarRekam');playAudio()"><i class="fa fa-play-circle"></i></a>
					<a class="button  disabled" id="pause_audio" onclick="fbq('track', 'clickPauseRekam');pauseAudio()"><i class="fa fa-pause-circle"></i></a>

					<a class="button disabled one" id="play"><i class="fa fa-stop-circle"></i></a>
					<a class="button disabled upload" id="save" onclick="fbq('track', 'clickUploadRekam');"><i class="fa fa-upload btn-upload"></i></a>
				</div>
				<form  enctype="multipart/form-data" id="upload-form" method="post" action="{{url('memoz/uploadRecorded')}}">
	          		<input type="file" name="file" id="record_file" onchange="$('#upload-form').submit()" style="display:none">
	          		<input type="hidden" name="id" value="{{$memoDetail->id}}"/>
	          	</form>
			@else
				<a class="button"  id="play_audio" style="display:none !important"  onclick="fbq('track', 'clickPutarRekam');playAudio()"><i class="fa fa-play-circle"></i></a>
				<a class="button  disabled" id="pause_audio" onclick="fbq('track', 'clickPauseRekam');pauseAudio()"><i class="fa fa-pause-circle"></i></a>
			@endif

			@if(session('sess_id')!= @$memoDetail->id_user && Request::segment(2)=='correction' && empty($correctionDetail))
				<a class="btn btn-warning note" style="margin: 5px;"  onclick="fbq('track', 'clickKirimKoreksi');QuranJS.formMemoCorrectionShow()"><i class="fa fa-wrench" ></i> Kirim Catatan</a>
				<a class="btn btn-danger  btn-close" style="margin: 5px; display: none" onclick="QuranJS.formMemoCorrectionClose()"><i class="fa fa-close" ></i> Close</a>
			@endif
		</div>
		<div class="action-footer" style="display: none"> @include('memoz_correction_form')</div>
		@if(Request::segment(2)!='correction')
		<canvas id="level" height="50" width="100%" style="display: none"></canvas>
		<input id="base64Decode" type="hidden" value="">
		@endif
	</div>
</div>

@if(session('sess_id') && !empty($ayats) && Request::segment(2)!='correction')
<nav class="c-circle-menu js-menu mushaf-menu">
	<button class="c-circle-menu__toggle js-menu-toggle">
		<span>Toggle</span>
	</button>
	<ul class="c-circle-menu__items">

		<li class="c-circle-menu__item">
			<button type="button" onclick="fbq('track', 'clickInfoMemoz');QuranJS.showInfoMemoz();$('.info').html('Lanjutkan menghafal');$('.cont_hide_memoz_info').hide()" class="c-circle-menu__link menu__link5">
				<span class='menu-icon'><i class='fa fa-info'></i></span>
				<span class='menu-caption'>Panduan</span>
			</button>
		</li>
		<!-- end-item -->

		<li class="c-circle-menu__item">
			<button type="button" onclick="fbq('track', 'clickSettingMemoz');QuranJS.callModal('memoz/config?repeat='+$('.repeat').val()+'&muratal='+jQuery('.muratal').val()+'&tajwid='+jQuery('.tajwid').val())" class="c-circle-menu__link menu__link4">
				<span class='menu-icon'><i class='fa fa-cog'></i></span>
				<span class='menu-caption'>Setting</span>
			</button>
		</li>
		<!-- end-item -->

		<li class="c-circle-menu__item">
			<a href="javascript:;" onclick="fbq('track', 'clickDaftarHafalan');QuranJS.memozList()" class="c-circle-menu__link menu__link3">
				<span class='menu-icon'><i class='fa fa-file-text'></i></span>
				<span class='menu-caption'>Daftar Hafalan</span>
			</a>
		</li>
		<!-- end-item -->

		<li class="c-circle-menu__item">
			<a  href="{{url('memoz')}}"  class="c-circle-menu__link menu__link2" onclick="fbq('track', 'clickHafalanBaru');">
				<span class='menu-icon'><i class='fa fa-plus'></i></span>
				<span class='menu-caption'>Baru</span>
			</a>
		</li>

		<li class="c-circle-menu__item">
			<a type="button" onclick="fbq('track', 'clickSimpanMemoz');QuranJS.formMemoModal('{{$memoDetail->id}}')" class="c-circle-menu__link menu__link1">
				<span class='menu-icon'><i class='fa fa-floppy-o'></i></span>
				<span class='menu-caption'>Simpan</span>
			</a>
		</li>
		<!-- end-item -->

	</ul>
	<div class="c-circle-menu__mask js-menu-mask"></div>
</nav>
@endif
<script type="text/javascript">
function optionsRecord(){
	string =  '<a class="btn btn-primary" style="font-size: 24px;width:100%" onclick="recordAudio(\'user\');fbq(\'track\', \'clickStartRekam\');"><i class="fa fa-microphone" style="color:red"></i> Rekam Sekarang</a><br><br>';

	string += '<a href="javascript:;" class="btn btn-success" style="font-size: 24px;width:100%" onclick="$(\'#record_file\').trigger(\'click\')"><i class="fa fa-upload" ></i> Upload file rekaman</a>';
	vex.dialog.alert({unsafeMessage:string});
}
function endAudio(){
	$('#audio').bind("ended", function(){ jQuery('#play_audio').removeClass('disabled'); jQuery('#pause_audio').addClass('disabled'); });
}
function playAudio(){
	jQuery('#pause_audio').removeClass('disabled');
	jQuery('#play_audio').addClass('disabled');
	jQuery('#audio').trigger('play');

	endAudio();
	jQuery('.ayat_arabic_memoz').removeClass('blur-ayat');
}
function pauseAudio(){
	jQuery('#pause_audio').addClass('disabled');
	jQuery('#play_audio').removeClass('disabled');
	jQuery('#audio').trigger('pause');
	QuranJS.showAyat('start');
}

function pad(val) {
    return val > 9 ? val : "0" + val;
}

function setRecordTime(){
	var sec = 0;
	var timer = setInterval(function () {
	    $("#seconds").html(pad(++sec % 60));
	    $("#minutes").html(pad(parseInt(sec / 60, 10)));
	}, 1000);

	/*setTimeout(function () {
	    clearInterval(timer);
	}, 11000);*/
}

$(document).ready(function(){
	@if(session('sess_id') && !empty($ayats) && Request::segment(2)!='correction')

	var el = '.js-menu';
    var myMenu = cssCircleMenu(el);
    $('.player-show').hide();
    $( ".c-circle-menu__link" ).click(function() {
       $('.c-circle-menu').removeClass('is-active');
       $('.c-circle-menu__toggle').removeClass('is-active');
       $('.c-circle-menu__mask').removeClass('is-active');
    });
    @endif
	QuranJS.fillAyatEnd();
	@if(!empty($memoDetail))
		jQuery('.memoz-1,.memoz-0').hide();
		jQuery('.memoz-{{@$memoDetail->status}}').show();
	@endif

	<?php if(!empty($ayats) && empty($_COOKIE['coo_hide_info']) && Request::segment(2)!='correction'):?>
	QuranJS.showInfoMemoz();
	<?php endif?>

	@if(!empty($_COOKIE['coo_tajwid']))
		QuranJS.tajwidHighlight();
	@endif

	$(document).ready(function () {
		var jQuerywindow = jQuery(window);
			QuranJS.generateArHeight('!important');
			QuranJS.generateTransHeight('!important');

			//$('.quran_player').hide();

			//show & hide search setting
			// $('.openThis').hide();
			// $('.btn-toggle-player').click(function() {
			//     $('.quran_player').slideToggle( function() {
			//     	$('.openThis').show();
			// 	});
			//     return false;
			// });

			$('.dropdown-menu').on('click', function(event) {
			    event.stopPropagation();
			});

			$('.collapse').on('click', function(event) {
			    event.stopPropagation();
			});

			//resizeDiv();

			window.onresize = function(event) {
				//resizeDiv();
			}

			function resizeDiv() {
				vpw = $(window).width();
				vph = $(window).height();

				if (vpw <= 767) {
						$('#surah-collapse').removeClass('in');

					}
					else {
						$('#surah-collapse').addClass('in');
					}
			}
			//show & hide search setting
			@if(!empty($_COOKIE['coo_tajwid']))
				QuranJS.tajwidHighlight();
			@endif

		});

		var stickyOffset = $('.qm-navbar').offset().top;
		var scrollTrigger = 100;

		$(window).scroll(function(){
			var sticky = $('.qm-navbar'),
			scroll = $(window).scrollTop();

			if (scroll > stickyOffset) {
					$(sticky).addClass('fixed');
				}
			else
				{
					$(sticky).removeClass('fixed');
					$('.navbar-nav li.active').removeClass('active');
				}
		});

		jQuery('.memozed').hide();

		@if(isset($_COOKIE['coo_sound']))
			QuranJS.configMuratal('{{$_COOKIE['coo_sound']}}')
		@endif

	});

	function hideInfo(){
		if($('input[name="hide_memoz_info"]:checked').val()){
			document.cookie = 'coo_hide_info="true";path=/';
		}else{
			document.cookie = 'coo_hide_info="false;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/"';
		}
	}
	@if((@$ayat->surah==1))
	QuranJS.headSurah = 1;
	@endif

	@if(Request::segment(2)!='correction')
	$(function() {
	  $(".ayat_section").swipe( {

	  	//Generic swipe handler for all directions
	    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
	      if(direction=='left'){
	      	jQuery('.selected').next().click();
	      }else if(direction=='right'){
	      	jQuery('.selected').prev().click();
	      }
	  	},
	    allowPageScroll : "vertical",
	    threshold:130
	  });
	});
	@else
	QuranJS.stepMemoz('correction','{{Request::segment(6)}}');
	@endif

	function recordAudio(typeRecord){
		// record from user memoz
		if(typeRecord=='user'){
			@if(empty($level) && $counterRecord>=1)
				QuranJS.callModal('subscription')
				return false;
			@elseif($level==1 &&  $counterRecord>=10)
				QuranJS.callModal('subscription')
				return false;
			@endif

			@if(!empty($memoDetail->id))
			/*vex.dialog.confirm({
			    message: "Batas maksimal merekam hanya 20 detik. Mulai merekam?",
			    callback: function (value) {
			    	if(value==true){
			    		window.parent.postMessage("audio|{{$memoDetail->id}}", "*");
			    	}
			    }
			})*/
			window.parent.postMessage("audio|{{$memoDetail->id}}", "*");
			@else
			vex.dialog.confirm({
			    message: "Simpan hafalan terlebih dahulu?",
			    callback: function (value) {
			    	if(value==true){
				    	QuranJS.formMemoModal('{{$memoDetail->id}}')
				    }
			    }
			})
			@endif
		}else{
			// record from ustadz correction
			window.parent.postMessage("audioUstadz|{{$memoDetail->id}}", "*");
		}


	}


	function getResponse(event){
		var message = event.data;

		if(message=='uploading'){
			$('#preloader').show();
			$('.loading').prepend('<div class="loading_file">File sedang di upload..<br></div>');

		}else if(message=='uploaded'){
			location.reload();
			//$('#preloader').hide();
			//$('.loading_file').remove();
			//vex.dialog.alert('File rekaman berhasil di upload, siap dikoreksi jika sudah hafal.');

			/*$('#play_audio').show();
			$('#play_audio').removeClass('disabled');
			$('#pause_audio').addClass('disabled');
			$('#audio').attr('src',QuranJS.siteUrl+'/'+message);
			playAudio();*/
		}else if(message=='correction_file'){
			$('#preloader').hide();
			$('#record_file').show();
			$('#record_file').val('record_ustadz/{{$memoDetail->id}}_{{session('sess_id')}}_correction.mp3');
		}else if(message=='upload_error'){
			$('#preloader').hide();
			$('.loading_file').remove();
			vex.dialog.alert('File rekaman gagal di upload, coba ulangi kembali.');
		}/*else{
			//alert(QuranJS.siteUrl+'/'+message);
			// this is file

		}*/
	}


	if (window.addEventListener) {
		// For standards-compliant web browsers
		window.addEventListener("message", getResponse, false);
	}
	else {
		window.attachEvent("onmessage", getResponse);
	}
</script>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection
