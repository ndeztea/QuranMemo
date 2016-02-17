@extends('layouts.master')

@section('title', 'Mushaf')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
	@include('players')

	<div class="nav-top clearfix">
		<h1><?php echo $surah?> ayat <?php echo $ayat?></h1>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( Request::url() )?>" target="_blank"><i class="fa fa-share-alt"></i></a>
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
						
						<div class="clearfix ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
							<div class="pull-right arabic"> 
								<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
								<span class="content_ayat"><?php echo $ayat->text?> </span>
							</div>
							<div class="pull-left trans"> 
								<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
								<span class="trans_content"><?php echo $ayat->text_indo?></span>
							</div>
							<div class="action-footer">
								<a href="javascript:;" class="play_<?php echo $a?>"><i class="fa fa-play"></i></a>
								<!--a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) )?>" target="_blank"><i class="fa fa-share-alt"></i></a-->
								<a href="<?php echo url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)?>"><i class="fa fa-share-alt"></i></a>
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
			jQuery('.arabic').css('width','50%');
			jQuery('.trans').css('width','50%');
		}else if(mushaf=='mushaf_arabic'){
			jQuery('.trans').hide();
			jQuery('.arabic').show();
			jQuery('.arabic').css('width','100%');
			jQuery('.trans').css('width','100%');
		}else if(mushaf=='mushaf_trans'){
			jQuery('.trans').show();
			jQuery('.arabic').hide();
			jQuery('.arabic').css('width','100%');
			jQuery('.trans').css('width','100%');
		}


		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');
	}
	</script>
	

@endsection