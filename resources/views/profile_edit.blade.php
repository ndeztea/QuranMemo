@extends('layouts.master')

@section('title', 'Daftar QuranMemo')
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			<div class="backdrop">
				<div class="backdrop-inner"></div>
			</div>
			<div class="single-column">
				<div class="container-fluid">
					<div class="row">
						<div class="edit-profile-block" style="background-color: #FFFFFF">
							<div class="edit-profile-backdrop">
								<div class="edit-profile-form">
								<!--div class="page-title clearfix">
									<h1 class="pull-left">Edit Profile</h1>
								</div-->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#editprofile" aria-controls="koreksi" role="tab" data-toggle="tab">Edit Profile</a></li>
									<li role="presentation"><a href="#editavatar" aria-controls="hafalan" role="tab" data-toggle="tab">Edit Avatar</a></li>
								</ul>
									<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="editprofile">
										<div class="register_form clearfix">
											<form class="form-horizontal" action="{{url('profile/edit')}}" method="post">
												<h3 class="form-heading">Data Login</h3>
												<div class="form-group">
													<label for="email" class="control-label sr-only">Email</label>
													<input type="email" class="form-control" name="email" disabled="true" id="register_email" aria-label="email" placeholder="Email yang aktif" value="{{ $detailUser->email}}" />

												</div>
												<div class="form-group">
													<label for="password" class="control-label sr-only">Password</label>
													<input type="password" class="form-control" name="password" id="password" aria-label="password" placeholder="Password" />
												</div>
												<div class="form-group">
													<label for="password" class="control-label sr-only">Re-Password</label>
													<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-label="password" placeholder="Tulis ulang password" />
												</div>
												<h3 class="form-heading">Data Profile</h3>
												<div class="form-group">
													<label for="name" class="control-label sr-only">Full Name</label>
													<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Nama Lengkap Antum" value="{{ $detailUser->name}}"/>
												</div>
												<div class="form-group">
													<label for="gender" class="control-label sr-only">Jenis Kelamin</label>
													<select name="gender" id="gender" class="form-control">
														<option value="M" {{ $detailUser->gender=='M'?'selected':''}}>Laki-laki</option>
														<option value="F" {{ $detailUser->gender=='F'?'selected':''}}>Perempuan</option>
													</select>
												</div>
												<div class="form-group">
													<label for="city" class="control-label sr-only">Kota</label>
													<input type="text" class="form-control" name="city" id="register_city" aria-label="kota asal" placeholder="Kota Asal" value="{{ $detailUser->city}}"/>
												</div>
												<div class="form-group">
													<label for="address" class="control-label sr-only">Alamat Lengkap</label>
													<textarea class="form-control" name="address" id="register_address" aria-label="alamat lengkap" placeholder="Mohon isi dengan alamat yang lengkap"/>{{ $detailUser->address}}</textarea>
												</div>
												<div class="form-group">
													<label for="hp" class="control-label sr-only">Handphone</label>
													<input type="text" class="form-control" name="hp" id="hp" aria-label="No Handphone" placeholder="No Handphone" value="{{ $detailUser->hp}}"/>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-simpan" onclick="fbq('track', 'clickSimpanProfile');">Simpan</button>
													<button type="button" class="btn btn-kembali" onclick="history.back()">Kembali</button>
												</div>
												<input type="hidden" name="action" value="post"/>
											</form>	
											<!-- /register-form -->
										</div>

									</div>
									<div role="tabpanel" class="tab-pane" id="editavatar">
										<div class="register_form clearfix" style="text-align: center;padding-top:20px">
											<form class="form-horizontal" action="#" onsubmit="return false" method="post">
												<input type="hidden" name="device_id" id="profile_edit" value=""/>
												<img src="{{getAvatar($detailUser)}}" width="150" height="150" id="img_avatar" class="img-circle"/>
												<input class="input-file" type="file" name="avatar" id="avatar" onclick="fbq('track', 'clickSelectPhoto');">
												
												<br/>
												<input type="submit" value="Upload" id="btn-upload" class="btn btn-upload-img" onclick="fbq('track', 'clickUploadAvatar');QuranJS.uploadAvatar()"/>
											</form>
										</div>
									</div>
								</div>
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
@endsection