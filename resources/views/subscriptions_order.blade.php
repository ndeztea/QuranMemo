
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
						<div class="order-detail" style="background: #e1ffeb;border: 1px solid #e1ffeb;">
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
						</div>
						<br>
						<div class="order-detail">
							@if($detail->active==0)
							<p>Bayar Potong Pulsa / Debit / Kredit Card <br><sup>(Hanya untuk "QuranMemo Community" versi > 1.4.0)</sup></p>
							<?php
								$detail->length = $detail->length==0?31:$detail->length;
								$subsPrefix = 'subs_';
								$length = '';
								if($detail->length>31){
									$subsPrefix = '';
								}
								switch ($detail->length) {
									case '90':
										$length = '_3bulan';
										break;
									case '180':
										$length = '_6bulan';
										break;
									case '360':
										$length = '_1tahun';
										break;
								}
							?>
							<div class="rekening"><button type="button" onclick="purchase('{{$subsPrefix}}paket_{{strtolower($detail->level)}}{{$length}}')" class="btn btn-green">Bayar Sekarang</button></div>
						</div>
						<br>
						<div class="order-detail">
							<p>Atau Transfer melalui rekening Bank Muamalat  :
							<div class="rekening">1460000303 <br>an <br>Dimas Tekad Santosa</div>
						</div>
						<br>
						<div class="order-detail" style="background-color: #ffd381;border: 1px solid #dea433;">
							<strong>Konfirmasi Pembayaran (Transfer Manual atau Potong Pulsa / Debit / Kredit Card )</strong>
							<input type="text" class="form-control" name="paid" id="paid" aria-label="paid" placeholder="Jumlah yang dibayar" value="{{ old('paid')}}" />
							<small>*) transfer sampai digit terakhir untuk memudahkan verifikasi</small><br>
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
