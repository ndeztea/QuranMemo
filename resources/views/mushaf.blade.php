@extends('layouts.master')

@section('title', 'Mushaf')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
	
	
	@include('errors.errors_message')

		<div class="main-content-wrap">
			<div class="main-content">
				<div class="backdrop">
					<div class="backdrop-inner"></div>
				</div>
				<!-- /backdrop -->
				<div class="single-column">
					

					<div class="nav-top clearfix">
						<div class="container-fluid">
							<button class="btn btn-search-surah pull-left visible-xs" onclick="QuranJS.showSearch();" type="button" aria-expanded="false" aria-controls="surah-collapse">
							  <i class="fa fa-search"></i>
							</button>
							<a href="javascript:;"  class="btn btn-setting pull-right btn-juz visible-xs" onclick="QuranJS.callModal('mushaf/juz')" ><i class="fa fa-book"></i><span class="hidden-xs"> Juz</span></a>
							<div class="hidden-xs" id="surah-collapse">
								<div class="row">
									<div class="col-xs-12">
										<div class="select-surah">
											<div class="modal-spacing">
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
															<option  {{$selectedSurah}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}}  {{$surah->ayat}} ayat)</option>
															@endforeach
														</select>
													</div>
													<div class="form-group display-inline-block-xs">
														<div class="input-group">
														  <input class="form-control search_ayat" type="number" min="1" name="ayat_start" placeholder="Ayat" aria-label="Ayat" value="{{$ayat_start}}">
														  <span class="input-group-addon">Sampai Ayat</span>
														  <input class="form-control search_ayat" type="number" min="1" name="ayat_end" id="ayat_end" placeholder="Ayat" aria-label="Ayat" value="{{$ayat_end}}">
														</div>
													</div>
													<!-- <div class="checkbox display-inline-block-xs">
														<label>
															<input type="checkbox" value="1" id="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)" >  <span>Sampai ayat </span>
															<input class="form-control search_ayat ayat_end"  style="display:none" placeholder="Ayat"/>
														</label>
													</div> -->
													<button class="btn btn-search"  onclick="QuranJS.changeSurah(this)" ><i class="fa fa-search"></i></button>
													<a href="javascript:;"  class="btn btn-setting btn-juz" onclick="QuranJS.callModal('mushaf/juz')" ><i class="fa fa-book"></i><span class="hidden-xs"> Juz</span></a>
							
											</form>
</div>
										</div>
										<!-- /select-surah -->

										

									</div>
									<div class="memoz_options">
										<div class="btn-group">
										  <input type="hidden" name="mushaf_layout" class="mushaf_layout" value="mushaf_arabic_trans"/>
										  <input type="hidden" name="automated_play" class="automated_play" value="true"/>
										  <input type="hidden" name="footer_action" class="footer_action" value="true"/>
										  <input type="hidden" name="muratal" class="muratal" value="true"/>
										  <input type="hidden" name="tajwid" class="tajwid" value=""/>
										</div>
									</div>
								</div>
							</div>
							
							<button type="button" href="#"  onclick="QuranJS.callModal('mushaf/config?mushaf_layout='+jQuery('.mushaf_layout').val()+'&automated_play='+jQuery('.automated_play').val()+'&footer_action='+jQuery('.footer_action').val()+'&muratal='+jQuery('.muratal').val()+'&tajwid='+jQuery('.tajwid').val())" class="btn btn-default btn-setting pull-right">
								<i class="fa fa-cog"></i> <span class="hidden-xs">Setting</span>
							</button> 
							<button type="button" href="#"  onclick="QuranJS.setBookmark('Halaman {{$curr_page}}, Juz {{$ayats[0]->juz}} Surah {{$ayats[0]->surah_name}}','{{$_SERVER['REQUEST_URI']}}')" class="btn btn-default btn-setting pull-right btn-bookmark">
								<i class="fa {{$bookmarked}}" id="bookmark"></i> <span class="hidden-xs">Terakhir baca</span>
							</button>
							
							<div class="clearfix"></div>
						</div>
					</div>
						@if(isset($selected_surah))
						<div class="nav-top clearfix detail_top">
							<h4>{{$selected_surah}} ayat {{$ayat}}</h4>
							<a href="#"  class="btn btn-share-ayat" onclick="QuranJS.callModal('bookmarks?url={{Request::url()}}')"><i class="fa fa-share-alt"></i> Bagikan</a>

							<a href="{{url('memoz/surah/'.$id_surah.'/'.$ayat)}}" class="btn btn-share-ayat"><i class="fa fa-plus"></i> Hafalkan</a>
							<!--a href="#" data-toggle="modal" data-target="#QuranModal" class="btn btn-share-ayat" onclick="QuranJS.callModal('<?php echo 'notes/create/'.$id_surah.'/'.$ayat ?>')"><i class="fa fa-plus-circle"></i> Note</a-->
							
							<a href="{{url('mushaf/page/'.$ayats[0]->page)}}" class="btn btn-share-ayat"><i class="fa fa-arrow-right"></i> Halaman penuh</a>
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
							<div class="mushaf_header clearfix">
							@if(!isset($selected_surah))
								@if($curr_page!=1)
								<a class="btn btn-default pull-left" role="button" onclick="QuranJS.changePage(this)" data-value="{{$curr_page-1}}">
									<i class="fa fa-angle-left"></i> <span class="hidden-xs">Sebelumnya</span>
								</a>
								@endif
								<div class="mids">
									@if($ayats[0]->juz!=0)
										<span class="header_juz" onclick="QuranJS.callModal('mushaf/juz')">Juz {{$ayats[0]->juz}}</span>
									@endif
									<span class="header_juz" onclick="QuranJS.callModal('mushaf/filter_surah')">Surah {{$ayats[0]->surah_name}}</span>
									<span class="header_page" onclick="QuranJS.callModal('mushaf/jump_page')">Hal {{$curr_page}}</span>
								</div>
								@if($curr_page!=604)
								<a class="btn btn-default pull-right" role="button" onclick="QuranJS.changePage(this)" data-value="{{$curr_page+1}}"> <span class="hidden-xs">Berikutnya</span> <i class="fa fa-angle-right"></i>
								</a>
								@endif

							@endif
							</div>

							@foreach($ayats as $ayat)
							@if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) || ($ayat->surah==1 && $ayat->ayat==1))
							<a name="head_surah_{{$ayat->surah}}"></a>
							<div class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_0 play_0 surah_title head_surah_{{$ayat->surah}}"  >
								<div class="surah_name">
									<strong>{{$ayat->surah}}. Surah {{$ayat->surah_name}}</strong><br/>
									<small>{{$ayat->type}} ( turun  #{{$ayat->order}} ) | {{$ayat->count_ayat}} ayat </small><br><br>
									<a class="btn btn-green-small" onclick="QuranJS.callModal('mushaf/muqodimah/{{$ayat->surah}}')"><i class="fa fa-info-circle"></i> Muqodimah</a>
								</div>
								@if($ayat->surah!=1 || $ayat->ayat!=1)
									@if($ayat->surah!=9)
									<div class="head_surah" >
									بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
									</div>
									<?php endif?>
								@else
								<?php $a++;?>
								@endif
								<div class="clearfix"></div>
							</div>
							<!-- /ayat-section -->
							<?php $a++;?>
							@endif
							@if($ayat->surah==1 && $ayat->ayat==1)
							<?php $a--;?>
							@endif

							<div    class="clearfix ayat_section section_{{$ayat->page}}_{{$ayat->surah}}_{{$ayat->ayat}}">
								@if($a!=0)
								<div id="play_{{$a + 1}}"></div>
								<div id="surah_{{$ayat->surah}}_{{$ayat->ayat}}"></div>
								<?php endif?>
								<div class="{{$ayat->juz_header!=0?'juz_head ':''}}arabic arabic_{{$a}}"> 
									
									<span class="content_ayat" > 
										<span class="ayat_arabic">
											{{$ayat->text}}
										</span>
										<span class="no_ayat_arabic">
											<!--<img src="{{url('assets/images/frame-ayat.png')}}" alt="ayat">-->
											<span>{{arabicNum($ayat->ayat)}}</span> 
										</span>
									</span> 
								</div>
								<div class="trans trans_{{$a}}"> 
									<!--span class="no_ayat"></span--> 
									<span class="content_ayat"> ( {{$ayat->ayat}} ) {{$ayat->text_indo}}</span> 
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
							<div class="surah-nav paging-footer">
								<div class="input-group" role="group" aria-label="Navigasi">
									<ul class="pagination">
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="1"><i class="fa fa-angle-double-left"> </i></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="{{$curr_page-1}}"><i class="fa fa-angle-left"> </i> </a></li>
										@foreach($pages as $page)
										<li  class="{{$page->page==$curr_page?'active':''}}"><a  onclick="QuranJS.changePage(this)" href="#" data-value="{{$page->page}}">{{$page->page}}</a></li>
										<?php endforeach?>
										<li><a href="#"  onclick="QuranJS.changePage(this)"  data-value="{{$curr_page+1}}"><i class="fa fa-angle-right"> </i></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="604"> <i class="fa fa-angle-double-right"> </i></a></li>
										<!--li class="page_free_input">
											<a href="javascript:;">
											<form class="form-inline" id="paggingForm" onsubmit="return false">
											  <div class="form-group">
											    <div class="input-group">
											      <input type="number" class="form-control col-xs-1 pagging" placeholder="">
											      <div class="input-group-addon"><button name="btnPage" onclick="QuranJS.changePage('pagging')"><i class="fa fa-search"></i></button> </div>
											    </div>
											  </div>
											</form>
										</a></li-->
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
		
		//resizeDiv();

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

		// $('.quran_player').hide();

		// $('.openThis').hide();
		// $('.btn-toggle-player').click(function() {
		//     $('.quran_player').slideToggle( function() {
		//     	$('.openThis').show();
					
		// 	});
		//     return false;
		// });

		QuranJS.generateArHeight('!important');
		QuranJS.generateTransHeight('!important');

		// apply setting mushaf
		@if(isset($cookies['coo_mushaf_layout']))
			QuranJS.showMushaf('{{$cookies['coo_mushaf_layout']}}');
		@endif

		@if(isset($cookies['coo_footer_action']))
			QuranJS.showMushafAction('{{$cookies['coo_footer_action']}}');
		@endif

		@if(isset($cookies['coo_automated_play']))
			QuranJS.autoPlay('{{$cookies['coo_automated_play']}}');
		@endif

		@if(isset($_COOKIE['coo_sound']))
			QuranJS.configMuratal('{{$_COOKIE['coo_sound']}}')
		@endif

		@if(!empty($_COOKIE['coo_tajwid']))
			QuranJS.tajwidHighlight();
		@endif

	});

	$(function() {
	  $(".ayat_section").swipe( {

	  	//Generic swipe handler for all directions
	    swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
	      if(direction=='left'){
	      	jQuery('.fa-angle-right').click();
	      }else if(direction=='right'){
	      	jQuery('.fa-angle-left').click();
	      }
	  	},
	    allowPageScroll : "vertical",
	    threshold:130
	  });
	});
	</script>
@endsection