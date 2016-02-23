@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = '';  ?>
@section('content')
	<div class="nav-top clearfix">
		<div class="row">
			<div class="col-xs-12 col-sm-7 -col-md-7">
				<form action="" method="post">
					<div class="select-surah">
						Surah
						<div class="form-group">
							<select name="surah_start" class="form-control">
								<?php foreach($surahs as $surah):?>
								<option <?php echo $surah->id==$surah_start?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?> (<?php echo $surah->type?>)</option>
								<?php endforeach?>
							</select>
						</div>
						<div class="form-group display-inline-block-xs">
							<input type="text" name="ayat_start" value="<?php echo $ayat_start?$ayat_start:''?>">
						</div>
						<div class="checkbox display-inline-block-xs">
							<label>
								<input type="checkbox" value="1" id="fill_ayat_end" <?php echo !empty($fill_ayat_end)?'checked':''?> name="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)">  <span>Sampai surah </span>
							</label>
						</div>

						<div  class="form-group ayat_end" style="display:none">
							<select name="surah_end" class="form-control ">
								<?php foreach($surahs as $surah):?>
								<option <?php echo $surah->id==$surah_end?'selected':''?>  value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?>  (<?php echo $surah->type?>)</option>
								<?php endforeach?>
							</select>
						</div>
						<div class="checkbox display-inline-block-xs  ayat_end"  style="display:none">
							<input type="text" name="ayat_end" class="form-control" value="<?php echo $ayat_end?$ayat_end:''?>">
						</div>

						<input type="submit" value="Cari" name="btnSubmit"/>
						<input type="text" name="repeat_ayat" class="repeat_ayat" value="1"/>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php if(!empty($ayats)):?>
	<div class="memoz_player">
		@include('players')
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
	</div>
	
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
	$(document).ready(function(){
		QuranJS.fillAyatEnd();
	});
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