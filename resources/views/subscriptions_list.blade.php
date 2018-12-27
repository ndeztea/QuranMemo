
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
					@if(session('sess_role')==1)
					<div class="timeline-koreksi filter">
					<ul class="nav nav-tabs" role="tablist">

						    <li role="presentation" class="@if(Request::input('status')=='') active @endif" style="margin: 0px;"><a href="{{url('subscription/listing')}}">Pending</a></li>
						    <li role="presentation" class="@if(Request::input('status')=='approval') active @endif" style="margin: 0px;"><a href="{{url('subscription/listing?status=approval')}}">Approval</a></li>
						    <li role="presentation" class="@if(Request::input('status')=='active') active @endif" style="margin: 0px;"><a href="{{url('subscription/listing?status=active')}}">Active</a></li>
						</ul>
					</div>
					@endif
					 <table width="100%" class="table">
					 	<thead>
						 	<th width="25">No</th>
						 	<th>Paket</th>
						 	<th>Total</th>
						 	<th>Status</th>
						 </thead>
						 <tbody>
						 <?php $a=1?>

						 @foreach($orderList as $order)
						 <?php
						 	/*if($order->active==1){
						 		if(strtotime($order->expired_date) < strtotime(now())){
						 			$status = 'Expired';
						 			$statusClass = 'danger';
						 		}else{
						 			$status = 'Active';
						 			$statusClass = 'primary';
						 		}
						 	}else{
						 		if($order->status==1){
						 			$status = 'Konfirmasi';
						 			$statusClass = "Warning";
						 		}else{
						 			$status = 'Pending';
						 			$statusClass = 'danger';
						 		}
						 	}*/
						 	if($order->status==1){
					 			$status = 'Approval';
					 			$statusClass = "warning";
					 		}else{
					 			$status = 'Pending';
					 			$statusClass = 'danger';
					 		}
						 ?>
						 <tr>
						 	<td class="center">{{$a++}}</td>
						 	<td>Paket {{ucfirst(array_keys($level,$order->level)[0])}}
						 	@if(session('sess_role')==1)
						 		<br>
						 		{{$order->name}}<br>
						 		<a class="label label-success" href="https://api.whatsapp.com/send?phone={{$order->hp}}" target="_blank">{{$order->hp}}</a>
						 	@endif
						 	@if($order->note)
						 	<p class="order-detail"><strong>Pesan dari admin</strong><br>{{$order->note}}</p>
						 	@endif
						 	</td>
						 	<td>Rp. {{number_format($order->price,0,',','.')}}</td>
						 	<td>
						 		<label class="label label-{{$statusClass}}">{{$status}}</label>
						 	</td>
						 </tr>
						 <tr>
							 	<td colspan="4">
									<a href="{{url('subscription/cancel/'.$order->id)}}" style="font-size:20px"><label class="label label-danger">Cancel!</a>
							 		<a href="javascript:void(0)" onclick="checkPurchase('subs_paket_{{strtolower(array_keys($level,$order->level)[0])}}')" style="font-size:20px"><label class="label label-danger">Cek Langganan</a>

							 		@if($status=='Pending' && session('sess_role')!=1)
							 		<a href="{{url('subscription/confirmation/'.$order->id)}}" style="font-size:20px"><label class="label label-primary">Konfirmasi Bayar</label></a>
							 		@endif

							 		@if(session('sess_role')==1 && $status=='Approval')
										<br>
								 		@if($order->file)
								 			<a href="{{url($order->file)}}" style="font-size:20px"><label class="label label-primary"><i class="fa fa-download"></i>Pembayaran</label></a>
								 		@endif
								 		@if(Request::input('status')=='active')
								 			<?php $daysLeft = Carbon::now()->diffInDays(Carbon::createFromTimeStamp(strtotime($order->expired_date)),false)?>
											<span class='label label-success'>Aktif {{$daysLeft}} hari  </span>&nbsp;
								 		@else
								 			<a href="{{url('subscription/approve/'.$order->id)}}" style="font-size:20px"><label class="label label-primary">Approve!</a>
								 			<a href="javascript:void(0)" onclick="notvalid('{{url('subscription/notvalid/'.$order->id)}}')" style="font-size:20px"><label class="label label-warning">Not Valid!</a>
								 		@endif
										<span class='label label-success'>Rp. {{number_format($order->paid,0,',','.')}}</span>
							 		@endif
								<td>
							 <tr>
						 @endforeach
						 </tbody>
					 	</table>
					 </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form action="" id="subsForm" style="display: none">
	<textarea name="note" id="note"></textarea><input type="submit" name="btnSubmit">
</form>
<script>
	function notvalid(url){
		vex.dialog.prompt({
		    message: 'Catatan ',
		    placeholder: '',
		    callback: function (value) {
		        $('#subsForm').attr('action',url)
		        $('#note').val(value);
		        $('#subsForm').submit();
		    }
		})
		$('.vex-dialog-prompt-input').val('Bismillah..Apakah  sudah di transfer? saya lihat konfirmasi sudah masuk tapi transferan belum masuk. Syukron');
	}

</script>
@endsection
