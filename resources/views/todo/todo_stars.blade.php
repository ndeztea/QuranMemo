<div class="modal-spacing">
	<div class="filter">
		<ul class="nav nav-tabs" role="tablist">

			<li role="presentation"  class="active"><a href="#today" aria-controls="Hari ini" role="tab" data-toggle="tab">Hari ini</a></li>
			<li role="presentation"><a href="#week" aria-controls="Minggu ini" role="tab" data-toggle="tab">Minggu ini</a></li>
			<li role="presentation"><a href="#month" aria-controls="Bulan ini" role="tab" data-toggle="tab">Bulan ini</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" style="text-align: center" id="today">
			<i class="fa fa-star" style="font-size: 100px;margin-top: 23px;color:#50aca2"></i><br>
			<strong style="font-size: 30px;size: 100px;">{{$countDay}}</strong>  <sup>/{{($countStarDay)}}</sup>
		</div>
		<div role="tabpanel" class="tab-pane" style="text-align: center" id="week">
			<i class="fa fa-star" style="font-size: 100px;margin-top: 23px;color:#50aca2"></i><br>
			<strong style="font-size: 30px;size: 100px;">{{$countWeek}}  </strong>  <sup>/{{($countStarDay * 7)}}</sup>
		</div>
		<div role="tabpanel" class="tab-pane" style="text-align: center" id="month">
			<i class="fa fa-star" style="font-size: 100px;margin-top: 23px;color:#50aca2"></i><br>
			<strong style="font-size: 30px;size: 100px;">{{$countMonth}} </strong> <sup>/{{($countStarDay * 30)}}</sup>
		</div>
	</div>
</div>
