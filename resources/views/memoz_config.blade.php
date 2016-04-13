<div class="container-segmented">
  <h4>Ulangi muratal per-ayat</h4>
  <div class="segmented-control" style="width: 100%; color: #5FBAAC">
    <input type="radio" name="sc-1-1" id="sc-1-1-1" {{$repeat==1?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-2" {{$repeat==2?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-3" {{$repeat==3?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-4" {{$repeat==4?'checked':''}}>

    <label for="sc-1-1-1" data-value="1x" onclick="$('.repeat').val(1)">1x</label>
    <label for="sc-1-1-2" data-value="2x" onclick="$('.repeat').val(2)">2x</label>
    <label for="sc-1-1-3" data-value="3x" onclick="$('.repeat').val(3)">3x</label>
    <label for="sc-1-1-4" data-value="4x" onclick="$('.repeat').val(4)">4x</label>
  </div>
 </div>