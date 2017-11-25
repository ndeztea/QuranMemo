
@extends('layouts.master')

@section('title', 'Order')

@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			<div class="single-column">
				<div class="container-fluid">
					<div class="content-learning">
					 <form class="form-horizontal" action="{{url('subscription/confirmation/'.$detail->id)}}" method="post" enctype="multipart/form-data">
						<div class="order-detail">
							@if($detail->status==1)
							<p style="text-align: center;">Menunggu approvisasi</p>
							@endif
							<p>Pesan langganan <strong>{{strtoupper($detail->level)}}</strong>, dengan total : </p>
							@if($detail->active==1)
							<div class="price"><strike>Rp. {{number_format($detail->price,2,',','.')}} *</strike>
							<br>LUNAS</div>
							@else
							<div class="price">Rp. {{number_format($detail->price,2,',','.')}} *</div>
							@endif
							<small>*) transfer sampai digit terakhir untuk memudahkan verifikasi</small><br>
							@if($detail->active==0)
							<p>Transfer melalui rekening Bank Muamalat  :
							<div class="rekening">1460000303 <br>an <br>Dimas Tekad Santosa</div>
							<hr>
							<strong>Konfirmasi Pembayaran</strong>
							<input type="text" class="form-control" name="paid" id="paid" aria-label="paid" placeholder="Jumlah yang dibayar" value="{{ old('paid')}}" />
							<br>
							<strong>Bukti Pembayaran</strong>
							<input type="file" class="form-control" name="file" id="file"><br>
							<button type="submit" class="btn btn-green">Konfirmasi</button>
							@else
							<div class="rekening">Tersisa<br>
							<?php $days = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($detail->expired_date)),false)?>
							{{$days}} hari lagi
							</div>
							@endif
						</div>
						<input type="hidden" name="action" value="post"/>
					</form>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection