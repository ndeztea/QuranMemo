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
				<img src="{{url('assets/images/ustadz_oni.png')}}" style="
				    position: absolute;
				    top: -9px;
				    /* width: 160px; */
				    left: 254px;
				    height: 106px;
				    transform: scaleX(-1);
							"/>
				<a class="submit-q" href="https://api.whatsapp.com/send?phone=6281289105575&text=Assalamu'alaikum%20wr%20wb,%20Saya%20ingin%20bertanya"><!--i class="mdi mdi-help-box"></i-->Kirim Pertanyaan</a>
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
								<div class="" style="background: #ffffff;/* background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,1) 41%, rgba(255,199,0,1) 100%); */border-radius: 14px 0px 14px 0px;margin: 4px auto;/* background-image: url(&quot;http://md.quranmemo.id/public/assets/images/qmc-logo.png&quot;); */width: 97%;height: 75px;background-size: 14%;background-repeat-x: no-repeat;background-repeat-y: no-repeat;background-position: 96% -14%;border-top: 1px solid #f36423;border-bottom: 1px solid #f36423;" target="_blank">
						<div style="
    float: left;
    width: 71%;
    color: #FFF;
    padding: 7px;
"><span style="
    /* font-family: 'Fira+Sans'; */
    text-shadow: 1px 1px 4px #000000;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    ">BELI DISINI!</span><span style="
    font-size: 14px;
    color: #525252;
    text-shadow: 1px 2px 0px #e4e4e4;
"><br>Buku INI DULU BARU ITU <br>
Ust. DR. Oni Sahroni MA</span></div>
<div style="
    position: absolute;
    right: -19px;
"><a href="https://api.whatsapp.com/send?phone=6281289105575&text=Assalamu'alaikum%20wr%20wb,%20Saya%20ingin%20order%20buku%20Fiqh%20Prioritas" target="_blank" style="
    font-size: 23px;
    color: #fff;
    /* border: 1px solid; */
    /* border-radius: 27px; */
    padding: 2px;
    padding-right: 27px;
    /* text-align: center; */
" class="btn">
<img src="http://md.quranmemo.id/public/assets/images/buku/inidulubaruitu.png" style="width: 125px;"></a></div>

					</div>
								<div class="edit-profile-form" style="padding-top:0px">
								<!--div class="page-title clearfix">
									<h1 class="pull-left">Edit Profile</h1>
								</div-->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active" style="width: 33.33%;"><a href="#newest" aria-controls="koreksi" role="tab" data-toggle="tab" aria-expanded="true">Terbaru</a></li>
									<li role="presentation" style="width: 33.33%;"><a href="#random" aria-controls="koreksi" role="tab" data-toggle="tab" aria-expanded="true">Acak</a></li>
									<li role="presentation" class="" style="width: 33.33%;"><a href="#visitor" aria-controls="hafalan" role="tab" data-toggle="tab" aria-expanded="false">Populer</a></li>
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
									<div role="tabpanel" class="tab-pane active" id="random">
										<div class="boxcontent">
							        <div class="">
							          @if (!empty($contentRandom))
							          <ul class="category_content">
							          <?php $a = 1;?>
							            @foreach($contentRandom as $content)

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
					<div class="">
						<strong style="padding: 5px;color: #afafaf;">Ikuti kami</strong>
						<ul class="category">
							<li style="width:16%" class="style2   <?php //echo $b > 6?'hide':'' ?>" onclick="window.open('https://t.me/OniSahronii','_blank')">
	              <i class="mdi mdi-telegram" style="font-size:32px"></i><br>
	              <!--div>Muamalah Daily</div-->
	            </li>
							<li style="width:16%" class="style2    <?php //echo $b > 6?'hide':'' ?>" onclick="window.open('https://www.instagram.com/muamalah_daily/','_blank')">
	              <i class="mdi mdi-instagram"  style="font-size:32px"></i><br>
	              <!--div>Muamalah_Daily</div-->
	            </li>
							<li style="width:16%" class="style2    <?php //echo $b > 6?'hide':'' ?>" onclick="window.open('https://www.youtube.com/channel/UCASOyLs8Br4wJuu5giq41-w','_blank')">
	              <i class="mdi mdi-youtube"  style="font-size:32px"></i><br>
	              <!--div>Muamalah Daily</div-->
	            </li>
							<li style="width:16%" class="style2    <?php //echo $b > 6?'hide':'' ?>" onclick="window.open('https://www.facebook.com/onisahronii2','_blank')">
	              <i class="mdi mdi-facebook-box"  style="font-size:32px"></i><br>
	              <!--div>Oni Sahroni</div-->
	            </li>
							<li style="width:16%" class="style2    <?php //echo $b > 6?'hide':'' ?>" onclick="window.open('http://www.rumahwasathia.com','_blank')">
	              <i class="mdi mdi-earth"  style="font-size:32px"></i><br>
	              <!--div>rumahwasathia.com</div-->
	            </li>
						</ul>
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
