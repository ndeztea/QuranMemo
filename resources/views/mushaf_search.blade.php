@extends('layouts.master')

@section('title', 'Cari Kata')

<?php 
// predefined
$prev_surah = ''; 
?>
@section('content')
<div class="main-content-wrap">
			<div class="main-content">
				<div class="backdrop">
					<div class="backdrop-inner"></div>
				</div>
				<!-- /backdrop -->
				<div class="single-column">
					<div class="page-title">
						<h2 class="pull-left">Pencarian</h2>
					</div>
					<?php if(!empty($search_result)):?>
					<div class="nav-top clearfix">
						<div class="container-fluid">
							<div class="collapse in" id="surah-collapse">
								<div class="row">
									<div class="col-xs-12">
										<div class="select-surah">

											<form class="form-inline" method="post" action="<?php echo url('mushaf/search')?>">
												<div class="form-group">
													<select class="selectpicker form-control" name="surah">
														<option value="0">- Di semua surah - </option>
														<?php foreach($surahs as $surah):?>
															<?php 
																$selectedSurah = '';
															?>
														<option  <?php echo $selectedSurah?> value="<?php echo $surah->surah ?>"><?php echo $surah->surah_name ?></option>
														<?php endforeach?>
													</select>
												</div>
											</form>

										</div>
										<!-- /select-surah -->

									</div>
								</div>
							</div>
							Pencarian dengan kata <strong><?php echo $keyword?></strong> ada di <strong><?php echo $count_search?></strong> ayat
						</div>
					</div>
					<!-- /nav-top -->
					<div class="mushaf">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12">
									<div class="mushaf">
										<div class="search-result">
										<?php foreach($search_result as $search):?>
											<div class="search-item">
												<p><?php echo $search->text_indo?></p>
												<div class="search-footer">
													<a href="<?php echo url('mushaf/page/'.$search->page.'#surah_'.$search->surah.'_'.$search->ayat)?>">Surah <?php echo $search->surah_name?> : <?php echo $search->ayat?></a>
												</div>
												<hr>
											</div>
										<?php endforeach?>
										</div>
									<?php endif?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /mushaf -->
					<?php if(isset($pages)):?>
							<div class="surah-nav">
								<div class="input-group" role="group" aria-label="Navigasi">
									<ul class="pagination">
										<li><a href="#"> << <?php //echo trans('trans.prev')?></a></li>
										<li><a href="#"> < <?php //echo trans('trans.prev')?></a></li>
										<?php for($a=1;$a<=$pages;$a++):?>
										<li  class="<?php echo $a==$page?'active':''?>"><a href="<?php echo url('mushaf/searchKeyword?keyword='.$keyword.'&page='.$a) ?>"><?php echo $a ?></a></li>
										<?php endfor?>
										<li><a href="#"> > <?php //echo trans('trans.next')?></a></li>
										<li><a href="#"> >> <?php //echo trans('trans.next')?></a></li>
									</ul>
								</div>
							</div>
							<!-- /surah-nav -->
						<?php endif?>

				</div>
				<!-- /single-column -->
			</div>
			<!-- /main-content -->
		</div>
		<!-- /main-content-wrap -->

<script src="<?php echo url('assets/js/jquery.highlight.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.mushaf').highlight('<?php echo $keyword?>');
	});
	

</script>

@endsection