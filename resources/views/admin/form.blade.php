@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')
<div class="wrap">

<div class="main-content-wrap">
	<div class="main-content">
		<div class="single-column dashboard-wrap">
			  <div id="content" class="boxcontent">
					<div class="collapse in" id="dashboard-items">
						<div class="tabbed-nav">
							<ul class="tabbed-nav-list list-unstyled">
								<li class="tabbed-full">
									<form action="{{url('admin/save')}}" method="post" enctype="multipart/form-data" id="form">
                    <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-folder-multiple-image"></i></span>
									    <select name="type" class="form-control">
                        @foreach ($listTypes as $typeKey => $typeValue)
                        <option value="{{$typeKey}}">{{$typeValue}}</option>
                        @endforeach
                      </select>
									  </div>
                    <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-pencil"></i></span>
									    <input id="title" type="text" class="form-control" name="title" value="" placeholder="Subject">
									  </div>
										<div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-ballot"></i></span>
									    <select name="id_category" class="form-control">
                        @foreach ($listCategories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                      </select>
									  </div>
                    <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-image"></i></span>
									    <input id="image" type="file" class="form-control" name="file" placeholder="">
									  </div>
										<div class="input-group">
							        <span class="input-group-addon">

							        <input type="checkbox" style="height:13px" id="is_active" name="is_active" value="1">
							      </span>
							      <input type="text" disabled="" class="form-control" value="Publish">
							    </div><!-- /input-group -->
									<input type="hidden" name="id_event" value="">
                  <a class="btn btn-primary"  style="margin:10px;width:80%" href="javascript:$('form').submit()"><i class="mdi mdi-content-save"></i> Simpan</a>
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
        </div>
@endsection
