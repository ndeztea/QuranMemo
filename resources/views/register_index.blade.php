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
							<div class="register-backdrop">
								<div class="login-brand">
									<a class="qm-brand" href="{{url('')}}">
										<img class='hires qmc-logo'  src="{{url('assets/images/qmc-logo.png')}}" alt="Logo QuranMemo">
										<img class='hires qmc-title'  src="{{url('assets/images/qmc-title.png')}}" alt="Logo QuranMemo">
							        </a>
								</div>
								<!-- /login-form -->
								<!--div class="page-title clearfix">
									<h1 class="pull-left">Daftar QuranMemo</h1>
								</div-->
								<div class="register_form clearfix">
									<div class="register-intro pull-left">
										<div class="clearfix">
											<div class="promo-txt">
												<h3>Ahlan Wasahlan Alumni {{config('app.app_name')}}</h3>
												<p>Semakin Terdepan Membantu Para Penghafal Al-Qur'an dalam Muraja'ah dan Ziyadah</p>
											</div>
										</div>
									</div>
									<form class="form-horizontal pull-right" action="{{url('register/process')}}" method="post">
										<input type="hidden" name="device_id" id="register_device_id" value=""/>
										<div class="form-group">
											<label for="gender" class="control-label sr-only">Pilih Kelas</label>
											<select class="form-control" name="id_class" id="id_class">
												<option value="">-Pilih Kelas-</option>
												@foreach($listClasses as $class)
												<option value="{{$class->id}}" {{$class->id==old('id_class')?'selected':''}}>{{$class->class}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="name" class="control-label sr-only">Full Name</label>
											<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Nama Lengkap Antum" value="{{ old('name')}}"/>
										</div>
										<div class="form-group">
											<label for="email" class="control-label sr-only">Email</label>
											<input type="email" class="form-control" name="email" id="register_email" aria-label="email" placeholder="Email yang aktif" value="{{ old('email')}}" {{ old('gender')=='M'?'selected':''}}/>

										</div>
										<div class="form-group">
											<label for="password" class="control-label sr-only">Password</label>
											<input type="password" class="form-control" name="password" id="password" aria-label="password" placeholder="Password" />
										</div>
										<div class="form-group">
											<label for="password" class="control-label sr-only">Re-Password</label>
											<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-label="password" placeholder="Tulis ulang password" />
										</div>
										<div class="form-group">
											<label for="gender" class="control-label sr-only">Jenis Kelamin</label>
											<select class="form-control" name="gender" id="gender">
												<option value="M" {{ old('gender')=='M'?'selected':''}}>Laki-laki</option>
												<option value="F" {{ old('gender')=='F'?'selected':''}}>Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label for="city" class="control-label sr-only">Tanggal Lahir</label>
											<input type="text" class="form-control" name="dob"  readonly="readonly" id="register_dob" aria-label="tanggal lahir" placeholder="Tanggal Lahir" value="{{ old('dob')}}"/>
										</div>
										<div class="form-group">
											<label for="city" class="control-label sr-only">Kota</label>
											<input type="text" class="form-control" name="city" id="register_city" aria-label="kota asal" placeholder="Kota Asal" value="{{ old('city')}}"/>
										</div>
										<div class="form-group">
											<label for="address" class="control-label sr-only">Alamat Lengkap</label>
											<textarea class="form-control" name="address" id="register_address" aria-label="alamat lengkap" placeholder="Mohon isi dengan alamat yang lengkap"/>{{ old('address')}}</textarea>
										</div>
										<div class="form-group">
											<label for="hp" class="control-label sr-only">Handphone</label>
											<input type="text" class="form-control" name="hp" id="hp" aria-label="No Handphone" placeholder="No Handphone" value="{{ old('hp')}}"/>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-daftar">Daftar</button>
											<button type="button" class="btn btn-masuk" onclick="QuranJS.callModal('auth/login')">Sudah punya Akun, Login</button>
										</div>
									</form>
									<!-- /register-form -->
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
<script>
$(document).ready(function(){
	$('#register_dob').datepicker({
            format: "yyyy-mm-dd",
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        });
});
</script>
@endsection
