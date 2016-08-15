@extends('layouts.master')

@section('title', 'Daftar QuranMemo')
@section('content')
@include('errors.errors_message')
<div class="container-fluid">
	<div class="row">
		<!-- /login-form -->
		<div class="register_form">
			<form class="form-horizontal" action="{{url('register/process')}}" method="post">
				<input type="text" name="device_id" id="register_device_id" value=""/>
				<div class="form-group">
					<label for="name" class="control-label sr-only">Full Name</label>
					<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Nama Lengkap Antum" />
				</div>
				<div class="form-group">
					<label for="email" class="control-label sr-only">Email</label>
					<input type="email" class="form-control" name="email" id="register_email" aria-label="email" placeholder="Email yang aktif" />

				</div>
				<!--div class="form-group">
					<label for="password" class="control-label sr-only">Password</label>
					<input type="password" class="form-control" name="password" id="register_password" aria-label="password" placeholder="Password" />
				</div-->
				<div class="form-group">
					<label for="city" class="control-label sr-only">Kota</label>
					<input type="text" class="form-control" name="city" id="register_city" aria-label="kota asal" placeholder="Kota Asal" />
				</div>
				<div class="form-group">
					<label for="address" class="control-label sr-only">Alamat Lengkap</label>
					<textarea class="form-control" name="address" id="register_address" aria-label="alamat lengkap" placeholder="Mohon isi dengan alamat yang lengkap" /></textarea>
				</div>
				<div class="form-group">
					<div class="btn-group" role="group" aria-label="...">
						<button type="submit" class="btn btn-default btn-daftar">Daftar</button>
					</div>
				</div>
			</form>	
			<!-- /register-form -->
		</div>
	</div>
</div>
@endsection