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
									    <select name="type" class="form-control" onchange="changeContent(this.value)">
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
										<script>
											function changeContent(content){
												$('#audio').hide();
												$('#yotube_link').hide();
												$('.image').hide();
												$('.image_add').hide();
												if (content=='audiobook'){
													$('#audio').show();
												}else if (content=='video'){
													$('#yotube_link').show();
												}else{
													$('.image').show();
													$('.image_add').show();
												}
											}

											function add_photo(){
												htmlImage = '<input  type="file"  class="form-control image" name="file[]" placeholder="">';
												$('.input-group .image:last').after(htmlImage);
											}
										</script>
                    <div class="input-group">
									    <span class="input-group-addon"><i class="mdi mdi-image"></i></span>
									    <input id="image" type="file" style="display:none"  class="form-control" name="file" placeholder=""/>
											<input id="yotube_link" type="text" class="form-control" name="yotube_link" placeholder="YouTube URL"/>
											<input  type="file" style="display:none"  class="form-control image" name="file[]" placeholder=""/>
										</div>
										<input  type="button" style="margin:10px;width:100px;display:none" onclick="add_photo()" class="btn btn-success image_add" value="Tambah Foto" placeholder=""/>
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
