@extends('layouts.master')

@section('title', 'Laporan Ibadah')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			@if(session('sess_role')==2 || session('sess_role')==1)
			<div class="filter">
				<ul class="nav nav-tabs" role="tablist">
					<li  style="width: 50%"><a href="{{url('todo/0/'.$idUser)}}" >Harian</a></li>
					<li  class="active"  style="width: 50%"><a href="#" >Range Tanggal</a></li>
				</ul>
			</div>
			@endif
			<div class="single-column">
				<div class="ads-middle">
					<form action="#" method="post" id="range_form">
						<div class="input-group" style="width:100%">
							<input type="text" class="form-control" value="{{$date_start}}" readonly placeholder="Awal" name="date_start" id="date_start">
						  <span class="input-group-addon">s.d</span>
							<input type="text" class="form-control" value="{{$date_end}}" readonly placeholder="Akhir"  name="date_end" id="date_end">
						  <span class="input-group-addon" onclick="$('#range_form').submit()"><i class="fa fa-search"></i> Tampilkan</span>
						</div>
					</form>
					<br class="clearfix"/>
				</div>

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
				@if($date_start && $date_end)
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
							<div role="tabpanel" class="tab-pane active" id="wajib" style="padding:10px">
								<ul class="summary">
										@foreach($listTodosOne as $todoOne)
										<li>
										<strong>{{$todoOne->todo}}</strong>
										<canvas id="myChart" class="myChart_{{$todoOne->id}}" height="400"></canvas>
										<hr>
										</li>
										@endforeach
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="sunnah">
								<ul class="summary">
										@foreach($listTodosTwo as $todoTwo)
										<li>
										<strong>{{$todoTwo->todo}}</strong>
										<canvas id="myChart" class="myChart_{{$todoTwo->id}}" height="400"></canvas>
										<hr>
										</li>
										@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endif
			</div>
			<!-- single-column -->
		</div>
		<!-- main-content -->
	</div>
	<!-- main-content-wrap -->
</div>
<!-- wrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script>
$(document).ready(function(){
	$('#date_end,#date_start').datepicker({
      format: "yyyy-mm-dd",
      clearBtn: true,
      autoclose: true,
      todayHighlight: true
  });

	@if($date_start && $date_end)

	@foreach($listTodosOne as $todoOne)
	generateChart2('.myChart_{{$todoOne->id}}','{{$todoOne->done}}','{{$todoOne->done_late}}','{{$todoOne->not_done}}','{{$todoOne->left}}')
	@endforeach

	@foreach($listTodosTwo as $todoTwo)
	generateChart('.myChart_{{$todoTwo->id}}','{{$todoTwo->done}}','{{$todoTwo->not_done}}','{{$todoTwo->left}}')
	@endforeach

	function generateChart(elm,done,not_done,left){
		var ctx = $(elm);
		var myChart = new Chart(ctx, {
			type: 'pie',
				data: {
					datasets: [{
						data: [
							done,
							not_done,
							left
						],
						backgroundColor: [
							'#bae4e0',
							'#e4baba',
							'#dddddd'
						],
						label: 'Dataset 1'
					}],
					labels: [
						'✔',
						'✘',
						'Ø'
					]
				},
				options: {
					responsive: true
				}

		});
	}

	function generateChart2(elm,done,done_late,not_done,left){
		var ctx = $(elm);
		var myChart = new Chart(ctx, {
			type: 'pie',
				data: {
					datasets: [{
						data: [
							done,
							done_late,
							not_done,
							left
						],
						backgroundColor: [
							'#bae4e0',
							'#f2f3c4',
							'#e4baba',
							'#dddddd'
						],
						label: 'Dataset 1'
					}],
					labels: [
						'✔',
						'≈',
						'✘',
						'Ø'
					]
				},
				options: {
					responsive: true
				}

		});
	}
	@endif
});
</script>
@endsection
