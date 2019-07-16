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
							<img src="{{url('assets/images/qmc-logo.png')}}">
						</div>
						<div class="dash-profile-desc">
							<div>Assalamualaikum,</div>
								<strong class="dash-profile-name">{{session('sess_name')?session('sess_name'):'Selamat datang'}}</strong>
						</div>
					</div>
				</div>
				<a class="submit-q" href="https://api.whatsapp.com/send?phone=6281231234073&text=Assalamu'alaikum%20wr%20wb,Saya%20ingin%20bertanya"><!--i class="mdi mdi-help-box"></i-->Kirim Pertanyaan</a>
				<br>
        <div class="">
										<strong style="padding: 5px;color: #afafaf;">Category</strong>
          <ul class="category">
          <?php $a = 1; $b=1?>
          @foreach($categories as $category)
						<?php $a = $a > 7 ? 1 : $a ;?>
            <li class="style{{$a}}  <?php //echo $b > 6?'hide':'' ?>" onclick="location.href='{{url('category/'.$category->id)}}'">
              <i class="{{$category->icon}}"></i><br>
              <div>{{$category->category}}</div>
            </li>
            <?php  $a++;$b++?>
          @endforeach
          </ul>
					<!--a class="see_all right" onclick="toggle_category()">Semua Kategori &raquo;</a-->

        </div>
				  <br class="clear">
					<div class="edit-profile-block" style="background: none;">
							<div class="edit-profile-backdrop">
								<div class="edit-profile-form" style="padding-top:0px">
								<!--div class="page-title clearfix">
									<h1 class="pull-left">Edit Profile</h1>
								</div-->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#newest" aria-controls="koreksi" role="tab" data-toggle="tab" aria-expanded="true">Terbaru</a></li>
									<li role="presentation" class=""><a href="#visitor" aria-controls="hafalan" role="tab" data-toggle="tab" aria-expanded="false">Banyak dilihat</a></li>
								</ul>
									<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="newest">
										<div class="boxcontent">
							        <div class="">
							          @if (!empty($contentNewest))
							          <ul class="category_content">
							          <?php $a = 1;?>
							            @foreach($contentNewest as $content)

							              <li class="style{{$a}}" onclick="location.href='{{url('content/'.$content->id)}}'">
							                <span class="counter"><i class="mdi mdi-eye"></i><br>{{$content->counter}}</span>
							                <span class="title">{{$content->title}} <br> <i>Kategori : {{$content->category}}</i></span>
							                <span  class="type"><i class="mdi mdi-{{$content->type}}"></i></span>
							                <div class="clear"></div>
							              </li>
							              <?php
														$a++;
														?>
							            @endforeach
							          </ul>
							          @else
							            @include('errors.data_empty')
							          @endif
							          <br class="clear">
							        </div>
							      </div>

									</div>
									<div role="tabpanel" class="tab-pane" id="visitor">
										<div class="boxcontent">
							        <div class="">
							          @if (!empty($contentVisitor))
							          <ul class="category_content">
							          <?php $a = 1;?>
							            @foreach($contentVisitor as $content)

							              <li class="style{{$a}}" onclick="location.href='{{url('content/'.$content->id)}}'">
							                <span class="counter"><i class="mdi mdi-eye"></i><br>{{$content->counter}}</span>
							                <span class="title">{{$content->title}} <br> <i>Kategori : {{$content->category}}</i></span>
							                <span  class="type"><i class="mdi mdi-{{$content->type}}"></i></span>
							                <div class="clear"></div>
							              </li>
							              <?php
														$a++;
														?>
							            @endforeach
							          </ul>
							          @else
							            @include('errors.data_empty')
							          @endif
							          <br class="clear">
							        </div>
							      </div>
									</div>
								</div>
							</div>
						</div>

					</div>
      </div>
    </div>
  </div>
</div>
<script>
	function toggle_category(){
		$('.hide').show()
		$('.hide').removeClass('hide')
	}
</script>
@endsection
