
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
				    	@foreach ($listFiles as $file)
				    		<?php
					    		$link = "";
					    		$filename = $file?pathinfo($file):'';
					    		$urlFile = url('learning/'.$folder.'/'.$filename['filename'].'.'.$filename['extension']);
					    		//$embed = '<video src="'.$urlFile.'"></video>';
					    	?>
						  <li><a href="javascript:playVideo('{{ucfirst($filename['filename'])}}','{{$urlFile}}')">
					        <i class="fa fa-file" style="font-size:34px"></i><br><small>{{ucfirst($filename['filename'])}}</small></a>
					      </li>
				      	@endforeach
				    	</ul>
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
