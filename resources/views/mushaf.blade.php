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
						<h2>Mushaf</h2>
					</div>

					<div class="nav-top clearfix">
						<div class="container-fluid">
							<button class="btn btn-surah-trigger visible-xs" type="button" data-toggle="collapse" data-target="#surah-collapse" aria-expanded="false" aria-controls="surah-collapse">
							  Pencarian
							</button>
							<div class="collapse in" id="surah-collapse">
								<div class="row">
									<div class="col-xs-12 col-sm-7 -col-md-7">
										<div class="select-surah">
											<form class="form-inline" method="post" action="<?php echo url('mushaf/search')?>">
												<div class="form-group">
													<select class="selectpicker form-control" name="surah">
														<?php foreach($surahs as $surah):?>
															<?php 
																$selectedSurah = '';
																if(session('searchSurah')==$surah->id){
																	$selectedSurah = 'selected';
																}elseif($surah->id==$ayats[0]->surah){
																	$selectedSurah = 'selected';
																}
															?>
														<option  <?php echo $selectedSurah?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?> (<?php echo $surah->type ?>)</option>
														<?php endforeach?>
													</select>
												</div>
												<div class="form-group display-inline-block-xs">
													<input class="form-control search_ayat" type="number" name="ayat_start" placeholder="Ayat"/>
												</div>
												<div class="checkbox display-inline-block-xs">
													<label>
														<input type="checkbox" value="1" id="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)" >  <span>Sampai ayat </span>
														<input class="form-control search_ayat ayat_end" type="number" name="ayat_end" id="ayat_end" style="display:none" placeholder="Ayat"/>
													</label>
												</div>
												<button class="btn"  onclick="QuranJS.changeSurah(this)" ><i class="fa fa-search"></i></button>
											</form>

										</div>
										<!-- /select-surah -->

									</div>
									<?php if(empty($selected_surah)):?>
									<div class="col-xs-12 col-sm-5 -col-md-5">

										<div class="surah-action">
											<span class="auto-play">
												<input type="checkbox" id="automated_play" name="automated_play" <?php echo Request::segment(4)=='autoplay'?'checked':'';?> >&nbsp;<i class="fa fa-play-circle-o"></i>  <?php echo trans('trans.play_otomatis')?>
											</span>
											<!--a id="playNow" class="playnow"><i class="fa fa-play"></i> Play</a-->
										</div>
										<!-- /surah-action -->
									</div>
								<?php endif?>
								</div>
							</div>
						</div>
					</div>
					<?php if(isset($selected_surah)):?>
						<div class="nav-top clearfix detail_top">
							<h4><?php echo $selected_surah?> ayat <?php echo $ayat?></h4>
							<a href="#" data-toggle="modal" data-target="#QuranModal" class="btn btn-share-ayat" onclick="QuranJS.callModal('bookmarks?url=<?php echo  Request::url() ?>')"><i class="fa fa-share-alt"></i></a>
							<!--a href="#" data-toggle="modal" data-target="#QuranModal" class="btn btn-share-ayat" onclick="QuranJS.callModal('<?php echo 'notes/create/'.$id_surah.'/'.$ayat ?>')"><i class="fa fa-plus-circle"></i> Note</a-->
						</div>
					<?php endif?>
					<!-- /nav-top -->
					<div class="mushaf">
						<?php if(!empty($ayats)):?>
							
							<div class="mushaf_display">
								<div class="btn-group" role="group" aria-label="mushaf-display">
									<a class="btn mushaf_arabic_trans active" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic_trans')"><span class="hidden-xs">Arabic &amp; Terjemahaan</span><span class="visible-xs">A &amp; T</span></a>
									<a class="btn mushaf_arabic" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic')">Arabic</a>
									<a class="btn mushaf_trans" href="javascript:void(0)" onclick="showMushaf('mushaf_trans')">Terjemahaan</a>
								</div>
							</div>
							<!-- /mushaf-display -->

							<?php  $a=0;foreach($ayats as $ayat): ?>
							
							<?php  if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) || ($ayat->surah==1 && $ayat->ayat==1)):?>
							<a name="head_surah_<?php echo $ayat->surah?>"></a>
							<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0 play_0 surah_title head_surah_<?php echo $ayat->surah?>"  >
								<div class="surah_name">
									<strong>Surah <?php echo $ayat->surah_name?></strong><br/>
									<small><?php echo $ayat->type?> ( turun  #<?php echo $ayat->order?> ) | <?php echo $ayat->count_ayat?> ayat </small>
								</div>
								<div class="head_surah" >
								بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
								</div>
								<div class="clearfix"></div>
							</div>
							<!-- /ayat-section -->
							<?php $a++;endif?>
							
							<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
								
								<div class="arabic arabic_<?php echo $a;?>"> 
										<span class="content_ayat"><?php echo $ayat->text?></span> 
										<span class="no_ayat_arabic"> ( <?php echo arabicNum($ayat->ayat)?> </span> 
									</div>
									<div class="trans trans_<?php echo $a;?>"> 
										<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
										<span class="content_ayat"><?php echo $ayat->text_indo?></span> 
									</div>

								<div class="action-footer">
					                <div class="btn-group">
					                  <a class="btn btn-play-ayat play_<?php echo $a?>" href="javascript:;"><i class="fa fa-play"></i> Play</a>
					                  <!--a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) )?>" target="_blank"><i class="fa fa-share-alt"></i></a-->
					                  <a class="btn btn-share-ayat" href="#" data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('bookmarks?url=<?php echo  url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) ?>')" data-url="<?php echo url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)?>"><i class="fa fa-share-alt"></i> Share</a>
					                </div>
					            </div>
								
							</div>
							<?php $prev_surah = $ayat->surah?>
							<?php $a++; endforeach?>
						<?php endif?>

						<?php if(isset($pages)):?>
							<div class="surah-nav">
								<div class="input-group" role="group" aria-label="Navigasi">
									<ul class="pagination">
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="1"> << <?php //echo trans('trans.prev')?></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page-1?>"> < <?php //echo trans('trans.prev')?></a></li>
										<?php foreach($pages as $page):?>
										<li  class="<?php echo $page->page==$curr_page?'active':''?>"><a  onclick="QuranJS.changePage(this)" href="#" data-value="<?php echo $page->page?>"><?php echo $page->page ?></a></li>
										<?php endforeach?>
										<li><a href="#"  onclick="QuranJS.changePage(this)"  data-value="<?php echo $curr_page+1?>"> > <?php //echo trans('trans.next')?></a></li>
										<li><a href="#"  onclick="QuranJS.changePage(this)" data-value="604"> >> <?php //echo trans('trans.next')?></a></li>
										<li class="page_free_input">
											<a href="javascript:;">
											<form class="form-inline" id="paggingForm" onsubmit="return false">
											  <div class="form-group">
											    <div class="input-group">
											      <input type="text" class="form-control col-xs-1 pagging" placeholder="page">
											      <div class="input-group-addon"><button name="btnPage" onclick="QuranJS.changePage('pagging')"><i class="fa fa-search"></i></button> </div>
											    </div>
											  </div>
											</form>
										</a></li>
									</ul>
								</div>
							</div>
							<!-- /surah-nav -->
						<?php endif?>

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
				
			// function checkWidth() {
			// 	var windowsize = jQuerywindow.width();
			// 	if (windowsize < 1024) {
			// 		jQuery('#surah-collapse').removeClass('in');
			// 	}
			// 	else {
			// 		jQuery('#surah-collapse').addClass('in');
			// 	}
			// }
			// Execute on load
			// checkWidth();
			// Bind event listener
			// jQuery(window).resize(checkWidth);
			//show & hide search setting

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


		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');

	}

	</script>
	
	

@endsection