@extends('layouts.master')

@section('title', 'Mushaf')

<?php
// predefined
$prev_surah = '';
?>
@section('content')


	@include('errors.errors_message')

		<div class="main-content-wrap">
			<div class="main-content">
				<div class="backdrop">
					<div class="backdrop-inner"></div>
				</div>
				<!-- /backdrop -->
				<div class="single-column">


					<div class="mushaf">
						<div class="ads-middle" style="background-color: #54b7ac;"><strong style="font-size:16px">Dzikir Pagi</strong><br><br></div>


						@if(!empty($dzikirs))
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
							<ol class="carousel-indicators" style="position:relative;top:-23px">
								<?php $b=0;?>
								@foreach($dzikirs as $dzikir)
						    <li data-target="#carousel-example-generic" data-slide-to="{{$b}}" class="{{$b==0?'active':''}}"></li>
								<?php $b++;?>
								@endforeach
						  </ol>

							<?php  $a=$recNo=0;?>
									<div class="carousel-inner" role="listbox" style="top: -28px;">
									@foreach($dzikirs as $dzikir)
									<?php $recNo++;?>
									<div class="item {{$a==0?'active':''}}">

							    <div   class="clearfix ayat_section">
										@if($a!=0)
										<div id="play_{{$a}}"></div>
										<?php endif?>
										<div class="arabic arabic_{{$a}}">

											<span class="content_ayat" >
												<span class="ayat_arabic">
													{{$dzikir->text_arabic}}
												</span>
											</span>
										</div>
										<div class="trans trans_{{$a}}">
											<!--span class="no_ayat"></span-->
											<span class="content_ayat"> {{$dzikir->text_indo}}</span>
										</div>
										<div class="action-footer">
					                <div class="btn-group">
					                  <a class="btn btn-play-ayat play_{{$a}}" href="javascript:;" onclick="playDzikir('{{$a}}')"><i class="fa fa-play"></i> Putar</a>
					                  <a class="btn btn-play-ayat" href="javascript:;" > <i class="fa fa-comment"></i> Baca {{$dzikir->count}} x</a>
														<audio  controls style="display:none" class="audio" controlsList="nodownload" src="{{('sound/Dzikir/Hasby/'.$dzikir->file)}}"  id="audio_{{$a}}"></audio>
					                </div>
					            </div>
									</div>
									</div>
									<?php $a++;?>
									</li>
								@endforeach
							</div>
							<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						    <span class="mdi mdi-arrow-left-box glyphicon-chevron-left" style="color: #13302d;font-size: 32px;" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						    <span class="mdi mdi-arrow-right-box glyphicon-chevron-right" style="color: #13302d;font-size: 32px;" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
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

	$(document).ready(function () {
		//initialize swiper when document ready


		var el = '.js-menu';

		var jQuerywindow = jQuery(window);

		//resizeDiv();

		$('.dropdown-menu').on('click', function(event) {
		    event.stopPropagation();
		});

		$('.collapse').on('click', function(event) {
		    event.stopPropagation();
		});



		window.onresize = function(event) {
			//resizeDiv();
		}

		function resizeDiv() {
			vpw = $(window).width();
			vph = $(window).height();

			if (vpw <= 767) {
				$('#surah-collapse').removeClass('in');

			}
			else {
				$('#surah-collapse').addClass('in');
			}
		}
		//show & hide search setting
		//Cache reference to window and animation items

		var stickyOffset = $('.qm-navbar').offset().top;
		var scrollTrigger = 100;



		$(function() {
   	  $("#dzikir-lists").dragend();


      $(".nav").click(function() {
        var page = $(event.target).data("page");
        $("#dzikir-lists").dragend({
          scrollToPage: page
        });

        $(event.target).addClass("active");

      })

    });

	});



	function playDzikir(elm){
		$('.audio').trigger('stop')
		$('#audio_'+elm).trigger('play')
	}

	</script>
	<script type="text/javascript" src="{{url('assets/js/dragend.min.js')}}"></script>

@endsection
