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