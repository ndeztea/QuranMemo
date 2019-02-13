<div class="modal-spacing">
@if($sortID > $eventDetail->quota)
<p class="alert alert-danger">Quota KSSM sudah abis dari quota <strong>{{$eventDetail->quota}} porsi</strong>, dan antum dalam waiting list</p>
@endif
<p>Nomor urutan pendaftaran : <strong>{{$sortID}}</strong></p>
<p><strong>Tunjukan code ini untuk pengambilan konsumsi</strong></p>
<!--img src="http://courtingthelaw.com/wp-content/uploads/QR-code-example.jpg" style="width:100%"/-->
<h1 class="code_access" style="text-align:center">{{$code_access}}</h2>
</div>
