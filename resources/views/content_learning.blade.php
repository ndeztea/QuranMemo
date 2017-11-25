
@extends('layouts.master')

@section('title', 'Menghafal Al-Quran')

<?php $prev_surah = $tempCountSpaces = $countSpaces = '';  ?>
@section('content')
@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap">
		<div class="main-content">
			<div class="single-column">
				<div class="container-fluid">
					<div class="content-learning">
						<table class="table table-striped">
					    <thead>
					      <tr>
					        <th class="center">Name</th>
					        <th class="center">Type</th>
					        <th class="center">Open</th>
					      </tr>
					    </thead>
					    <tbody>
					    	@foreach ($listFolder as $folder)
					    	<?php 
					    		$link = $level>=$folder->level?url('file_learning/'.$folder->folder):"javascript:QuranJS.callModal('subscription')";
					    	?>
							<tr>
						        <td><i class="fa fa-folder"></i> {{ucfirst($folder->folder)}}</a></td>
						        <td>Video</td>
						        <td class="center"><a href="{{$link}}"><i class="fa fa-external-link"></i></a></td>
						    </tr> 
							@endforeach
							</tbody>
					  </table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection