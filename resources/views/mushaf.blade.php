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

		<a href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page-1?>"><?php echo trans('trans.prev')?></a>
		<select name="page" onchange="changePage(this)" >
			<?php foreach($pages as $page):?>
			<option  <?php echo $page->page==$curr_page?'selected':''?> value="<?php echo $page->page ?>"><?php echo $page->page ?></option>
			<?php endforeach?>
		</select>
		<a href="javascript:;" onclick="QuranJS.changePage(this)" data-value="<?php echo $curr_page+1?>"><?php echo trans('trans.next')?></a>
	</div>

	<div class="mushaf">
	<?php if(!empty($ayats)):?>
		<?php foreach($ayats as $ayat):?>
		
		<?php if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) ):?>
		<div class="ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0">
			<div class="head_surah arabic" >
			بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endif?>
		
		<div class="ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
			<div class="arabic"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text?> </div>
			<div class="clearfix"></div>
			<div class="indo"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text_indo?> </div>
		</div>
		<?php $prev_surah = $ayat->surah?>
		<?php endforeach?>
	<?php endif?>
	</div>

@endsection