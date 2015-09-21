@extends('layouts.master')

@section('title', 'Mushaf')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
	<div class="nav">
		<a href="javascript:;" onclick="changePage(this)" data-value="<?php echo $curr_page-1?>">Prev</a>
		<select name="page" onchange="changePage(this)" >
			<?php foreach($pages as $page):?>
			<option  <?php echo $page->page==$curr_page?'selected':''?> value="<?php echo $page->page ?>"><?php echo $page->page ?></option>
			<?php endforeach?>
		</select>
		<a href="javascript:;" onclick="changePage(this)" data-value="<?php echo $curr_page+1?>">Next</a>
	</div>

	<div class="mushaf">
	<?php if(!empty($ayats)):?>
		<?php foreach($ayats as $ayat):?>
		<div class="ayat_section ayat_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>">
			<div class="arabic"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text?> </div>
			<div class="clearfix"/>
			<div class="indo"> <span class="no_ayat">( <?php echo $ayat->ayat?> )</span> <?php echo $ayat->text_indo?> </div>
		</div>
		<?php endforeach?>
	<?php endif?>
	</div>

	<div class="nav">
		<a href="javascript:;" onclick="changePage(this)" data-value="<?php echo $curr_page-1?>">Prev</a>
		<select name="page" onchange="changePage(this)" >
			<?php foreach($pages as $page):?>
			<option data-value="<?php echo $page->page ?>" <?php echo $page->page==$curr_page?'selected':''?> value="<?php echo $page->page ?>"><?php echo $page->page ?></option>
			<?php endforeach?>
		</select>
		<a href="javascript:;" onclick="javascript:changePage(this)" data-value="<?php echo $curr_page+1?>">Next</a>
	</div>

<script>
	function changePage(elm){
		page = $(elm).data('value');
		if(typeof page=='undefined'){
			page = $(elm).val();
		}

		// @todo : use ajax
		location.href="<?php echo url('mushaf')?>/"+page;
		
	}
</script>
@endsection