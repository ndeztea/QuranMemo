@extends('layouts.master')

@section('title', 'Quiz')

<?php $prev_surah = $tempCountSpaces = $countSpaces = '';  ?>
@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content">
		<div class="single-column">
			<div class="nav-top clearfix">
				Quiz Surah : <strong>{{$surah_detail[0]->surah_name}}</strong>
			</div>
			<div class="clearfix"></div>
			<div class="mushaf mushaf-hafalan">
				<div class="step-wrap">
					<div class="steps clearfix btn-group btn-breadcrumb" role="group" aria-label="steps">
						@for ($a=1;$a<=$total_questions;$a++)
						<a href="javascript:void(0)" class="btn btn-default steps_{{$a}} {{$number==$a?'selected':''}}" style="width: 12.333%">{{$a}}</a>
						@endfor
					</div>
				</div>
				<form action="{{url('quiz/number/'.$next_number)}}" method="post">
				<div class="quiz_detail">
					<div class="question">
						<div class="ayat_section">
							@if($question_type=='text')
							<div class="arabic">
								<div class="content_ayat">{{$question->text_arabic}}</div>
							</div>
							@else
								<div class="arabic">
									<div class="content_ayat">
										<?php 
											$ayatMp3 = str_pad($question->surah, 3, "0", STR_PAD_LEFT).str_pad($question->ayat, 3, "0", STR_PAD_LEFT).'.mp3';
											$coo_muratal = isset($_COOKIE['coo_sound'])?$_COOKIE['coo_sound']:'Al_Afasy';

										?>
										<audio controls="" controlslist="nodownload" src="{{urlMp3('sound/'.$coo_muratal.'/'.$ayatMp3)}}" class="" id="audio"></audio>
									</div>
								</div>
							@endif
							<div class="text content_ayat">
							@if($answer_type=='arabic')
								 {{$question_offset}} ayat {{$question_text}} ayat diatas adalah?
							@else
								Ayat  nomor berapakah ayat diatas?
							@endif
							</div>
						</div>
						
					</div>
					<div class="answer">
						<div class="ayat_section">
							@foreach($list_answers as $choice)
								@if($answer_type=='arabic')
								<div class="arabic">
									<div class="text content_ayat">
										<input type="radio" name="answer" id="answer_{{$choice->surah}}_{{$choice->ayat}}" value="{{$choice->id}}">
										<label for="answer_{{$choice->surah}}_{{$choice->ayat}}">{{$choice->text_arabic}}</label>
									</div>
								</div>
								@else
								<div class="text">
									<div class="text content_ayat">
										<input type="radio" name="answer" id="answer_{{$choice->surah}}_{{$choice->ayat}}" value="{{$choice->id}}">
										<label for="answer_{{$choice->surah}}_{{$choice->ayat}}">{{$surah_detail[0]->surah_name}} : {{$choice->ayat}}</label>
									</div>
								</div>
								@endif
							@endforeach
						</div>
					</div>
					<div class="actions">
						<button class="btn btn-green">Selanjutnya <i class="fa fa-forward"></i></button>
					</div>
					<input type="hidden" name="correct_answer" value="{{$correct_answer}}"/>
				</div>
				</form>
			</div>
		</div>
		<!-- end single-column-->
	</div>
	<!-- end main main-content -->	
</div>
<!-- end main main-content-wrap -->	

@endsection