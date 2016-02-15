@extends('layouts.master')

@section('title', 'Mushaf')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
	@include('players')

	<div class="nav-top clearfix">
		
		<div class="pull-left select-surah">
			<select class="selectpicker form-control" name="surah" onchange="QuranJS.changeSurah(this)" >
				<?php foreach($surahs as $surah):?>
				<option  <?php echo $surah->id==$ayats[0]->surah?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
				<?php endforeach?>
			</select>
		</div>
		<!-- /select-surah -->

		<div class="surah-nav">
			<div class="input-group" role="group" aria-label="Navigasi">
				<a class="btn input-group-addon" href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page-1?>">
					<span class="hidden-xs"><?php echo trans('trans.prev')?></span>
					<span class="visible-xs"><i class="fa fa-angle-left"></i></span>
				</a>
				<select class="selectpicker form-control" name="page" onchange="QuranJS.changePage(this)" >
					<?php foreach($pages as $page):?>
					<option  <?php echo $page->page==$curr_page?'selected':''?> value="<?php echo $page->page ?>"><?php echo $page->page ?></option>
					<?php endforeach?>
				</select>
				<a class="btn input-group-addon" href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page+1?>">
					<span class="hidden-xs"><?php echo trans('trans.next')?></span>
					<span class="visible-xs"><i class="fa fa-angle-right"></i></span>
				</a>
			</div>
		</div>
		<!-- /surah-nav -->

		<div class="surah-action pull-right">
			<span class="auto-play">
				<input type="checkbox" id="automated_play" name="automated_play" checked >&nbsp;<i class="fa fa-play-circle-o"></i>  <?php echo trans('trans.play_otomatis')?>
			</span>
			<a id="playNow" class="playnow"><i class="fa fa-play"></i> Play</a>
		</div>
		<!-- /surah-action -->

	</div>
	<!-- /nav-top -->
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<div class="mushaf">
					<?php if(!empty($ayats)):?>
						
						<div class="mushaf_display">
							<div class="btn-group" role="group" aria-label="mushaf-display">
								<a class="btn mushaf_arabic_trans active" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic_trans')">Arabic &amp; Terjemahaan</a>
								<a class="btn mushaf_arabic" href="javascript:void(0)" onclick="showMushaf('mushaf_arabic')">Arabic</a>
								<a class="btn mushaf_trans" href="javascript:void(0)" onclick="showMushaf('mushaf_trans')">Terjemahaan</a>
							</div>
						</div>
						<!-- /mushaf-display -->

						<?php  $a=0;foreach($ayats as $ayat): ?>
						
						<?php if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) ):?>
						<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0 play_0" >
							<div class="head_surah" >
							بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /ayat-section -->
						<?php $a++;endif?>
						
						<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?> play_<?php echo $a?>">
							<div class="pull-right arabic"> 
								<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
								<span class="content_ayat"><?php echo $ayat->text?> </span>
							</div>
							<div class="pull-left trans"> 
								<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
								<span class="trans_content"><?php echo $ayat->text_indo?></span>
							</div>
						</div>
						<?php $prev_surah = $ayat->surah?>
						<?php $a++; endforeach?>
					<?php endif?>
				</div>
				<!-- /mushaf -->
			</div>
		</div>
	</div>

	

	<script>
	function showMushaf(mushaf){
		jQuery('.mushaf').removeClass('mushaf_arabic_trans');
		jQuery('.mushaf').removeClass('mushaf_arabic');
		jQuery('.mushaf').removeClass('mushaf_trans');

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


		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');
	}
	</script>
	

@endsection