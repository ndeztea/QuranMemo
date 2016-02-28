<div class="login_form">
	<form action="" onsubmit="return false" method="post">
		<div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">Email</span>
			  <input type="text" class="form-control" name="email" id="email" aria-label="email" />
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">Password</span>
			  <input type="password" class="form-control" name="password" id="password" aria-label="password" />
			</div>
		</div>
		
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
			  	<button type="button" class="btn btn-default" onclick="QuranJS.authProcess()">Masuk</button>
				<button type="button" class="btn btn-default" onclick="QuranJS.showRegister();">Daftar Gratis</button>
			</div>
		</div>
	</form>
</div>
<!-- /login-form -->
<div class="register_form" style="display:none">
	<form action="" method="post" onsubmit="return false">

		<div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">Full Name</span>
			  <input type="name" class="form-control" name="name" id="name" aria-label="Full Name" />
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">Email</span>
			  <input type="text" class="form-control" name="email" id="register_email" aria-label="email" />
			</div>
		</div>

		<div class="form-group">
			<div class="input-group">
			  <span class="input-group-addon">Password</span>
			  <input type="password" class="form-control" name="password" id="register_password" aria-label="password" />
			</div>
		</div>

		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
				<button type="button" class="btn btn-default" onclick="QuranJS.registerProcess()">Daftar</button>
				<button type="button" class="btn btn-default" onclick="QuranJS.showLogin()">Login Sekarang</button>
			</div>
		</div>
		
	</form>
</div>
<!-- /register-form -->