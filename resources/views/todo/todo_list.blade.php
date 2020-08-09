@extends('layouts.master')

@section('title', 'Laporan Ibadah')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			@if(session('sess_role')==2 || session('sess_role')==1)
			<div class="filter">
				<ul class="nav nav-tabs">
					<li class="active"  style="width: 50%"><a href="#">Harian</a></li>
					<li style="width: 50%"><a href="{{url('todo_range/'.$idUser)}}" >Range Tanggal</a></li>
				</ul>
			</div>
			@endif
			<div class="single-column">
				<div class="ads-middle" style="padding:13px">
					<div class="action-left" style="float: left;font-size: 21px; position: relative;top: -4px;">
						<a href="{{url('todo/'.$prevDay.'/'.$idUser)}}"><i class="fa fa-chevron-circle-left"></i></a>
					</div>
					@if ($nextDay>=0)
					<div class="action-right" style="float: right;font-size: 21px;position: relative;top: -4px;">
						<a href="{{url('todo/'.$nextDay.'/'.$idUser)}}"><i class="fa fa-chevron-circle-right"></i></a>
					</div>
					@endif
					{{$date_now}} - {{session('sess_city')}}
				</div>
				@if($idUser)
				<div class="dash-profile" style="background:linear-gradient(#6db9b0, #fff);">

			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{!empty($detailProfile)?$detailProfile->name:'Tamu'}}</h4>
								<h2 class='label label-danger'>Kelas : {{$classDetail->class}} @if (!empty($subClassDetail)) {{$subClassDetail->class}} @endif</h2>
							</div>
						</div>
						<!--/dash-profile-detail-->
					</div>

			  </div>
				@endif

					<button class="btn btn-green" style="
		    border-radius: 0;
		    font-size: 21px;
		" onclick=" QuranJS.callModal('mytodo/stars/{{$idUser}}') "><i class="fa fa fa-star" ></i> Checklist saya</button>
				<div class="filter">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"  style="width: 50%"><a href="#wajib" role="tab" data-toggle="tab">Wajib</a></li>
						<li role="presentation" style="width: 50%"><a href="#sunnah" role="tab" data-toggle="tab">Sunnah</a></li>
					</ul>
				</div>
				<div class="prayerTimesExample"></div>
				<div class="container-fluid">
					<div class="todo">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="wajib">
								<ul style="padding:0px !important" >
										@foreach($listTodosOne as $todoOne)
						    		<li class="card default" id="todo_{{$todoOne->id}}"  onclick="@if (session('sess_id')) QuranJS.callModal('todo/form_wajib/{{$todoOne->id}}/{{$date}}') @else QuranJS.callModal('auth/login') @endif">
											<i class="fa fa-circle"></i>
											<div class="card_content">
								        <div class="card_title"> {{$todoOne->todo}}</div>
												<div class="card_time badge">{{$sholatTime[$todoOne->id]}} WIB</div>
												<div class="note"></div>
											</div>
							      </li>
										@endforeach
						    </ul>
							</div>

							<div role="tabpanel" class="tab-pane" id="sunnah">
								<ul style="padding:0px !important" >
										@foreach($listTodosTwo as $todoTwo)
										<li class="card default" id="todo_{{$todoTwo->id}}" onclick="QuranJS.callModal('todo/form_sunnah/{{$todoTwo->id}}/{{$date}}')">
											<i class="fa fa-circle"></i>
											<div class="card_content">
												<a href="javascript:void">
								        <span class="card_title"> {{$todoTwo->todo}}</span></a>
												<br class="clear">
												<div class="note"></div>
											</div>
							      </li>
										@endforeach
						    </ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- single-column -->
		</div>
		<!-- main-content -->
	</div>
	<!-- main-content-wrap -->
</div>
<!-- wrap -->
<script>
$(document).ready(function(){
	$('#register_dob').datepicker({
      format: "yyyy-mm-dd",
      clearBtn: true,
      autoclose: true,
      todayHighlight: true
  	});
		obj = new Object()
		@foreach ($dataList as $dataRow)
		<?php
			$dataParam = json_decode($dataRow->params);
		?>
		obj.id_todo = '{{$dataRow->id_todo}}';
		obj.done = '{{$dataRow->done}}';
		obj.qobliyah = '{{@$dataParam->qobliyah}}';
		obj.badiyah = '{{@$dataParam->badiyah}}';
		obj.masjid = '{{@$dataParam->masjid}}';
		note = '{{trim(preg_replace( "/\r|\n/", "", @$dataParam->note ))}}'
		obj.note = note;
		obj.waktu = '{{@$dataParam->waktu}}';
		setCardTodo(obj)
		@endforeach

		var d = new Date();
		var year = d.getFullYear();
		var month = d.getMonth();
		var date = d.getDate()+1;
		var monthNames = [
	    "January", "February", "March",
	    "April", "May", "June", "July",
	    "August", "September", "October",
	    "November", "December"
	  ];

		var countDownDate = new Date(year+"-"+monthNames[month]+"-"+date+" 04:41:00").getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {
		  // Get todays date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  jQuery('.countdown').html( hours + " jam "
		  + minutes + " min ");

		  // If the count down is finished, write some text
		  if (distance < 0) {
		    clearInterval(x);
		    document.getElementById("demo").innerHTML = "EXPIRED";
		  }
		}, 1000);
});

function showMengerjakan(val){
	console.log(val);
	if (val==1){
			jQuery('#mengerjakan').slideDown()
	}
	else {
			jQuery('#mengerjakan').slideUp()
	}
}

function submitTodo(){
	jQuery('.label-todo-loading').show();
	var form = $('#form_todo');
	var url = form.attr('action');

 $.ajax({
		type: "POST",
		url: url,
		data: form.serialize(), // serializes the form's elements.
		success: function(data)
		{
			setCardTodo(data)
			jQuery('.label-todo-loading').hide();
			$('#QuranModal').modal('toggle');
			//vex.dialog.alert({ unsafeMessage: 'Data sudah disimpan' });
		}
	});
}

function setCardTodo(obj){
	jQuery('#todo_'+obj.id_todo).removeClass('default');
	jQuery('#todo_'+obj.id_todo).removeClass('done');
	jQuery('#todo_'+obj.id_todo).removeClass('not_done');
	jQuery('#todo_'+obj.id_todo+' i.fa').removeClass('fa-star');
	jQuery('#todo_'+obj.id_todo+' i.fa').removeClass('fa-times-circle');
	jQuery('#todo_'+obj.id_todo+' i.fa').removeClass('fa-circle');
	jQuery('#todo_'+obj.id_todo+' div.note').html('');

	if(obj.done==1){
		jQuery('#todo_'+obj.id_todo).addClass('done');
		jQuery('#todo_'+obj.id_todo+' i.fa').addClass('fa-star');
		if(obj.waktu!=''){
			jQuery('#todo_'+obj.id_todo+' div.note').prepend('<i class="fa fa-check-circle"></i> '+obj.waktu);
		}
		if(obj.badiyah==1){
			jQuery('#todo_'+obj.id_todo+' div.note').prepend('<i class="fa fa-check-circle"></i> Badiyah ');
		}
		if(obj.qobliyah==1){
			jQuery('#todo_'+obj.id_todo+' div.note').prepend('<i class="fa fa-check-circle"></i> Qobiyah ');
		}
		if(obj.masjid==1){
			jQuery('#todo_'+obj.id_todo+' div.note').prepend('<i class="fa fa-check-circle"></i> di Masjid ');
		}
	}else{
		jQuery('#todo_'+obj.id_todo).addClass('not_done');
		jQuery('#todo_'+obj.id_todo+' i.fa').addClass('fa-times-circle');
	}

	jQuery('#todo_'+obj.id_todo+' div.note').append('<br><i>'+obj.note+'</i>');

}

</script>
@endsection
