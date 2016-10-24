@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@include('errors.errors_message')

<div class="main-content-wrap">
	<div class="main-content">
		<div class="backdrop">
			<div class="backdrop-inner"></div>
		</div>
		<!-- /backdrop -->
		<div class="single-column">
			<div class="page-title">
				<h2>Dashboard page</h2>
			</div>
			  <div id="content">
			      <h2>Record, Play & Download Microphone Voice</h2>
			      <audio controls src="" id="audio"></audio>
			      <div style="margin:10px;">
			        <a class="button" id="record">Record</a>
			        <a class="button disabled one" id="stop">Reset</a>
			        <a class="button disabled one" id="play">Play</a>
			        <a class="button disabled one" id="download">Download</a>
			        <a class="button disabled one" id="base64">Base64 URL</a>
			        <a class="button disabled one" id="mp3">MP3 URL</a>
			        <a class="button disabled one" id="save">Save</a>
			        <a class="button disabled one" id="upload">Upload</a>
			      </div>
			      <input class="button" type="checkbox" id="live"/>
			      <label for="live">Live Output</label>
			      <canvas id="level" height="200" width="500"></canvas>
			      <style>
			      .button{
			        display: inline-block;
			        vertical-align: middle;
			        margin: 0px 5px;
			        padding: 5px 12px;
			        cursor: pointer;
			        outline: none;
			        font-size: 13px;
			        text-decoration: none !important;
			        text-align: center;
			        color:#fff;
			        background-color: #4D90FE;
			        background-image: linear-gradient(top,#4D90FE, #4787ED);
			        background-image: -ms-linear-gradient(top,#4D90FE, #4787ED);
			        background-image: -o-linear-gradient(top,#4D90FE, #4787ED);
			        background-image: linear-gradient(top,#4D90FE, #4787ED);
			        border: 1px solid #4787ED;
			        box-shadow: 0 1px 3px #BFBFBF;
			      }
			      a.button{
			        color: #fff;
			      }
			      .button:hover{
			        box-shadow: inset 0px 1px 1px #8C8C8C;
			      }
			      .button.disabled{
			        box-shadow:none;
			        opacity:0.7;
			      }
			      </style>
			    </div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->	
	</div>
<!-- end main main-content-wrap -->	
</div>
<script type="text/javascript" src="{{url('assets/js/recorder.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/Fr.voice.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/record.js')}}"></script>

@endsection