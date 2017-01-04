<div class="login_form">
	<form class="form-horizontal" action="" onsubmit="QuranJS.forgetProcess();return false" method="post">
		<div class="form-group">
			<label for="email" class="control-label sr-only">Email</label>
			<input type="email" class="form-control" name="login_email" id="login_email" aria-label="email" placeholder="Email" />
		</div>
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="...">
			  	<button type="submit" class="btn btn-default btn-masuk" onclick="QuranJS.forgetProcess()">
			  	<span class="label-masuk">Kirim ke Email</span>
			  	<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
			  	</button>
			</div>
		</div>
	</form>
</div>