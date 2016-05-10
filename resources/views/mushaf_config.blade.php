<div class="container-segmented">
	<h4>Tampilkan Mushaf</h4>
	<div class="segmented-control" style="width: 100%; color: #4DB578">
		<input type="radio" name="sc-1-1" id="sc-1-1-1" {{$mushaf_layout=='mushaf_arabic_trans'?'checked':''}}>
		<input type="radio" name="sc-1-1" id="sc-1-1-2" {{$mushaf_layout=='mushaf_arabic'?'checked':''}}>
		<input type="radio" name="sc-1-1" id="sc-1-1-3" {{$mushaf_layout=='mushaf_trans'?'checked':''}}>

		<label for="sc-1-1-1" data-value="AT" onclick="showMushaf('mushaf_arabic_trans')">AT</label>
		<label for="sc-1-1-2" data-value="Arabic" onclick="showMushaf('mushaf_arabic')">Arabic</label>
		<label for="sc-1-1-3" data-value="Terjemahan" onclick="showMushaf('mushaf_trans')">Terjemahan</label>
	</div>
 </div>

<div class="container-segmented">
	<h4>Tampilkan <i>footer action</i></h4>
	<div class="segmented-control" style="width: 100%; color: #4DB578">
		<input type="radio" name="sc-1-3" id="sc-1-1-6" {{$footer_action=='true'?'checked':''}}>
		<input type="radio" name="sc-1-3" id="sc-1-1-7" {{$footer_action=='false'?'checked':''}}>

		<label for="sc-1-1-6" data-value="Ya" onclick="QuranJS.showMushafAction(true);">Ya</label>
		<label for="sc-1-1-7" data-value="Tidak" onclick="QuranJS.showMushafAction(false);">Tidak</label>
	</div>
</div>

<div class="container-segmented">
	<h4>Pindah hafalan otomatis ketika muratal berjalan</h4>
	<div class="segmented-control" style="width: 100%; color: #4DB578">
		<input type="radio" name="sc-1-2" id="sc-1-1-4" {{$automated_play=='true'?'checked':''}}>
		<input type="radio" name="sc-1-2" id="sc-1-1-5" {{$automated_play=='false'?'checked':''}}>

		<label for="sc-1-1-4" data-value="Ya" onclick="$('.automated_play').val('true')">Ya</label>
		<label for="sc-1-1-5" data-value="Tidak" onclick="$('.automated_play').val('false')">Tidak</label>
	</div>
</div>