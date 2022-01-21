@extends('layouts.app')
@section('content')
<div class="container">
    
<form action="{{ url('/establecimiento') }}" method="post" enctype="multipart/form-data">
@csrf
@include('establecimiento.form',['modo'=>'Crear']);

</form>
</dir>
@endsection