@extends('layouts.master')

@section('title', 'Mushaf')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
	@include('players')
	
	@include('errors.errors_message')

		<div class="main-content-wrap">
			<div class="main-content">
				<div class="backdrop">
					<div class="backdrop-inner"></div>
				</div>
				<!-- /backdrop -->
				<div class="single-column">
					<div class="page-title">
						<h2 class="pull-left">Mushaf</h2>
						<button type="button" href="#"  onclick="QuranJS.callModal('mushaf/config?mushaf_layout='+jQuery('.mushaf_layout').val()+'&automated_play='+jQuery('.automated_play').val()+'&footer_action='+jQuery('.footer_action').val())" class="btn btn-default btn-setting">
							<i class="fa fa-cog"></i> 
						</button>
				
						@if(empty($selected_surah))
							<!--div class="surah-action pull-right">
								<span class="auto-play">
									<input type="checkbox" id="automated_play" name="automated_play" {{Request::segment(4)=='autoplay' || empty(Request::segment(4))?'checked':''}} >&nbsp;<i class="fa fa-play-circle-o"></i>  {{trans('trans.play_otomatis')}}
								</span>
							</div>
							<!-- /surah-action -->
						@endif
					</div>

					<div class="nav-top clearfix">
						<div class="container-fluid">
							<button class="btn btn-surah-trigger visible-xs" type="button" data-toggle="collapse" data-target="#surah-collapse" aria-expanded="false" aria-controls="surah-collapse">
							  Pencarian
							</button>
							<div class="collapse in" id="surah-collapse">
								<div class="row">
									<div class="col-xs-12">
										<div class="select-surah">

											<form class="form-inline" method="post" action="<?php echo url('mushaf/search')?>">
												<div class="form-group">
													<select class="selectpicker form-control" name="surah">
														@foreach($surahs as $surah)
															<?php 
																$selectedSurah = '';
																if(session('searchSurah')==$surah->id){
																	$selectedSurah = 'selected';
																}elseif($surah->id==$ayats[0]->surah){
																	$selectedSurah = 'selected';
																}
															?>
														<option  {{$selectedSurah}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}})</option>
														@endforeach
													</select>
												</div>
												<div class="form-group display-inline-block-xs">
													<div class="input-group">
													  <input class="form-control search_ayat" type="number" min="1" name="ayat_start" placeholder="Ayat" aria-label="Ayat">
													  <span class="input-group-addon">Sampai Ayat</span>
													  <input class="form-control search_ayat" type="number" min="1" name="ayat_end" id="ayat_end" placeholder="Ayat" aria-label="Ayat">
													</div>
												</div>
												<!-- <div class="checkbox display-inline-block-xs">
													<label>
														<input type="checkbox" value="1" id="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)" >  <span>Sampai ayat </span>
														<input class="form-control search_ayat ayat_end"  style="display:none" placeholder="Ayat"/>
													</label>
												</div> -->
												<button class="btn"  onclick="QuranJS.changeSurah(this)" ><i class="fa fa-search"></i></button>
												<a href="javascript:;" data-toggle="modal" data-target="#QuranModal"  class="btn" onclick="QuranJS.callModal('mushaf/juz')" ><i class="fa fa-book"></i></a>
											</form>

										</div>
										<!-- /select-surah -->

										

									</div>
									<div class="memoz_options">
										<div class="btn-group">
										  
										  <input type="hidden" name="mushaf_layout" class="mushaf_layout" value="mushaf_arabic_trans"/>
										  <input type="hidden" name="automated_play" class="automated_play" value="true"/>
										  <input type="hidden" name="footer_action" class="footer_action" value="true"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						@if(isset($selected_surah))
						<div class="nav-top clearfix detail_top">
							<h4>{{$selected_surah}} ayat {{$ayat}}</h4>
							<a href="#"  class="btn btn-share-ayat" onclick="QuranJS.callModal('bookmarks?url={{Request::url()}}')"><i class="fa fa-share-alt"></i> Bagikan</a>

							<a href="{{url('memoz/surah/'.$id_surah.'/'.$ayat)}}" class="btn btn-share-ayat"><i class="fa fa-plus"></i> Hafalkan</a>
							<!--a href="#" data-toggle="modal" data-target="#QuranModal" class="btn btn-share-ayat" onclick="QuranJS.callModal('<?php echo 'notes/create/'.$id_surah.'/'.$ayat ?>')"><i class="fa fa-plus-circle"></i> Note</a-->
						</div>
					@endif
					<!-- /nav-top -->

					<div class="mushaf">
						@if(!empty($ayats))
							<div id="play_0"></div>
							<!--div class="mushaf_display">
								<div class="btn-group" role="group" aria-label="mushaf-display">
									<a class="btn mushaf_arabic_trans active" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic_trans')"><span class="hidden-xs">Arabic &amp; Terjemahaan</span><span class="visible-xs">A &amp; T</span></a>
									<a class="btn mushaf_arabic" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic')">Arabic</a>
									<a class="btn mushaf_trans" href="javascript:void(0)" onclick="showMushaf('mushaf_trans')">Terjemahaan</a>
								</div>
							</div-->
							<!-- /mushaf-display -->

							<?php  $a=0;?>

							@foreach($ayats as $ayat)
							@if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) || ($ayat->surah==1 && $ayat->ayat==1))
							<a name="head_surah_{{$ayat->surah}}"></a>
							<div class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_0 play_0 surah_title head_surah_{{$ayat->surah}}"  >
								<div class="surah_name">
									<strong>{{$ayat->surah}}. Surah {{$ayat->surah_name}}</strong><br/>
									<small>{{$ayat->type}} ( turun  #{{$ayat->order}} ) | {{$ayat->count_ayat}} ayat </small>
								</div>
								@if($ayat->surah!=1 || $ayat->ayat!=1)
								<div class="head_surah" >
								بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
								</div>
								@else
								<?php $a--;?>
								@endif
								<div class="clearfix"></div>
							</div>
							<!-- /ayat-section -->
							<?php $a++;?>
							@endif
							<div    class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_{{$ayat->ayat}}">
								@if($a!=0)
								<div id="play_{{$a + 1}}"></div>
								<div id="surah_{{$ayat->surah}}_{{$ayat->ayat}}"></div>
								<?php endif?>
								<div class="{{$ayat->juz!=0?'juz_head ':''}}arabic arabic_{{$a}}"> 
									
									<span class="content_ayat" > 
										<span class="ayat_arabic">
											{{$ayat->text}}
										</span>
										<span class="no_ayat_arabic">
											<img src="{{url('assets/images/frame-ayat.png')}}">
											<span>{{arabicNum($ayat->ayat)}}</span> 
										</span>
									</span> 
								</div>
								<div class="trans trans_{{$a}}"> 
									<span class="no_ayat">( {{$ayat->ayat}} )</span> 
									<span class="content_ayat">{{$ayat->text_indo}}</span> 
								</div>
								
								<div class="action-footer">
					                <div class="btn-group">
					                  <a class="btn btn-play-ayat play_{{$a}}" href="javascript:;"><i class="fa fa-play"></i> Putar</a>
					                  <!--a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) )?>" target="_blank"><i class="fa fa-share-alt"></i></a-->
					                  <a class="btn btn-share-ayat" href="#" onclick="QuranJS.callModal('bookmarks?url={{url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)}}')"><i class="fa fa-share-alt"></i> Berbagi</a>
					                  <a class="btn btn-play-ayat" href="{{url('memoz/surah/'.$ayat->surah.'/'.$ayat->ayat)}}"><i class="fa fa-plus"></i> Hafalkan</a>
					                  
					                </div>
					            </div>

								
							</div>
							<?php $prev_surah = $ayat->surah?>
							<?php $a++;?>
							@endforeach
						@endif

						@if(isset($pages))
							<div class="surah-nav">
								<div class="input-group" role="group" aria-label="Navigasi">
									<ul class="pagination">
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="1"> << <?php //echo trans('trans.prev')?></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="{{$curr_page-1}}"> < <?php //echo trans('trans.prev')?></a></li>
										@foreach($pages as $page)
										<li  class="{{$page->page==$curr_page?'active':''}}"><a  onclick="QuranJS.changePage(this)" href="#" data-value="{{$page->page}}">{{$page->page}}</a></li>
										<?php endforeach?>
										<li><a href="#"  onclick="QuranJS.changePage(this)"  data-value="{{$curr_page+1}}"> > <?php //echo trans('trans.next')?></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="604"> >> <?php //echo trans('trans.next')?></a></li>
										<li class="page_free_input">
											<a href="javascript:;">
											<form class="form-inline" id="paggingForm" onsubmit="return false">
											  <div class="form-group">
											    <div class="input-group">
											      <input type="number" class="form-control col-xs-1 pagging" placeholder="">
											      <div class="input-group-addon"><button name="btnPage" onclick="QuranJS.changePage('pagging')"><i class="fa fa-search"></i></button> </div>
											    </div>
											  </div>
											</form>
										</a></li>
									</ul>
								</div>
							</div>
							<!-- /surah-nav -->
						@endif

					</div>
					<!-- /mushaf -->

				</div>
				<!-- /single-column -->
			</div>
			<!-- /main-content -->
		</div>
		<!-- /main-content-wrap -->

	<script type="text/javascript">

	$(document).ready(function () {
		var jQuerywindow = jQuery(window);
		resizeDiv();

		$('.dropdown-menu').on('click', function(event) {
		    event.stopPropagation();
		});

		$('.collapse').on('click', function(event) {
		    event.stopPropagation();
		});



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
		//Cache reference to window and animation items

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

		$('.quran_player').hide();

		$('.openThis').hide();
		$('.btn-toggle-player').click(function() {
		    $('.quran_player').slideToggle( function() {
		    	$('.openThis').show();
					
			});
		    return false;
		});

		QuranJS.generateArHeight('!important');
		QuranJS.generateTransHeight('!important');

	});

	
	function showMushaf(mushaf){

		jQuery('.mushaf').removeClass('mushaf_arabic_trans');
		jQuery('.mushaf').removeClass('mushaf_arabic');
		jQuery('.mushaf').removeClass('mushaf_trans');

		if(mushaf=='mushaf_arabic_trans'){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
		}else if(mushaf=='mushaf_arabic'){
			jQuery('.trans').addClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').addClass('go');
			
		}else if(mushaf=='mushaf_trans'){
			jQuery('.trans').removeClass('puff').addClass('go');
			jQuery('.arabic').removeClass('go').addClass('puff');
		}

		jQuery('.mushaf_layout').val(mushaf);
		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');

	}

	</script>
	
	

@endsection