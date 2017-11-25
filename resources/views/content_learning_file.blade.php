
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
					    	@foreach ($listFiles as $file)
					    	<?php 
					    		$link = "";
					    		$filename = $file?pathinfo($file):'';
					    		$urlFile = url('learning/'.$folder.'/'.$filename['filename'].'.'.$filename['extension']);
					    		//$embed = '<video src="'.$urlFile.'"></video>';
					    	?>
							<tr>
						        <td><i class="fa fa-play"></i> {{ucfirst($filename['filename'])}}</a></td>
						        <td>Video</td>
						        <td class="center"><a href="javascript:playVideo('{{ucfirst($filename['filename'])}}','{{$urlFile}}')"><i class="fa fa-external-link"></i></a></td>
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
<script type="text/javascript">
	function playVideo(title,urlFile){
		videoEmbed = title+'<br>';
		videoEmbed += '<video width="320" height="240" controls>';
  		videoEmbed += '<source src="'+urlFile+'" type="video/mp4">';
  		//videoEmbed += '<source src="movie.ogg" type="video/ogg">';
		videoEmbed += 'Your browser does not support the video tag.';
		videoEmbed += '</video>';
		vex.dialog.alert({ unsafeMessage: videoEmbed })
	}
</script>
@endsection