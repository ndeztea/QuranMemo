@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content">
		<div class="single-column dashboard-wrap">
      <div id="content" class="boxcontent">
				<div class="dash-profile-detail-wrap">
					<div class="dash-profile-detail">
						<div class="dash-profile-img img-circle">
							<img src="{{getAvatar($detailProfile)}}">
						</div>
						<div class="dash-profile-desc">
							<div>Assalamualaikum,</div>
							<strong class="dash-profile-name">{{session('sess_name')?session('sess_name'):'Tamu'}}</strong>
						</div>
					</div>
				</div>
				<div class="submit-q"><!--i class="mdi mdi-help-box"></i-->Submit Pertanyaan</div>
				<br>
        <div class="">
          <ul class="category">
          <?php $a = 1;?>
          @foreach($categories as $category)
						<?php $a = $a > 7 ? 1 : $a ;?>
            <li class="style{{$a}}" onclick="location.href='{{url('category/'.$category->id)}}'">
              <i class="{{$category->icon}}"></i><br>
              <div>{{$category->category}}</div>
            </li>
            <?php  $a++;?>
          @endforeach
          </ul>

        </div>
				  <br class="clear">
      </div>
    </div>
  </div>
</div>

@endsection
