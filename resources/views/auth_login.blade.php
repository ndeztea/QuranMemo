<div class="login-brand">
	<img class='qmc-logo' src="{{url('assets/images/qmc-logo.png')}}" alt="Logo QuranMemo">
	<img class='qmc-title' src="{{url('assets/images/qmc-title.png')}}" alt="Logo QuranMemo">
</div>
<div class="login_form">
	<form class="form-horizontal" action="" onsubmit="QuranJS.authProcess();return false" method="post">
		<div class="form-group">
			<label for="email" class="control-label sr-only">Email</label>
			<input type="email" class="form-control" name="login_email" id="login_email" aria-label="email" placeholder="Email" />
		</div>
		<div class="form-group">
			<label for="password" class="control-label sr-only">Password</label>
			<input type="password" class="form-control" name="login_password" id="login_password" aria-label="password" placeholder="Password" />
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default btn-masuk">
				<span class="label-masuk">Masuk</span>
				<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
			</button>
			<button type="button" class="btn btn-daftar" onclick="location.href='{{url('register')}}'">
				Belum punya Akun, Daftar
			</button>
		</div>
	</form>
</div>