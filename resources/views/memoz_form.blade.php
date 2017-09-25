<div class="modal-spacing">
<form class="form-inline" action="<?php echo url('memoz/search')?>" method="post" onsubmit="cookieLastMemo()">
		<!--span class="search-title">Surah</span-->
		<div class="form-group">
			<select name="surah_start"  id="surah_start" class="form-control">
				@foreach($surahs as $surah)
				<option {{$surah->id==$surah_start?'selected':''}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}}  {{$surah->ayat}} ayat)</option>
				@endforeach
			</select>
		</div>
		<!--div class="form-group display-inline-block-xs">
			<input class="form-control search_ayat" type="number" name="ayat_start" value="<?php echo $ayat_start?$ayat_start:''?>">
		</div>
		<!--div class="checkbox display-inline-block-xs">
			<label>
				<input type="checkbox" value="1" id="fill_ayat_end" <?php echo !empty($fill_ayat_end)?'checked':''?> name="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)">  <span>Sampai ayat </span>
			</label>
		</div>

		-->
		<div class="form-group display-inline-block-xs">
			<div class="input-group memoz-form">
			  <input class="form-control search_ayat" id="ayat_start" type="number" min="1" name="ayat_start" placeholder="Ayat awal" aria-label="Ayat awal"  value="{{$ayat_start?$ayat_start:''}}">
			  <span class="input-group-addon">Sampai</span>
			  <input class="form-control search_ayat" id="ayat_end" type="number" min="1" name="ayat_end" id="ayat_end" placeholder="Ayat akhir" aria-label="Ayat akhir"  value="{{$ayat_end?$ayat_end:''}}">
			</div>
		</div>

		<div class="input-daterange input-group" id="datepicker">
		    <input type="hidden" class="form-control"  id="date_start" type="text" name="date_start" placeholder="Tanggal awal" aria-label="Tanggal awal"  value="{{$date_start?$date_start:''}}" />
		    <!--span class="input-group-addon">Sampai</span-->
		    <input type="text" class=" form-control" type="text" readonly="readonly"  name="date_start" id="date_end" placeholder="target hafal" aria-label="Tanggal Akhir"  value="{{$date_end?$date_end:''}}" />
		</div>

		<br>
		<div class="form-group display-inline-block-xs">
			<textarea class="form-control" id="note" placeholder="Catatan" name="note">{{$note}}</textarea>
		</div>
		
		<button class="btn btn-cari-ayat btn-save-memoz" type="submit" name="btnSubmit" onclick="fbq('track', 'clickSimpanMemoz');QuranJS.saveMemoz('{{$id}}');return false;">
		<span class="label-save"><i class="fa fa-floppy-o"></i><span class="sr-only"></span> Simpan</span>
		<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
		</button>
</form>
</div>