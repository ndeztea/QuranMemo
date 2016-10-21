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
			{{session('sess_name')}}
			<div class="input-daterange input-group" id="datepicker">
			    <input type="text" class="input-sm form-control" name="start" />
			    <span class="input-group-addon">to</span>
			    <input type="text" class="input-sm form-control" name="end" />
			</div>
		<!-- end single-column-->
		</div>
	<!-- end main main-content -->	
	</div>
<!-- end main main-content-wrap -->	
</div>

@endsection