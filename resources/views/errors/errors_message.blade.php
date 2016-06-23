@if(!empty(session('messageError')))
    <div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	{{ session('messageError') }}
    </div>
@endif

@if(!empty(session('messageSuccess')))
    <div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	{{ session('messageSuccess') }}
    </div>
@endif

@if(!empty($messageErrors))
    <ul class="alert alert-danger">
    @foreach ($messageErrors->all() as $messageError)
        <li>{{ $messageError }}</li>
    @endforeach
    <ul>
@endif