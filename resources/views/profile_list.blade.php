@extends('layouts.master')

@section('title', 'Daftar Santri')

@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content ">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
	<!-- /backdrop -->
		<div class="single-column edit-profile-block">
			<div class="container-fluid">
					<div class="row">
						<div class="edit-profile-block" style="background-color: #FFFFFF;padding: 20px;min-height: 400px;margin-bottom: 20px">
							<!--strong>Total Siswa : {{$countTotalUsers}}</strong-->
							@if(session('sess_role')==1)
							<div class="dropdown">
							  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;min-width: 300px">
							    {{empty($classDetail->class)?'Pilih Kelas  Halaqah':$classDetail->class}}
							    <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu choose-class" aria-labelledby="dropdownMenu2" style="width:100%;min-width: 300px">
							  	@foreach($listClasses as $class)
							    <li><a href="{{url('profile/list?id_class='.$class->id)}}">{{$class->class}}</a></li>
							    @endforeach
							  </ul>
							</div>
							@else
							<div class="ads-middle">{{$classDetail->class}}</div>
							@endif

							@if(!empty($id_class))
							<!--ul class="nav nav-tabs" role="tablist">
								<!--li role="presentation" class="{{empty($gender)?'active':''}}" style="width: 33.33%"><a href="{{url('profile/list?id_class='.$id_class)}}">Semuanya</a></li-->
								<!--li role="presentation" class="{{$gender=='m'?'active':''}}"  style="width: 50%"><a href="{{url('profile/list?id_class='.$id_class)}}&gender=m">Ikhwan</a></li>
								<li role="presentation" class="{{$gender=='f'?'active':''}}"  style="width: 50%"><a href="{{url('profile/list?id_class='.$id_class)}}&gender=f">Akhwat</a></li>
							</ul-->
							@endif

							@if(!empty($classDetail))
							<div class="page-header" style="padding:0px !important;margin:0px !important">
							  <h2><small></small></h2>
							</div>
							<div class="panel panel-default">
							  <!-- Default panel contents -->
							  <div class="panel-body">
							  	<div class="input-group" style="width: 100%">
										<!--input type="text" class="form-control" name="date"  readonly="readonly" id="date"  placeholder="Tanggal"/>
										<br-->
										<form method="post" action="{{url('profile/list?id_class='.$id_class)}}">
								      <input type="text" name="keyword" style="width:80%" class="form-control" value="{{$keyword}}" placeholder="Cari nama...">
								      <span class="input-group-btn">
								        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							      		</span>
							      	</form>
							    </div><!-- /input-group -->
							    <br><br>
							    <form method="post" id="listUserForm" action="{{url('profile/updateClass')}}">
							    <!--div class="input-group" style="width: 90%;margin-bottom: 5px">
							  		<input name="id_class" value="{{$id_class}}" type="hidden"/>
								  	  <select class="form-control"  name="id_class_target">
								  	  	<option value="">-Ganti Kelas Halaqah-</option>
								  	  	@foreach($listClasses as $class)
									    <option value="{{$class->id}}">{{$class->class}}</option>
									    @endforeach
								  	  </select>
								  	  <span class="input-group-btn">
								  	  	<button class="btn btn-default"><i class="fa fa-save"></i></button>
							  	  		</span>
							  	  </div>
							  	  <br>
							  	  <!--div class="input-group" style="width: 90%">
							  		<input name="id_class" value="{{$id_class}}" type="hidden"/>
								  	  <select class="form-control"  name="action" style="width:50%">
								  	  	<option value="">-Tambah nilai-</option>
								  	  	@foreach($rolesManual as $role)
									    <option value="{{$role}}">{{$role}}</option>
									    @endforeach
								  	  </select>
								  	  <input name="points" placeholder="Points" class="form-control" style="width:50%"/>
								  	  <span class="input-group-btn">
								  	  	<button class="btn btn-default" onclick="savePoints();return false;"><i class="fa fa-save"></i></button>
							  	  		</span>
							  	  </div-->
							  </div>
							  <script type="text/javascript">
							  	function savePoints(){
							  		$('#listUserForm').attr('action','{{url('profile/addPointsManual')}}');
							  		$('#listUserForm').submit();
							  	}
							  </script>
							  	<!--p class="alert alert-info">Jumlah Santri : <strong>{{$countUsers}}</strong></p>
							  <!-- Table -->
								  <table class="table">
										<!--td colspan="1">
									    <table width="100%">
									    	<tbody>
														<tr>
									        		<th class="center" width="20%">Subuh</th>
									            <th class="center" width="20%">Dzuhur</th>
									            <th class="center" width="20%">Ashar</th>
									            <th class="center" width="20%">Maghrib</th>
									            <th class="center" width="20%">Isya</th>
									        </tr>
									    	</tbody>
											</table>
									</td-->
										<!--tr>
								    	<th width="30" class="center">No</th>
								    	<th>Nama</th>
								    	<th class="center"></th>
								    </tr-->
								    @if(!empty($listUsers))
											<?php $a=1?>
								    	@foreach($listUsers as $user)
								    	<tr>
									    	<td>
													<a href="{{url('todo/0/'.$user->id)}}">{{$a++}}. {{$user->name}} <br> <sup> {{$user->last_login}}</sup>
													</a> <sup>{{$user->email}}</sup>
													<br>
													<a href="javascript:settingPop('{{$user->id}}')"><i class="fa fa-cog"></i> Setting</a>
													<!--input name="id_users[]" type="checkbox" value="{{$user->id}}"/--> <br>
													<!--a href="https://api.whatsapp.com/send?phone={{$user->hp}}" target="_blank" class="label label-success"><i class="fa fa-whatsapp"></i> {{$user->hp}}</a>
									    		<!span class="label label-primary"><i class="fa fa-{{$user->gender=='F'?'female':'male'}}"></i>  TO{{$user->id}}</span>
									    		@if($user->role==2)
									    		<span class="label label-warning"><i class="fa fa-group"></i> Musyrif{{$user->gender=='F'?'ah':''}}</span>
									    		@endif
									    		<br><small>{{$user->city}} - {{getAge($user)}}<br>
													</small-->
									    	</td>
									    </tr>
											<!--tr>
												<td colspan="1">
													<table width="100%">
											    	<tbody>
																<tr>
											        		<th class="center green" width="20%"><i class="fa fa-check-circle"></i></th>
											            <th class="center green" width="20%"><i class="fa fa-check-circle"></i></th>
											            <th class="center green" width="20%"><i class="fa fa-check-circle"></i></th>
											            <th class="center red" width="20%"><i class="fa fa-times-circle"></i></th>
											            <th class="center green" width="20%"><i class="fa fa-check-circle"></i></th>
											        </tr>
											    	</tbody>
													</table>
												</td>
										</tr-->
										@endforeach
								    @endif
								  </table>
								</form>
							  @if($pages>0)
								<!--div class="surah-nav">
									<div class="input-group" role="group" aria-label="Navigasi">
										<ul class="pagination">
											<li><a class="btn" href="{{ url('profile/list?id_class='.$id_class.'&page=1')}}{{!empty($keyword)?'&keyword='.$keyword:''}}"> << </a></li>
											<li><a class="btn" href="{{ url('profile/list?id_class='.$id_class.'&page=')}}{{$page>1?$page - 1:1}}{{!empty($keyword)?'&keyword='.$keyword:''}}"> < </a></li>
											<li><a class="btn" href="{{ url('profile/list?id_class='.$id_class.'&page=')}}{{$page<$pages?$page + 1:$pages}}{{!empty($keyword)?'&keyword='.$keyword:''}}"> > </a></li>
											<li><a class="btn" href="{{ url('profile/list?id_class='.$id_class.'&page='.$pages)}}{{!empty($keyword)?'&keyword='.$keyword:''}}"> >> </a></li>
										</ul>
									</div>
								</div>
								<!-- /surah-nav -->
							@endif
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('#date').datepicker({
			format: "yyyy-mm-dd",
			dateFormat: "yyyy-mm-dd",
			altFormat: "yyyy-mm-dd",
			clearBtn: true,
			autoclose: true,
			todayHighlight: true,
			onSelect: function(date) {
				alert(date);

			}
	});

	$('#date').bind('onSelect', function() {alert('a') });

})
function settingPop(userid){
	message = '<a class="btn btn-green" href="JavaScript:resetPasswordStudent('+userid+')">Reset Password Siswa</a> <br> <!--a class="btn btn-green" href="JavaScript:resetPasswordParent('+userid+')">Reset Password Orang Tua</a> <br--> <a class="btn btn-green" href="JavaScript:editStudent('+userid+')">Edit User</a> <br> <a class="btn btn-green" href="JavaScript:deleteStudent('+userid+')">Delete User</a>'

	vex.dialog.alert({ unsafeMessage: message });

}

function resetPasswordStudent(userid){
	location.href = '{{url('')}}/profile/resetPassword/'+userid+'/student'
}

function resetPasswordParent(userid){
	location.href = '{{url('')}}/profile/resetPassword/'+userid+'/parent'
}

function editStudent(userid){
	location.href = '{{url('')}}/profile/edit/'+userid
}

function deleteStudent(userid){
	location.href = '{{url('')}}/profile/delete/'+userid
}


</script>

@endsection
