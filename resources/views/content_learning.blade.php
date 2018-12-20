
@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = $tempCountSpaces = $countSpaces = '';  ?>
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap"  style="padding-bottom: 121px;">
		<div class="main-content">
			<div class="single-column">
				<div class="container-fluid">
					<div class="content-learning">
						<ul style="padding:0px !important">
				    	@foreach ($listFolder as $folder)
				    		<?php 
					    		$link = $level>=$folder->level?url('file_learning/'.$folder->folder):"javascript:QuranJS.callModal('subscription')";
					    	?>
						  <li style="text-align:center;border: 1px solid #7bb1ad;width: 31%;float:left !important;margin: 3px;background: #b6dcd9;padding: 5px"><a href="{{$link}}">
					        <i class="fa fa-folder" style="font-size:34px"></i><br><small>{{ucfirst($folder->name)}}</small></a>
					      </li>
				      	@endforeach
				    	</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection