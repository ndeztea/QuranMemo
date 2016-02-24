<div class="login_form">
	<form action="" onsubmit="return false" method="post">
		<input type="text" name="email" id="email" placeholder="Email"><br>
		<input type="password" name="password" id="password" placeholder="Password"><br>

		<button onclick="QuranJS.authProcess()">Masuk</button>
		<button onclick="QuranJS.showRegister();">Daftar Gratis</button>
	</form>
</div>
<div class="register_form" style="display:none">
	<form action="" method="post" onsubmit="return false">
		<input type="name" name="name" id="name" placeholder="Nama Lengkap"><br>
		<input type="text" name="email" id="register_email" placeholder="Email"><br>
		<input type="password" name="password" id="register_password" placeholder="Email"><br>

		<button onclick="QuranJS.registerProcess()">Daftar</button>
		<button onclick="QuranJS.showLogin()">Login Sekarang</button>
	</form>
</div>