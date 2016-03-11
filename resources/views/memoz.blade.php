@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = '';  ?>
@section('content')
<div class="main-content-wrap">
	<div class="main-content">
		<div class="single-column">
			<div class="page-title">
				<h2>Menghafal</h2>
			</div>
			<div class="nav-top clearfix">
				<div class="select-surah pull-left">
					<form class="form-inline" action="" method="post">
							Surah
							<div class="form-group">
								<select name="surah_start" class="form-control">
									<?php foreach($surahs as $surah):?>
									<option <?php echo $surah->id==$surah_start?'selected':''?> value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?> (<?php echo $surah->type?>)</option>
									<?php endforeach?>
								</select>
							</div>
							<div class="form-group display-inline-block-xs">
								<input class="form-control search_ayat" type="text" name="ayat_start" value="<?php echo $ayat_start?$ayat_start:''?>">
							</div>
							<div class="checkbox display-inline-block-xs">
								<label>
									<input type="checkbox" value="1" id="fill_ayat_end" <?php echo !empty($fill_ayat_end)?'checked':''?> name="fill_ayat_end" onclick="QuranJS.fillAyatEnd(this)">  <span>Sampai surah </span>
								</label>
							</div>

							<div  class="form-group ayat_end" style="display:none">
								<select name="surah_end" class="form-control">
									<?php foreach($surahs as $surah):?>
									<option <?php echo $surah->id==$surah_end?'selected':''?>  value="<?php echo $surah->id ?>"><?php echo $surah->id ?>. <?php echo $surah->surah_name ?>  (<?php echo $surah->type?>)</option>
									<?php endforeach?>
								</select>
							</div>
							<div class="checkbox display-inline-block-xs  ayat_end"  style="display:none">
								<input type="text" name="ayat_end" class="form-control" value="<?php echo $ayat_end?$ayat_end:''?>">
							</div>
							<button class="btn btn-cari-ayat" type="submit" name="btnSubmit"><i class="fa fa-search"></i><span class="sr-only">Cari</span></button>
					</form>
				</div>
				<!-- /select-surah -->

				<?php if(!empty($ayats)):?>

				<div class="memoz_options">
					@include('players')

					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <i class="fa fa-cog"></i> <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li>
					    	<input type="checkbox" name="repeat_ayat" class="repeat_ayat selected" value="1"/> Ulangi Ayat
					    </li>
					    <li class="divider"></li>
					    <li>
					    	<span>Ulangi</span> 
							<select name="repeat" class="repeat">
								<option value="1">1 kali</option>
								<option value="2">2 kali</option>
								<option value="3">3 kali</option>
								<option value="4">4 kali</option>
								<option value="5">5 kali</option>
							</select>
						</li>
					  </ul>
					</div>
					
				</div>
				<!-- /memoz-player -->
				<?php endif?>


			</div>
			<!-- /nav-top -->
			
			<?php if(!empty($ayats)):?>
			<div class="container-fluid">
				<div class="row">
					<div class="">

						<div class="mushaf mushaf-hafalan">
							<div class="step-wrap">
								<div class="steps clearfix btn-group btn-breadcrumb" role="group" aria-label="steps">
									<a href="javascript:void(0)" onclick="steps('1')" class="btn btn-default steps_1 selected">Langkah 1</a>
									<a href="javascript:void(0)" onclick="steps('2')" class="btn btn-default steps_2">Langkah 2</a>
									<a href="javascript:void(0)" onclick="steps('3')" class="btn btn-default steps_3">Langkah 3</a>
									<a href="javascript:void(0)" onclick="steps('4')" class="btn btn-default steps_4">Langkah 4</a>
									<a href="javascript:void(0)" onclick="steps('5')" class="btn btn-default steps_5">Langkah 5</a>
								</div>
							</div>
							<!-- /step-wrap -->
							<!--div class="pull-right hafalan-actions">
								<button class="btn"  data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('memoz/create')">Simpan Hafalan</button>
								<button class="btn btn-success">Sudah Hafal</button>
							</div-->
							<!-- /hafalan-actions -->
							<div class="clearfix"></div>
							<div class="steps_desc">
								<div class="alert alert-success">
									<p>Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti.</p>
								</div>
							</div>
							<?php  $a=0;foreach($ayats as $ayat):?>
							
							<?php if(($prev_surah!=$ayat->surah && $ayat->surah!=1 && $prev_surah!='') || ($prev_surah=='' && $ayat->ayat==1 && $ayat->surah!=1 ) ):?>
							<div class="ayat_section  section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_0">
								<div class="head_surah" >
								بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ
								</div>
								<div class="clearfix"></div>
							</div>
							<?php endif?>
							
							<div class="ayat_section section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
								
								<div class="arabic arabic_<?php echo $a;?>"> 
									<span class="content_ayat"><?php echo $ayat->text?></span> 
									<span class="no_ayat_arabic"> ( <?php echo arabicNum($ayat->ayat)?> </span> 
								</div>
								<div class="trans trans_<?php echo $a;?>"> 
									<span class="no_ayat">( <?php echo $ayat->ayat?> )</span> 
									<span class="content_ayat"><?php echo $ayat->text_indo?></span> 
								</div>
								<div class="action-footer">
									<div class="btn-group">
										<a class="btn btn-play-ayat play_<?php echo $a?>" href="javascript:;"><i class="fa fa-play"></i> Play</a>
										<!--a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) )?>" target="_blank"><i class="fa fa-share-alt"></i></a-->
										<a class="btn btn-share-ayat" href="#" data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('bookmarks?url=<?php echo  url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat) ?>')" data-url="<?php echo url('mushaf/surah/'.$ayat->surah.'/'.$ayat->ayat)?>"><i class="fa fa-share-alt"></i> Share</a>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<?php $prev_surah = $ayat->surah?>
							<?php  $a++; endforeach?>
						
						</div>
						<!-- /mushaf -->

						<?php else:?>
							<div class="alert alert-warning"><p>Tentukan surah dan ayat yang Anda ingin hafal</p></div>
						<?php endif?>

					</div>
				</div>
			</div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->	
	</div>
<!-- end main main-content-wrap -->	
</div>

<script type="text/javascript">
$(document).ready(function(){
	QuranJS.fillAyatEnd();

	$(document).ready(function () {
		var jQuerywindow = jQuery(window);
			QuranJS.generateArHeight('!important');
			QuranJS.generateTransHeight('!important');

			//show & hide search setting
			$('.openThis').hide();
			$('.btn-toggle-player').click(function() {
			    $('.quran_player').slideToggle( function() {
			    	$('.openThis').show();						
				});
			    return false;
			});

			// show & hide player
			if($('#QuranModal .modal-dialog .modal-content .modal-body').hasClass('login_form')){
				$('#QuranModal').addClass('login-mode');
				console.log('found');
			}else{
				console.log('notfound');
			}

			$('.dropdown-menu').on('click', function(event) {
			    event.stopPropagation();
			});

		});

	});
	function  steps(steps){
		if(steps==1){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti.');
			jQuery('.memoz_player').show();
		}else if(steps==2){
			jQuery('.trans').addClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').addClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==3){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic dan terjemahannya');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==4){
			jQuery('.trans').removeClass('puff').addClass('go');
			jQuery('.arabic').removeClass('go').addClass('puff');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target terjemahannya');
			jQuery('.memoz_player').hide();
			jQuery('.jp-stop').click();
		}else if(steps==5){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic dan terjemahannya,  jalankan dan dengarkan qori dengan teliti, ulangi sampai hafal');
			jQuery('.memoz_player').show();
		}

		jQuery('.steps a').removeClass('selected');
		jQuery('.steps_'+steps).addClass('selected');
	}

</script>

@endsection