<form style="padding:0px 10px">
		<!--div class="form-group display-inline-block-xs">
			<strong>Yang test : </strong> {{session('sess_name')}} ({{session('sess_email')}})
		</div-->
		<div >
			<strong>Catatan untuk hafalan ini</strong>
			<textarea class="form-control" id="note" placeholder="Masukan catatan yang di dapat ketika mengetes hafalan ini" name="note" style="height: 100px"></textarea>
			@if(session('sess_role')==2 || session('sess_role')==1)
			<table style="margin-top:5px;">
				<tr>
					<td style="width:207px">
					<div class="btn-group memoz-starts" role="group" aria-label="...">
					  <button type="button" class="btn btn-default" onclick="QuranJS.memozStar(this,0,0)"><i class="fa fa-refresh"></i></button>
					  <button type="button" class="btn btn-default" onclick="QuranJS.memozStar(this,1,10)"><i class="fa fa-star"></i></button>
					  <button type="button" class="btn btn-default" onclick="QuranJS.memozStar(this,2,20)"><i class="fa fa-star"></i> <i class="fa fa-star"></i></button>
					  <button type="button" class="btn btn-default" onclick="QuranJS.memozStar(this,3,30)"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </button>
					</div>
				</td>
				<td>
					<input type="text" class="form-control points" placeholder="Pts" name="points" style="font-size: 30px;text-align: center;" aria-describedby="basic-addon1">
				</td>
				</tr>
			</table>
			<br class="clear"/>
			<input type="hidden" class="status_memoz_correction" name="status_memoz_correction" value="">
			<a class="btn btn-default" style="font-size: 16px;margin-top:5px" onclick="recordAudio('ustadz');"><i class="fa fa-microphone" style="color:red"></i> Rekam audio koreksi</a>
			<input type="text" name="record_file" id="record_file" value="" style="display: none"/>
			
			@endif
		</div>
		
		<button class="btn btn-cari-ayat btn-save-memoz btn-green" type="submit" name="btnSubmit" onclick="fbq('track', 'clickSimpanKoreksi');QuranJS.saveMemozCorrection();return false;">
		<span class="label-save"><i class="fa fa-send"></i><span class="sr-only"></span> Kirim</span>
		<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
		</button>
</form>