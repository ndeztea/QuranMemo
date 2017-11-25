@extends('layouts.master_email')

@section('content')
<p>
Assalamualaikum, wr wb {{$emailData['name']}}
</p>
<div class="order-detail">
	<p>Pesan langganan <strong>{{strtoupper($emailData['level'])}}</strong>, dengan total : </p>
	@if($emailData['active']==0)
	<div class="price">Rp. {{number_format($emailData['price'],2,',','.')}} *</div>
	<p>Transfer melalui rekening Bank Muamalat  :
	<div class="rekening">1460000303 <br>an <br>Dimas Tekad Santosa</div>
	<hr>
	<br>
	<a type="submit" class="btn btn-green" href="{{$emailData['url']}}" style="width:96%">Konfirmasi Pembayaran</a>
	@else
	<div class="price"><strike>Rp. {{number_format($emailData['price'],2,',','.')}} *</strike><br> LUNAS </div>
	<div class="price">Aktif sampai <br> {{$emailData['expired_date']}}</div>
	@endif
</div>

@endsection