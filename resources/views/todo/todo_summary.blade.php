@extends('layouts.master')

@section('title', 'Laporan Ibadah')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			<div class="single-column">
				@if(session('sess_role')==1)
				<div class="ads-middle">
					<div class="dropdown">
		              <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;min-width: 300px;background: none;border: 0px;font-weight: bold;">
		                {{empty($classDetail->class)?'Pilih Kelas  Halaqah':$classDetail->class}}
		                <span class="caret"></span>
		              </button>
		              <ul class="dropdown-menu choose-class" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px">
		                @foreach($listClasses as $class)
		                <li><a href="{{url('setClass?id_class='.$class->id)}}">{{$class->class}}</a></li>
		                @endforeach
		              </ul>
		            </div>
				</div>
				@endif
				<div class="ads-middle">
					<div class="action-left" style="float: left;font-size: 21px; position: relative;top: -4px;">
						<a href="{{url('dashboard/'.$prevDay)}}"><i class="fa fa-chevron-circle-left"></i>s</a>
					</div>
					@if ($nextDay>=0)
					<div class="action-right" style="float: right;font-size: 21px;position: relative;top: -4px;">
						<a href="{{url('dashboard/'.$nextDay)}}"><i class="fa fa-chevron-circle-right"></i></a>
					</div>
					@endif
					{{$date_now}} - Pekanbaru, Riau</div>
				<div class="dash-profile">

			  		<div class="dash-profile-detail-wrap">
					  	<div class="dash-profile-detail">
							<div class="dash-profile-img img-circle">
								<img src="{{getAvatar($detailProfile)}}">
							</div>
							<div class="dash-profile-desc">
								<h4 class="dash-profile-name">{{!empty($detailProfile)?$detailProfile->name:'Tamu'}}</h4>
								@if(session('sess_role')==1)
								<h2 class="label label-success timer">Kepala Sekolah</h2>
								@else
								<h2 class="label label-success timer">{{empty($classDetail)?'Belum masuk kelas':'Wali kelas : '.$classDetail->class}}</h2>
								@endif
							</div>
						</div>
						<!--/dash-profile-detail-->
					</div>

			  </div>

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
	var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};
	@foreach($listTodosOne as $todoOne)
	generateChart('.myChart_{{$todoOne->id}}','{{$todoOne->done}}','{{$todoOne->not_done}}','{{$todoOne->left}}')
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
});
</script>
@endsection
