<form class="form-inline" id="paggingForm" action="{{url('buku')}}" method="post">
	<p>QuranMemo insyaAllah akan berbagi buku At-Tibyan Imam Nawawi, untuk antum yang menginginkan buku ini harap isi email di form dibawah ini, 3 orang yang paling aktif insyaAllah akan mendapatkan buku ini.</p>
  
  <div class="form-group">
    <div class="input-group">
      <input type="email" name="email" class="form-control col-xs-1 pagging" placeholder="Masukan email disini">
      <div class="input-group-addon"><a name="btnPage" onclick="paggingForm.submit()">Kirim</a> </div>
    </div>
  </div>
 <img src="{{url('assets/images/buku-attibyan.jpg')}}" style="width:100%" alt="At-tibyan">
</form>