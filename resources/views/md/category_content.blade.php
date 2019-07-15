@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')
<div class="main-content-wrap">
	<div class="main-content">
		<div class="single-column dashboard-wrap">
      <div id="content" class="boxcontent">
        <div class="">
          @if (!empty($listContent))
          <ul class="category_content">
          <?php $a = 1;?>
            @foreach($listContent as $content)

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

@endsection
