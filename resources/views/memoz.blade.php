@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

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
				<option <?php echo $surah->id==$surah_end?'selected':''?>><?php echo $surah->id ?>. <?php echo $surah->surah_name ?></option>
				<?php endforeach?>
			</select>
			<input type="text" name="ayat_end" value="<?php echo $ayat_end?$ayat_end:''?>">
			<input type="submit" value="Cari" name="btnSubmit"/>
		</div>
	</form>

	

@endsection