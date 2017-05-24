@extends('layouts.master')

@section('title', 'Manage Notes')

@section('content')
<div class="modal-spacing">
	<form action="" method="post">
	<p>
	<?php echo trans('trans.surah_awal') ?> :    
	<select name="surah_start" onchange="QuranJS.changeSurah(this)">
		<?php foreach($surahs as $surah):?>
		<option  <?php echo $surah->id==$notesDetail->surah_start?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
		<?php endforeach?>
	</select>
	<input type="text" nama="ayat_start" value="<?php echo $notesDetail->surah_start?>"/>
	<br>
	</p>

	<p>
	<?php echo trans('trans.surah_akhir')  ?> : 
	<select name="surah_end" onchange="QuranJS.changeSurah(this)">
		<?php foreach($surahs as $surah):?>
		<option  <?php echo $surah->id==$notesDetail->surah_start?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
		<?php endforeach?>
	</select>
	<input type="text" nama="ayat_awal" value="<?php echo $notesDetail->ayat_awal?>"/>
	<br>
	</p>

	<p>
	<?php echo trans('trans.subject')?> : 
	<input type="text" name="subject" value="<?php echo $notesDetail->subject?>"/>
	<br>
	</p>

	<p>
	<?php echo trans('trans.note')?> : 
	<textarea name="note"><?php echo $notesDetail->note?></textarea>
	<br>
	</p>
	
	</form>
</div>


@endsection