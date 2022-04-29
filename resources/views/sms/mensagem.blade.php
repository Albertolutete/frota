@extends('layouts.app')
@section('content')
<h1 style="color:{{$mensagem['cor']}}; font-size:25px;">{{$mensagem['sms']}} </h1>

<a href="{{route($mensagem['routa'])}}" class="btn" style="margin-left:30%;background-color:#2d88ff;color:white;">{{$mensagem['label']}}</a>
@endsection