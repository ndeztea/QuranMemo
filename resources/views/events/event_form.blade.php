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
									<form action="{{url('event/form')}}" method="post" enctype="multipart/form-data" id="form">
									  <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-pencil"></i></span>
									    <input id="event" type="text" class="form-control" name="event" placeholder="Judul Kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-account-circle"></i></span>
									    <input id="speaker" type="text" class="form-control" name="speaker" placeholder="Pemateri">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-calendar"></i></span>
									    <input id="date" type="text" class="form-control" name="date" placeholder="Tanggal kajian, format contoh: (2019-09-29)">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-map"></i></span>
									    <input id="location" type="text" class="form-control" name="location" placeholder="Alamat kajian">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-image"></i></span>
									    <file id="image" type="text" class="form-control" name="image" placeholder="">
									  </div>
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
@endsection
