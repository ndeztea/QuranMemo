@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = '';  ?>
@section('content')
	<form action="" method="post">
		<div class="nav top">
			Surah dan ayat awal
			<select name="surah_start" >
				<?php foreach($surahs as $surah):?>
				<option <?php echo $surah->id==$surah_start?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
				<?php endforeach?>
			</select>
			<input type="text" name="ayat_start" value="<?php echo $ayat_start?$ayat_start:''?>">
			| 
			Surah dan ayat akhir
			<select name="surah_end" >
				<?php foreach($surahs as $surah):?>
				<option <?php echo $surah->id==$surah_end?'selected':''?>  value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
				<?php endforeach?>
			</select>
			<input type="text" name="ayat_end" value="<?php echo $ayat_end?$ayat_end:''?>">
			<input type="submit" value="Cari" name="btnSubmit"/>
		</div>
	</form>

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