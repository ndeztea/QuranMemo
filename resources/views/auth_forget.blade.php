<div class="login-brand">
	<a class="qm-brand" href="{{url('')}}">
            <img class='hires qmc-logo' style="width:130px" src="{{url('assets/images/logo.png')}}" alt="Logo QuranMemo">
            <img class='hires qmc-title' style="width:80px" src="{{url('assets/images/logo-text-black.png')}}" alt="Logo QuranMemo">
        </a>
</div>
<div class="login_form">
	<form class="form-horizontal" action="" onsubmit="QuranJS.forgetProcess();return false" method="post">
		<div class="form-group">
			<label for="email" class="control-label sr-only">Email</label>
			<input type="email" class="form-control" name="login_email" id="login_email" aria-label="email" placeholder="Email" />
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default btn-masuk" onclick="fbq('track', 'clickForgotPassword');">
			  	<span class="label-masuk">Kirim ke Email</span>
			  	<i class="fa fa-spinner fa-spin fa-3x fa-fw label-loading" style="display:none"></i>
			</button>
		</div>
	</form>
</div>