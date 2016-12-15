@extends('layouts.master_email')

@section('content')
<p>Assamualaikum wr wb <strong>{{$emailData['name']}}</strong> </p>
<p>
Password baru untuk login ke QuranMemo adalah : </p>
<strong class="password">{{$emailData['newPassword']}}</strong>

@endsection