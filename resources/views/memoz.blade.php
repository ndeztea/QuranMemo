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
			<input type="text" name="repeat_ayat" class="repeat_ayat" value="1"/>
		</div>
	</form>

	<?php if(!empty($ayats)):?>
	<div class="memoz_player">
	@include('players')
	</div>
	Ulangi 
	<select name="repeat" class="repeat">
		<option value="1">1 kali</option>
		<option value="2">2 kali</option>
		<option value="3">3 kali</option>
		<option value="4">4 kali</option>
		<option value="5">5 kali</option>
	</select> | 
	<input type="checkbox" name="repeat_ayat" class="repeat_ayat selected" value="1"/> Ulangi Ayat | 
	<input type="checkbox" name="repeat_surah" class="repeat_ayat"  value="1"/> Ulangi Surah

	<div class="mushaf">
		<div class="steps">
			<a href="javascript:void(0)" onclick="steps('1')" class="steps_1 selected">Langkah 1</a>
			<a href="javascript:void(0)" onclick="steps('2')" class="steps_2">Langkah 2</a>
			<a href="javascript:void(0)" onclick="steps('3')" class="steps_3">Langkah 3</a>
			<a href="javascript:void(0)" onclick="steps('4')" class="steps_4">Langkah 4</a>
			<a href="javascript:void(0)" onclick="steps('5')" class="steps_5">Langkah 5</a>
		</div>
		<div class="steps_desc"><p>Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti.</p></div>

		<div class="actions">
			<button class="btn">Simpan Hafalan</button>
			<button class="btn btn-success">Sudah Hafal</button>

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
	<script type="text/javascript">
	function  steps(steps){
		if(steps==1){
			jQuery('.trans').show();
			jQuery('.arabic').show();
			jQuery('.steps_desc p').html('Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti.');
			jQuery('.memoz_player').show();
		}else if(steps==2){
			jQuery('.trans').hide();
			jQuery('.arabic').show();
			jQuery('.steps_desc p').html('Hafalkan dengan teliti target hafalan arabic');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==3){
			jQuery('.trans').show();
			jQuery('.arabic').show();
			jQuery('.steps_desc p').html('Hafalkan dengan teliti target hafalan arabic dan terjemahannya');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==4){
			jQuery('.trans').show();
			jQuery('.arabic').hide();
			jQuery('.steps_desc p').html('Hafalkan dengan teliti target terjemahannya');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==5){
			jQuery('.trans').show();
			jQuery('.arabic').show();
			jQuery('.steps_desc p').html('Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti, ulangi sampai hafal');
			jQuery('.memoz_player').show();
		}

		jQuery('.steps a').removeClass('selected');
		jQuery('.steps_'+steps).addClass('selected');
	}
	</script>

@endsection