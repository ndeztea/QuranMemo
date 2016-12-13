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
			<div class="page-title">
				<h1 class="pull-left">Menghafal</h1>
				@if(empty($_SERVER['HTTP_X_REQUESTED_WITH']))
    			<a class="pull-right gp-link" target="_blank"  href="https://play.google.com/store/apps/details?id=com.ndeztea.quranmemo"><img src="{{url('assets/images/button-google-play.png')}}"  alt="Download di Google Play" width="150"></a>
    			@endif
				
			</div>
			<div class="nav-top clearfix">
			<div style="display:{{!empty($ayats)?'none':''}}">
				<div class="select-surah pull-left">
					<form class="form-inline" action="<?php echo url('memoz/search')?>" method="post" onsubmit="cookieLastMemo()">
							<!--span class="search-title">Surah</span-->
							<div class="form-group">
								<select name="surah_start"  id="surah_start" class="form-control">
									@foreach($surahs as $surah)
									<option {{$surah->id==$surah_start?'selected':''}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}})</option>
									@endforeach
								</select>
							</div>
							<!--div class="form-group display-inline-block-xs">
								<input class="form-control search_ayat" type="number" name="ayat_start" value="<?php echo $ayat_start?$ayat_start:''?>">
							</div>
							<!--div class="checkbox display-inline-block-xs">
								<label>
									<input type="checkbox" value="1" id="fill_ayat_end" <?php echo !empty($fill_ayat_end)?'checked':''?> name="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)">  <span>Sampai ayat </span>
								</label>
							</div>

							-->
							<div class="form-group display-inline-block-xs">
								<div class="input-group memoz-form">
								  <input class="form-control search_ayat" id="ayat_start" type="number" min="1" name="ayat_start" placeholder="Ayat" aria-label="Ayat"  value="{{$ayat_start?$ayat_start:''}}">
								  <span class="input-group-addon">Sampai Ayat</span>
								  <input class="form-control search_ayat" id="ayat_end" type="number" min="1" name="ayat_end" id="ayat_end" placeholder="Ayat" aria-label="Ayat"  value="{{$ayat_end?$ayat_end:''}}">
								</div>
							</div>
							
							<button class="btn btn-cari-ayat" type="submit" name="btnSubmit"><i class="fa fa-search"></i><span class="sr-only">Cari</span></button>
								
							@if(session('sess_id'))
							<a class="btn btn-cari-ayat btn-last-memoz" onclick="QuranJS.memozList()" href="javascript:void(0)"><i class="fa fa-file-text"></i> Daftar Hafalan</a>
							@else
							@if(isset($_COOKIE['coo_last_memoz']))
							<a class="btn btn-cari-ayat btn-last-memoz" href="{{$_COOKIE['coo_last_memoz']}}"><i class="fa fa-sign-in"></i> Hafalan Terakhir</a>
							@endif
							@endif
					</form>
				</div>
			</div>
			@if(!empty($ayats) && (Request::segment(2)!='correction' || session('sess_id')==$memoDetail->id_user))
				<div class="select-surah pull-left">
					<a class="btn btn-green-small" href="javascript:;" onclick="QuranJS.createMemoModal()"><i class="fa fa-plus"></i></a>
					<!--a class="btn btn-green-small" href="{{url('memoz')}}"><i class="fa fa fa-thumbs-up"></i> Hafal</a-->
					@if(session('sess_id'))
					<button type="button" class="btn btn-green-small btn-form-memoz" onclick="QuranJS.formMemoModal()"><i class="fa fa-floppy-o"></i></button>
					<a class="btn btn-green-small" onclick="QuranJS.memozList()" href="javascript:void(0)"><i class="fa fa-file-text"></i></a>
					@if(!empty($memoDetail))
					<a class="btn btn-green-small" onclick="QuranJS.callModal('memoz/correction/list/{{$memoDetail->id}}')" href="javascript:void(0)"><i class="fa fa-check-square-o"></i></a>
					@endif
					 @endif
					
				</div>
			@endif
			
				@if(!empty($ayats) && (Request::segment(2)!='correction' || session('sess_id')==$memoDetail->id_user))

				<div class="memoz_options">
					<div class="btn-group">
						@if(!empty($memoDetail))
							@if($memoDetail->status==0)
							<a class="btn btn-green-small btn-status-save" href="javascript:;" onclick="QuranJS.updateStatusMemoz('{{$memoDetail->id}}','1','Hafalan ini sudah hafal? dan ingin dipublikasikan untuk di test oleh pengguna lain?')"><i class="fa fa-thumbs-up label-status-save"></i><i class="fa fa-cog fa-spin fa-3x fa-fw label-status-loading " style="display:none"></i></a>
							@else
							<a class="btn btn-green-small btn-status-save" href="javascript:;" onclick="QuranJS.updateStatusMemoz('{{$memoDetail->id}}','0','Hafalan ini belum di hafal dengan benar?')"><i class="fa fa-thumbs-down label-status-save"></i><i class="fa fa-cog fa-spin fa-3x fa-fw label-status-loading " style="display:none"></i></a>
							@endif
						@endif
					</div>
					<div class="btn-group">
						<a class="btn btn-green-small" href="javascript:;" onclick="QuranJS.showInfoMemoz();$('.info').html('Lanjutkan menghafal');$('.cont_hide_memoz_info').hide()"><i class="fa fa-info"></i></a>
					</div>
					<div class="btn-group">
					   <button type="button" href="#" onclick="QuranJS.callModal('memoz/config?repeat='+$('.repeat').val()+'&muratal='+jQuery('.muratal').val()+'&tajwid='+jQuery('.tajwid').val())" class="btn btn-green-small">
					    &nbsp;<i class="fa fa-cog"></i>&nbsp;
					  </button>
					</div>
					
					
				</div>
				<!-- /memoz-player -->
				@endif
				<input type="hidden" name="repeat" class="repeat" value="1" />
				<input type="hidden" name="muratal" class="muratal" value="1" />
				<input type="hidden" name="tajwid" class="tajwid" value=""/>

			</div>
			<!-- /nav-top -->
			<input type="hidden" name="puzzle_ayat" id="puzzle_ayat" value="">
			<input type="hidden" name="puzzle_word" id="puzzle_word" value="">
			@if(!empty($ayats))
			<div class="">
				<div class="">
					<div class="">
						<div class="mushaf mushaf-hafalan">
							<div class="clearfix surah_title head_surah_1 center">{{$header_title}}</div>
					
							<div class="step-wrap">
								<div class="steps clearfix btn-group btn-breadcrumb" role="group" aria-label="steps">
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('1')" class="btn btn-default steps_1 selected"># 1</a>
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('2')" class="btn btn-default steps_2"># 2</a>
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('3')" class="btn btn-default steps_3"># 3</a>
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('4');QuranJS.showAyat('start')" class="btn btn-default steps_4"># 4</a>
									<a href="javascript:void(0)" onclick="QuranJS.stepMemoz('5');" class="btn btn-default steps_5"># 5</a>
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
									@if(!empty($correctionDetail))
									<strong>Tester :</strong><br>
									<i>{{$correctionDetail->name}} ({{$correctionDetail->email}}) </i><br>
									<strong>Catatan :</strong><br>
									<i>{{$correctionDetail->note}}</i>
									@endif
								</div>
							</div>
							@if(Request::segment(2)!='correction')
							<div class="memoz_nav" style="display: none">
								<a href="javascript:;" class="btn btn-start" onclick="QuranJS.showAyat('start')">Awal</a>
								<a href="javascript:;" class="btn btn-middle" onclick="QuranJS.showAyat('middle')">Tengah</a>
								<a href="javascript:;" class="btn btn-end" onclick="QuranJS.showAyat('end')">Akhir</a>
								<a href="javascript:;" class="btn btn-mix" onclick="QuranJS.showAyat('mix')">Awal+Akhir</a>
								<a href="javascript:;" class="btn btn-random" onclick="QuranJS.showAyat('random')">Acak</a>
							</div>
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
								<div id="play_{{$a + 1}}"></div>
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

										<span class="no_ayat_arabic_memoz">
											<img src="{{url('assets/images/frame-ayat.png')}}"  alt="ayat">
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
									<span class="no_ayat">( {{$ayat->ayat}} )</span> 
									<span class="content_ayat">{{$ayat->text_indo}}</span> 
								</div>
								@if(Request::segment(2)!='correction')
								<div class="action-footer">
					                <div class="btn-group">
					                  <a class="btn btn-play-ayat play_{{$a}}" href="javascript:;"><i class="fa fa-play"></i> Putar</a>
					                  <a class="btn btn-share-ayat" href="#"  onclick="QuranJS.callModal('bookmarks?url={{url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)}}')"><i class="fa fa-share-alt"></i> Berbagi</a>
					                  <a class="memozed btn-share-ayat btn" style="display:none" href="javascript:void(0)" onclick="QuranJS.memorized('section_{{$ayat->page}}_{{$ayat->surah}}_{{$ayat->ayat}}')"><i class="fa fa-thumbs-up"></i> Hafal</a>
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
			@if(Request::segment(2)!='correction')
			<a class="button" id="record"><i class="fa fa-stop"></i></a>
			<a class="button disabled one" id="stop"><i class="fa fa-remove"></i></a>
			<a class="button disabled one" id="play"><i class="fa fa-play"></i></a>
			<a class="button disabled upload" id="save"><i class="fa fa-upload btn-upload"></i></a>
			@endif
			<a class="button" id="btn-correction" style="display:none" onclick="QuranJS.formMemoCorrectionModal()"><i class="fa fa-wrench" ></i> Kirim Koreksi</a>
		</div>
		
		<div class="player">
			<audio controls src="@if(!empty($memoDetail->record)){{ @url($memoDetail->record)}} @endif" id="audio"></audio>
		</div>
		@if(Request::segment(2)!='correction')
		<canvas id="level" height="50" width="100%"></canvas>
		<input id="base64Decode" type="hidden" value="">
		@endif
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	QuranJS.fillAyatEnd();

	<?php if(!empty($ayats) && empty($_COOKIE['coo_hide_info'])):?>
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
</script>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection