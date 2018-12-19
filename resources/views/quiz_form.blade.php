<div class="modal-spacing" style="padding: 10px">
	<p class="alert alert-info">Pilih surah </p>
	<form action="{{url('quiz/start')}}" method="post" id="formQuiz">
	<ul style="width:100%;min-width: 300px;list-style:none" class="choose-class">
		@foreach($listSurah as $surah)
		<li style="text-align: left">
			<input type="checkbox" value="{{$surah->id}}" name="id_surah[]" id="{{$surah->id}}" style="height: auto"> 
			<label for="{{$surah->id}}"> {{$surah->id}}. {{$surah->surah_name}}</label>
		</li>
		@endforeach
	</ul>
	</form>
</div>