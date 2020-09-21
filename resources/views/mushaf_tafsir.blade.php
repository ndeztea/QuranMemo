<div class="modal-spacing" style="padding: 10px">
    <!--h4>{{$tafsir_header}}</h4-->

    <div class="filter">
    	<!-- Nav tabs -->
    	  <ul class="nav nav-tabs" role="tablist">
    	    <li role="presentation" class="active"><a href="#almisbah" aria-controls="profile" role="tab" data-toggle="tab">Al-Misbah</a></li>
    	    <li role="presentation"><a href="#depag" aria-controls="profile" role="tab" data-toggle="tab">Depag</a></li>

    	    <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"onclick="QuranJS.memozFilter(2)">Koreksi</a></li>-->
    	  </ul>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="almisbah"><br><p>{{$tafsir}}</p></div>
      <div role="tabpanel" class="tab-pane" id="depag"><br><p>{{$tafsir_depag}}</p></div>
    </div>

</div>
