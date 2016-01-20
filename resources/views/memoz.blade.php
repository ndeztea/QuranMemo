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

	<?php if(!empty($ayats)):?>
	
	@include('players')
	Ulangi 
	<select name="repeat" class="repeat">
		<option value="1">1 kali</option>
		<option value="2">2 kali</option>
		<option value="3">3 kali</option>
		<option value="4">4 kali</option>
		<option value="5">5 kali</option>
	</select> | 
	<input type="checkbox" name="repeat_ayat" class="repeat_ayat" value="1"/> Ulangi Ayat | 
	<input type="checkbox" name="repeat_surah" class="repeat_ayat"  value="1"/> Ulangi Surah

	<div class="mushaf">
	
		<div class="mushaf_display">
			<a href="javascript:void(0)" onclick="showMushaf('mushaf_arabic_trans')" class="mushaf_arabic_trans selected">Arabic &nbsp; Terjemahaan</a>
			<a href="javascript:void(0)" onclick="showMushaf('mushaf_arabic')" class="mushaf_arabic">Arabic</a>
			<a href="javascript:void(0)" onclick="showMushaf('mushaf_trans')" class="mushaf_trans">Terjemahaan</a>
		</div>
		<?php foreach($ayats as $ayat):?>
		
		<?php if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) ):?>
		<div class="ayat_section  section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0">
			<div class="head_surah" >
			بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
			</div>
			<div class="clearfix"></div>
		</div>
		<?php endif?>
		
		<div class="ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
			<div class="arabic"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text?> </div>
			<div class="clearfix"></div>
			<div class="trans"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text_indo?> </div>
		</div>
		<?php $prev_surah = $ayat->surah?>
		<?php endforeach?>
	
	</div>
	<?php else:?>
		<p class="warning">Tentukan surah dan ayat yang Anda ingin hafal</p>
	<?php endif?>

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