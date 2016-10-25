<form class="form-inline">
		<br>
		<div class="form-group display-inline-block-xs">
			<textarea class="form-control" id="note" placeholder="Catatan" name="note"></textarea>
		</div>
		
		<button class="btn btn-cari-ayat btn-save-memoz" type="submit" name="btnSubmit" onclick="QuranJS.saveMemozCorrection();return false;">
		<span class="label-save"><i class="fa fa-floppy-o"></i><span class="sr-only"></span> Simpan</span>
		<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
		</button>
</form>