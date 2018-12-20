<div class="filter">
	<!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <!--li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" onclick="QuranJS.memozFilter('all')">Semua</a></li-->
	    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" onclick="fbq('track', 'clickBelumHafal');QuranJS.memozFilter(0,'')">Ziyadah</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="fbq('track', 'clickButuhKoreksi');QuranJS.memozFilter(2,'')">Dikoreksi</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="fbq('track', 'clickSudahHafal');QuranJS.memozFilter(1,'')">Sudah Hafal</a></li>

	    <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="QuranJS.memozFilter(2)">Koreksi</a></li>-->
	  </ul>
</div>
<i class="fa fa-spinner fa-spin fa-3x fa-fw memoz-loading" style="display: none"></i>
<div class="memoz-list"></div>
<!--div class="ads-middle" style="background: #ffffff;color: #000;" onclick="fbq('track', 'clickUmrohSutanFatih');QuranJS.callModal('umroh')"><img src="{{url('assets/images/sutanfatih_logo.png')}}">Umroh Murah Sutan Fatih Tour and Travel<br> <span style="font-size: 17px"><strong>Mulai dari 18,5jt!</strong></span></div-->
