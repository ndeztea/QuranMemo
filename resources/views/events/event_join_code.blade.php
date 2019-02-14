<div class="modal-spacing">
@if($sortID > $eventDetail->quota)
<p class="alert alert-danger">Nomor urut pendaftaran no <strong>{{$sortID}}</strong> Anda saat ini masih waiting list. Status anda akam berubah menjadi terdaftar apabila ada peserta terdaftar yang batal hadir ataupun ada penambahan kuota  makanan dari donatur.</p>
@else
<p class="alert alert-success">Anda telah terdaftar dengan no Urut : <strong>{{$sortID}}</strong>. Tunjukan Password ini untuk diganti dengan voucher di lokasi bukber.</p>

@endif
<!--img src="http://courtingthelaw.com/wp-content/uploads/QR-code-example.jpg" style="width:100%"/-->
<h1 class="code_access" style="text-align:center">{{$code_access}}</h2>
</div>
