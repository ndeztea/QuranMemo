<div class="container-segmented">
<h4>Muratal</h4>
  <select class="form-control" name="muratal" id="muratal" onchange="QuranJS.configMuratal(this.value)">
    @foreach($arr_muratal_list as $key=>$val)
    <option value="{{$key}}" {{$key==$muratal?'selected':''}}>{{$val}}</option>
    @endforeach
  </select>
  <div class="muratal_modified" style="display:none"><a href="javascript:location.reload()" style="color:#4DB578">Refresh</a> dahulu untuk mengganti muratal.</div>
  <br>
  
  <h4>Ulangi muratal per-ayat</h4>
  <div class="segmented-control" style="width: 100%; color: #4DB578">
    <input type="radio" name="sc-1-1" id="sc-1-1-1" {{$repeat==1?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-2" {{$repeat==5?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-4" {{$repeat==10?'checked':''}}>
    <input type="radio" name="sc-1-1" id="sc-1-1-6" {{$repeat==20?'checked':''}}>

    <label for="sc-1-1-1" data-value="1x" onclick="$('.repeat').val(1)">1x</label>
    <label for="sc-1-1-2" data-value="5x" onclick="$('.repeat').val(5)">5x</label>
    <label for="sc-1-1-4" data-value="10x" onclick="$('.repeat').val(10)">10x</label>
    <label for="sc-1-1-6" data-value="20x" onclick="$('.repeat').val(20)">20x</label>
  </div>
 </div>