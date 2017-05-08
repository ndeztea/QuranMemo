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
						<div class="register-block">
							<!-- /login-form -->
							<div class="page-title clearfix">
								<h1 class="pull-left">Daftar QuranMemo</h1>
							</div>
							<div class="register_form clearfix">
								<form class="form-horizontal" action="{{url('profile/edit')}}" method="post">
									<input type="hidden" name="device_id" id="profile_edit" value=""/>
									<h3>Data Login</h3>
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
									<h3>Data Profile</h3>
									<div class="form-group">
										<label for="name" class="control-label sr-only">Full Name</label>
										<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Nama Lengkap Antum" value="{{ $detailUser->name}}"/>
									</div>
									<div class="form-group">
										<label for="gender" class="control-label sr-only">Jenis Kelamin</label>
										<select name="gender" id="gender">
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
										<div class="btn-group" role="group" aria-label="...">
											<button type="submit" class="btn btn-default btn-daftar btn-full">Simpan</button>
											<button type="button" class="btn btn-primary btn-daftar" onclick="history.back()">Kembali</button>
										</div>
									</div>
									<input type="hidden" name="action" value="post"/>
								</form>	
								<!-- /register-form -->
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