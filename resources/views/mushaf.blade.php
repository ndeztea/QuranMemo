@extends('layouts.master')

@section('title', 'Mushaf')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
	@include('players')

	<div class="nav top">
		<select name="surah" onchange="QuranJS.changeSurah(this)" >
			<?php foreach($surahs as $surah):?>
			<option  <?php echo $surah->id==$ayats[0]->surah?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
			<?php endforeach?>
		</select>

		<div class="btn-group" role="group" aria-label="Navigasi">
			<a class="btn btn-default" href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page-1?>">
				<span class="hidden-xs"><?php echo trans('trans.prev')?></span>
				<span class="visible-xs"><i class="fa fa-angle-left"></i></span>
			</a>
			<a class="btn btn-default" href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page+1?>">
				<span class="hidden-xs"><?php echo trans('trans.next')?></span>
				<span class="visible-xs"><i class="fa fa-angle-right"></i></span>
			</a>
		</div>

		
		<select name="page" onchange="QuranJS.changePage(this)" >
			<?php foreach($pages as $page):?>
			<option  <?php echo $page->page==$curr_page?'selected':''?> value="<?php echo $page->page ?>"><?php echo $page->page ?></option>
			<?php endforeach?>
		</select>
		

		<span><input type="checkbox" id="automated_play" name="automated_play" checked ><?php echo trans('trans.play_otomatis')?></span>
	</div>
	<!-- /nav-top -->

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="mushaf">
					<?php if(!empty($ayats)):?>
						
						<div class="mushaf_display">
							<div class="btn-group" role="group" aria-label="mushaf-display">
								<a class="btn btn-default active" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic_trans')" class="mushaf_arabic_trans selected">Arabic &amp; Terjemahaan</a>
								<a class="btn btn-default" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic')" class="mushaf_arabic">Arabic</a>
								<a class="btn btn-default" href="javascript:void(0)" onclick="showMushaf('mushaf_trans')" class="mushaf_trans">Terjemahaan</a>
							</div>
						</div>
						<!-- /mushaf-display -->

						<?php foreach($ayats as $ayat):?>
						
						<?php if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) ):?>
						<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0">
							<div class="head_surah" >
							بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /ayat-section -->
						<?php endif?>
						
						<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
							<div class="pull-right arabic"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text?> </div>
							<div class="pull-left trans"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text_indo?> </div>
						</div>
						<?php $prev_surah = $ayat->surah?>
						<?php endforeach?>
					<?php endif?>
				</div>
				<!-- /mushaf -->
			</div>
		</div>
	</div>

	

	<script>
	function showMushaf(mushaf){
		if(mushaf=='mushaf_arabic_trans'){
			jQuery('.trans').show();
			jQuery('.arabic').show();
		}else if(mushaf=='mushaf_arabic'){
			jQuery('.trans').hide();
			jQuery('.arabic').show();
		}else if(mushaf=='mushaf_trans'){
			jQuery('.trans').show();
			jQuery('.arabic').hide();
		}
		jQuery('.mushaf_display a').removeClass('selected');
		jQuery('.'+mushaf).addClass('selected');
	}
	</script>
	

@endsection