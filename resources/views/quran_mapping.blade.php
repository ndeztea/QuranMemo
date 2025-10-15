@extends('layouts.master')

@section('title', 'Quran Mapping')

@section('content')


@include('errors.errors_message')

<div class="wrap">
	<div class="main-content-wrap"  style="padding-bottom: 121px;">
		<div class="main-content">
			<div class="single-column">
				<div class="container-fluid">
					<div class="edit-profile-block">
						<div class="edit-profile-backdrop">
							<div class="edit-profile-form">
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="{{$menu_perintah}}"><a href="{{url('quran/mapping')}}" aria-controls="koreksi" role="tab">Perintah Qur'an</a></li>
									<li role="presentation" class="{{$menu_doa}}"><a href="{{url('quran/doa')}}" aria-controls="hafalan" role="tab">Rekomendasi Hafalan</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="qmap-content">
					@foreach($list as $row)
					<div class="qmap-box">
						<div class="qmap-header">QS. {{$row->surah}} : {{$row->ayat_start}}{{$row->ayat_end!=$row->ayat_start?'-'.$row->ayat_end:''}}</div>
						<div class="qmap-desc">{{$row->note}} <a href="{{url('memoz/surah/'.$row->surah_start.'/'.$row->ayat_start.'-'.$row->ayat_end)}}" class="koreksi-action-link" onclick="fbq('track', 'clickHafalkan');">Hafalkan</a></div>

					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>



@endsection
