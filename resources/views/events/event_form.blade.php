@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')

<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<div class="single-column dashboard-wrap">
			  <div id="content" class="boxcontent">
					<div class="collapse in" id="dashboard-items">
						<div class="tabbed-nav">
							<ul class="tabbed-nav-list list-unstyled">
								<li class="tabbed-full">
									<form action="{{url('admin/event/stored')}}" method="post" enctype="multipart/form-data" id="form">
									  <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-pencil"></i></span>
									    <input id="event" type="text" class="form-control" name="event" value="{{isset($event->event)?$event->event:''}}" placeholder="Judul Kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-account-circle"></i></span>
									    <input id="speaker" type="text" class="form-control" name="speaker" value="{{isset($event->speaker)?$event->speaker:''}}" placeholder="Pemateri">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-calendar"></i></span>
									    <input id="date" type="text" class="form-control" name="date" value="{{isset($event->date)?$event->date:''}}" placeholder="Tanggal kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
									    <input id="time" type="text" class="form-control" name="time" value="{{isset($event->time)?$event->time:''}}" placeholder="Waktu kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-account-circle"></i></span>
									    <input id="quota" type="text" class="form-control" name="quota" value="{{isset($event->quota)?$event->quota:''}}" placeholder="Quota Makanan">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-map"></i></span>
									    <input id="location" type="text" class="form-control" name="location" value="{{isset($event->location)?$event->location:''}}" placeholder="Alamat kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-image"></i></span>
									    <input id="image" type="file" class="form-control" name="image" placeholder="">
									  </div>
										@if (isset($event->image))
										<img src="{{url('events/'.$event->image)}}">
										@endif
										<div class="input-group">
							      <span class="input-group-addon">

							        <input type="checkbox" style="height:13px" id="is_special" {{empty($event->is_special)?'':'checked'}} name="is_special" value="1">
							      </span>
							      <input type="text" disabled class="form-control" value="Kajian KSSM sekarang">
							    </div><!-- /input-group -->
									<input type="hidden" name="id_event" value="{{isset($event->id)?$event->id:''}}">
									</form>
								</li>
							</ul>
					</div>
				</div>
		</div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->
	</div>
<!-- end main main-content-wrap -->
</div>
<div class="action_footer">
	<a class="btn btn-primary" href="javascript:$('form').submit()"><i class="mdi mdi-content-save"></i> Simpan</a>

</div>
<script>
$(document).ready(function(){
	$('#date').datepicker({
            format: "yyyy-mm-dd",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
});
</script>
@endsection
