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
						@if(empty($_SERVER['HTTP_X_REQUESTED_WITH']))
		    			<a class="pull-right gp-link" target="_blank"  href="https://play.google.com/store/apps/details?id=com.ndeztea.quranmemo"><img src="{{url('assets/images/button-google-play.png')}}" width="120"></a>
		    			@endif
					</div>
					@if(!empty($search_result))
					<div class="nav-top clearfix">
						<div class="container-fluid">
							<div class="collapse in" id="surah-collapse">
								<div class="row">
									<div class="col-xs-12">
										<div class="select-surah">
											<form class="form-inline" method="post" action="{{url('mushaf/search')}}">
												<div class="form-group">
													<select class="selectpicker form-control" name="surah"  onchange="location.href='{{url('mushaf/searchKeyword?keyword='.$keyword.'&surah=')}}'+this.value">
														<option value="0">- Di semua surah - </option>
														@foreach($surahs as $surah)
														<option  {{ $selected_surah==$surah->surah?'selected':'' }} value="{{$surah->surah}}">{{ $surah->surah_name }} ( {{ $surah->count }} ayat )</option>
														@endforeach
													</select>
													<span class="count-search">Pencarian dengan kata <span class="highlight">{{$keyword}}</span> ada di <span class="badge">{{$count_search}}</span> ayat</span>
													<!-- /count-search -->
												</div>
											</form>
										</div>
										<!-- /select-surah -->
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<!-- /nav-top -->
					<div class="mushaf">

						
						<div class="mushaf-inner">
							<div class="search-result">
							@foreach($search_result as $search)
								<div class="search-item">
									<p>{{$search->text_indo}}</p>
									<div class="search-footer">
										<i class="fa fa-arrow-circle-o-right"></i> <a href="{{url('mushaf/page/'.$search->page.'#surah_'.$search->surah.'_'.$search->ayat)}}">Surah {{$search->surah_name}} : {{$search->ayat}}</a>
									</div>
								</div>
							@endforeach
							</div>
						
						@endif

						</div>
						@if($pages>0)
							<div class="surah-nav">
								<div class="input-group" role="group" aria-label="Navigasi">
									<ul class="pagination">
										<li><a href="{{ url('mushaf/searchKeyword?keyword='.$keyword.'&page=1')}}{{!empty($selected_surah)?'&surah='.$selected_surah:''}}"> << </a></li>
										<li><a href="{{ url('mushaf/searchKeyword?keyword='.$keyword.'&page=')}}{{$page>1?$page - 1:1}}{{!empty($selected_surah)?'&surah='.$selected_surah:''}}"> < </a></li>
										@for($a=1;$a<=$pages;$a++)
										<li  class="{{$a==$page?'active':''}}"><a href="{{ url('mushaf/searchKeyword?keyword='.$keyword.'&page='.$a)}}{{!empty($selected_surah)?'&surah='.$selected_surah:''}}">{{ $a }}</a></li>
										@endfor
										<li><a href="{{ url('mushaf/searchKeyword?keyword='.$keyword.'&page=')}}{{$page<$pages?$page + 1:$pages}}{{!empty($selected_surah)?'&surah='.$selected_surah:''}}"> > </a></li>
										<li><a href="{{ url('mushaf/searchKeyword?keyword='.$keyword.'&page='.$pages)}}{{!empty($selected_surah)?'&surah='.$selected_surah:''}}"> >> </a></li>
									</ul>
								</div>
							</div>
							<!-- /surah-nav -->
						@endif

					</div>
					<!-- /mushaf -->

				</div>
				<!-- /single-column -->
			</div>
			<!-- /main-content -->
		</div>
		<!-- /main-content-wrap -->

<script type="text/javascript">
	$(document).ready(function(){
		$('.search-item > p').highlight('<?php echo $keyword?>','highlight',{ wordsOnly: true });
	});
</script>

@endsection