<div class="select-surah">
  <div class="modal-spacing">
      <form class="form-inline" method="post" action="<?php echo url('mushaf/search')?>">

        <div class="form-group">
          <select class="form-control" name="surah">
            @foreach($surahs as $surah)
              <?php
                $selectedSurah = '';
                /*if(session('searchSurah')==$surah->id){
                  $selectedSurah = 'selected';
                }elseif($surah->id==$ayats[0]->surah){
                  $selectedSurah = 'selected';
                }*/
              ?>
            <option  {{$selectedSurah}} value="{{$surah->id}}">{{$surah->id}}. {{$surah->surah_name}} ({{$surah->type}}  {{$surah->ayat}} ayat)</option>
            @endforeach
          </select>
        </div>
        <div class="form-group display-inline-block-xs">
          <div class="input-group">
            <input class="form-control search_ayat" type="number" min="1" name="ayat_start" placeholder="Ayat" aria-label="Ayat" value="">
            <span class="input-group-addon">Sampai Ayat</span>
            <input class="form-control search_ayat" type="number" min="1" name="ayat_end" id="ayat_end" placeholder="Ayat" aria-label="Ayat" value="">
          </div>
        </div>
        <!-- <div class="checkbox display-inline-block-xs">
          <label>
            <input type="checkbox" value="1" id="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)" >  <span>Sampai ayat </span>
            <input class="form-control search_ayat ayat_end"  style="display:none" placeholder="Ayat"/>
          </label>
        </div> -->
        <button class="btn btn-search"  onclick="fbq('track', 'clickCariSurah');QuranJS.changeSurah(this)" ><i class="fa fa-search"></i></button>
        <a href="javascript:;"  class="btn btn-juz" onclick="fbq('track', 'clickJuz');QuranJS.callModal('mushaf/juz')" ><i class="fa fa-book"></i><span class="hidden-xs"> Juz</span></a>

    </form>
  </div>
</div>
