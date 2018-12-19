@if(!empty(session('messageError')))
    <script>
        var messageDetail = "{{{session('messageError') }}}";
        vex.dialog.alert({ unsafeMessage: '<h4>Anda memiliki error :</h4>'+messageDetail });
    </script>
    <!--div class="alert alert-danger">
        <strong>Anda memiliki error :</strong>
        <br>
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	
    </div-->
@endif

@if(!empty(session('messageSuccess')))
    <script>
        var messageDetail = "{{ session('messageSuccess') }}";
        vex.dialog.alert({ unsafeMessage: messageDetail });
    </script>
    <!--div class="alert alert-success">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	
    </div-->
@endif

@if(!empty($messageErrors))
    <script>
        var errorDetail = '';
        errorDetail = '<?php echo implode($messageErrors->all(), ',')?> asdsa';
        vex.dialog.alert({ unsafeMessage: '<h4>Anda memiliki error :</h4>'+errorDetail });
    </script>
@endif


@if(!empty($messageError))
    <script>
        var errorDetail = '';
        vex.dialog.alert({ unsafeMessage: '{{$messageError}}' });
    </script>
@endif


@if(!empty($messageSuccess))
    <script>
        var errorDetail = '';
        vex.dialog.alert({ unsafeMessage: '{{$messageSuccess}}' });
    </script>
@endif