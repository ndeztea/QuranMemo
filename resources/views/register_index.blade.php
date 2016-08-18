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
								<div class="promo pull-left">
									<div class="clearfix">
										<div class="buku">
										</div>
										<div class="promo-txt">
											<h3>Dapatkan Al-Quran Tikrar untuk menghafal Al-Quran</h3>
											<p>Syaratnya adalah perbanyak menghafal menggunakan QuranMemo, mulai tanggal 1 September 2016, QuranMemo akan menyeleksi 8 orang yang banyak menghafal dan menggunakan QuranMemo :) mari semangat terus dalam menghafal dan membumikan Al-Quran.</p>
										</div>
									</div>
								</div>
								<form class="form-horizontal pull-right" action="{{url('register/process')}}" method="post">
									<input type="hidden" name="device_id" id="register_device_id" value=""/>
									<div class="form-group">
										<label for="name" class="control-label sr-only">Full Name</label>
										<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Nama Lengkap Antum" value="{{ old('name')}}"/>
									</div>
									<div class="form-group">
										<label for="email" class="control-label sr-only">Email</label>
										<input type="email" class="form-control" name="email" id="register_email" aria-label="email" placeholder="Email yang aktif" value="{{ old('email')}}" />

									</div>
									<!--div class="form-group">
										<label for="password" class="control-label sr-only">Password</label>
										<input type="password" class="form-control" name="password" id="register_password" aria-label="password" placeholder="Password" />
									</div-->
									<div class="form-group">
										<label for="city" class="control-label sr-only">Kota</label>
										<input type="text" class="form-control" name="city" id="register_city" aria-label="kota asal" placeholder="Kota Asal" value="{{ old('city')}}"/>
									</div>
									<div class="form-group">
										<label for="address" class="control-label sr-only">Alamat Lengkap</label>
										<textarea class="form-control" name="address" id="register_address" aria-label="alamat lengkap" placeholder="Mohon isi dengan alamat yang lengkap" value="{{ old('address')}}"/></textarea>
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