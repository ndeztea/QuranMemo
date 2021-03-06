<div class="modal-spacing">
	<div class="container-segmented">
		<h4>Muratal</h4>
		<select class="form-control" name="muratal" id="muratal" onchange="fbq('track', 'clickChangeMuratal');QuranJS.configMuratal(this.value,{{$level}})">
			@foreach($arr_muratal_list as $key=>$val)
			<option value="{{$key}}" {{$key==$muratal?'selected':''}}>{{$val}}</option>
			@endforeach
		</select>
		<div class="muratal_modified" style="display:none"><a href="javascript:location.reload()" style="color:#00978A">Refresh</a> dahulu untuk mengganti muratal.</div>
		<br>

		<h4>Tampilkan Mushaf</h4>
		<div class="segmented-control" style="width: 100%; color: #00978A">
			<input type="radio" name="sc-1-1" id="sc-1-1-1" {{$mushaf_layout=='mushaf_arabic_trans'?'checked':''}}>
			<input type="radio" name="sc-1-1" id="sc-1-1-2" {{$mushaf_layout=='mushaf_arabic'?'checked':''}}>
			<input type="radio" name="sc-1-1" id="sc-1-1-3" {{$mushaf_layout=='mushaf_trans'?'checked':''}}>

			<label for="sc-1-1-1" data-value="AT" onclick="fbq('track', 'clickAT');QuranJS.showMushaf('mushaf_arabic_trans')">AT</label>
			<label for="sc-1-1-2" data-value="Arabic" onclick="fbq('track', 'clickArabic');QuranJS.showMushaf('mushaf_arabic')">Arabic</label>
			<label for="sc-1-1-3" data-value="Terjemahan" onclick="fbq('track', 'clickTerjemah');QuranJS.showMushaf('mushaf_trans')">Terjemahan</label>
		</div>
	</div>
		<div class="container-segmented">
			<h4>Tampilkan warna tajwid</h4>
			<div class="segmented-control" style="width: 100%; color: #00978A">
				<input type="radio" name="sc-1-4" id="sc-1-1-8" {{$tajwid=='true'?'checked':''}}>
				<input type="radio" name="sc-1-4" id="sc-1-1-9" {{$tajwid==''?'checked':''}}>

				<label for="sc-1-1-8" data-value="Ya" onclick="fbq('track', 'clickWarnaYes');QuranJS.showTajwid('true')">Ya</label>
				<label for="sc-1-1-9" data-value="Tidak" onclick="fbq('track', 'clickWarnaNo');QuranJS.showTajwid('false')">Tidak</label>
			</div>
			<div class="tajwid_modified" style="display:none"><a href="javascript:location.reload()" style="color:#00978A">Refresh</a> dahulu untuk merubah tampilan tajwid.</div>
			<br>

		</div>

	<div class="container-segmented">
		<h4>Tampilkan <i>footer action</i></h4>
		<div class="segmented-control" style="width: 100%; color: #00978A">
			<input type="radio" name="sc-1-3" id="sc-1-1-6" {{$footer_action=='true'?'checked':''}}>
			<input type="radio" name="sc-1-3" id="sc-1-1-7" {{$footer_action=='false'?'checked':''}}>

			<label for="sc-1-1-6" data-value="Ya" onclick="fbq('track', 'clickFooterYes');QuranJS.showMushafAction(true);">Ya</label>
			<label for="sc-1-1-7" data-value="Tidak" onclick="fbq('track', 'clickFooterNo');QuranJS.showMushafAction(false);">Tidak</label>
		</div>
	</div>

	<div class="container-segmented">
		<h4>Pindah hafalan otomatis ketika muratal berjalan</h4>
		<div class="segmented-control" style="width: 100%; color: #00978A">
			<input type="radio" name="sc-1-2" id="sc-1-1-4" {{$automated_play=='true'?'checked':''}}>
			<input type="radio" name="sc-1-2" id="sc-1-1-5" {{$automated_play=='false'?'checked':''}}>

			<label for="sc-1-1-4" data-value="Ya" onclick="fbq('track', 'clickAutoYes');QuranJS.autoPlay('true')">Ya</label>
			<label for="sc-1-1-5" data-value="Tidak" onclick="fbq('track', 'clickAutoNo');QuranJS.autoPlay('false')">Tidak</label>
		</div>
	</div>
</div>
