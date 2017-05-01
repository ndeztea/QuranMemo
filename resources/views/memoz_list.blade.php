<div class="filter">
	<!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <!--li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" onclick="QuranJS.memozFilter('all')">Semua</a></li-->
	    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" onclick="QuranJS.memozFilter(0)">Belum Hafal</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="QuranJS.memozFilter(1)">Sudah Hafal</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="QuranJS.memozFilter(2)">Koreksi</a></li>
	  </ul>
</div>
<i class="fa fa-spinner fa-spin fa-3x fa-fw memoz-loading" style="display: none"></i>
<div class="memoz-list"></div>