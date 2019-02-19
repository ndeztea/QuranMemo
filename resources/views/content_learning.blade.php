
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
						<ul>
				    	@foreach ($listFolder as $folder)
				    		<?php
					    		$link = $level>=$folder->level?url('file_learning/'.$folder->folder):"javascript:QuranJS.callModal('subscription')";
					    	?>
						  <li><a href="{{$link}}">
					        <i class="fa fa-folder"></i><strong> {{ucfirst($folder->name)}}</strong></a>
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
