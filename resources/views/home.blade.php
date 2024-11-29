@extends('layout.app')

@section('title','home')

@section('content')

<h1 class="text-center"> Bienvenido a Blog-app


   

</h1>
<div class="text-center">
<a href="{{route('login.index')}}">Login</a>
<a  href="{{route('registro.index')}}">Registro</a>
</div>
@endsection