<div class="login_form">
	<form class="form-horizontal" action="" onsubmit="return false" method="post">
		<div class="form-group">
			<label for="email" class="control-label sr-only">Email</label>
			<input type="email" class="form-control" name="email" id="email" aria-label="email" placeholder="Email" />
		</div>
		<div class="form-group">
			<label for="password" class="control-label sr-only">Password</label>
			<input type="password" class="form-control" name="password" id="password" aria-label="password" placeholder="Password" />
		</div>
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
			  	<button type="button" class="btn btn-default btn-masuk" onclick="QuranJS.authProcess()">Masuk</button>
				<button type="button" class="btn btn-default btn-daftar" onclick="QuranJS.showRegister();">Daftar Gratis <i class="fa fa-angle-right"></i></button>
			</div>
		</div>
	</form>
</div>
<!-- /login-form -->
<div class="register_form" style="display:none">
	<form class="form-horizontal" action="" method="post" onsubmit="return false">
		<div class="form-group">
			<label for="name" class="control-label sr-only">Full Name</label>
			<input type="name" class="form-control" name="name" id="name" aria-label="Full Name" placeholder="Full Name" />
		</div>
		<div class="form-group">
			<label for="email" class="control-label sr-only">Email</label>
			<input type="email" class="form-control" name="email" id="register_email" aria-label="email" placeholder="Email" />

		</div>
		<div class="form-group">
			<label for="password" class="control-label sr-only">Password</label>
			<input type="password" class="form-control" name="password" id="register_password" aria-label="password" placeholder="Password" />
		</div>
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default btn-masuk" onclick="QuranJS.showLogin()"><i class="fa fa-angle-left"></i> Login Sekarang</button>
				<button type="button" class="btn btn-default btn-daftar" onclick="QuranJS.registerProcess()">Daftar</button>
			</div>
		</div>
	</form>
</div>
<!-- /register-form -->