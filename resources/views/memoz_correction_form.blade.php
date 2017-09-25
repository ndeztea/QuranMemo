<form class="form-inline">
		<div class="form-group display-inline-block-xs">
			<strong>Yang test : </strong> {{session('sess_name')}} ({{session('sess_email')}})
		</div>
		<div class="form-group display-inline-block-xs">
			<strong>Catatan untuk hafalan ini</strong>
			<textarea class="form-control" id="note" placeholder="Masukan catatan yang di dapat ketika mengetes hafalan ini" name="note"></textarea>
		</div>
		
		<button class="btn btn-cari-ayat btn-save-memoz" type="submit" name="btnSubmit" onclick="fbq('track', 'clickSimpanKoreksi');QuranJS.saveMemozCorrection();return false;">
		<span class="label-save"><i class="fa fa-floppy-o"></i><span class="sr-only"></span> Simpan</span>
		<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
		</button>
</form>