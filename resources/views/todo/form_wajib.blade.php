 <div class="modal-spacing">
  <form method="post" id="form_todo" action="{{url('todo/save')}}">
    <select class="form-control form-control-lg" name="done" onchange="showMengerjakan(this.value)">
      <option value="1">Mengerjakan</option>
      <option value="0">Tidak Mengerjakan</option>
    </select>
    <hr>
    @if ($type=='form_wajib')
      <div id="mengerjakan">
        <label>Waktu Mengerjakan</label>
        <select class="form-control form-control" name="waktu">
          @foreach ($arrWaktu as $waktu)
          <option value="{{$waktu}}">{{$waktu}}</option>
          @endforeach
        </select>
        <br>
        @if ($id_todo==1 || $id_todo==2)
        <label>Sunnah Qobliyah</label>
        <select class="form-control form-control" name="qobliyah">
          <option value="1">Iya</option>
          <option value="0">Tidak</option>
        </select>
        <br>
        @endif
        @if ($id_todo==2 || $id_todo==4 || $id_todo==5)
        <label>Sunnah Ba'diyah</label>
        <select class="form-control form-control" name="badiyah">
          <option value="1">Iya</option>
          <option value="0">Tidak</option>
        </select>
        <br>
        @endif
        <label>Sholat di Masjid Berjamaah</label>
        <select class="form-control form-control" name="masjid">
          <option value="1">Iya</option>
          <option value="0">Tidak</option>
        </select>
        <br>
      </div>
    @endif
    <label>Catatan</label>
    <textarea name="note" class="form-control" rows="3" placeholder="@if($type=='form_wajib') Masukan jam sholat, tepat waktu atau tidak @endif"></textarea>
    <input value="{{$id_todo}}" type="hidden" name="id_todo" />
    <input value="{{$date}}" type="hidden" name="date" />
  </form>
  <br>
  <!--button class="btn btn-green-small info" onclick="submitTodo()" style="width: 100%;"><i class="fa fa-cog fa-spin fa-3x fa-fw label-todo-loading " style="display: none;"></i>Laporkan</button-->
</div>
