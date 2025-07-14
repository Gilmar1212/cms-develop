@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<form action="{{route('login-api')}}" method="post">
    @csrf
    <input type="email" name="email" placeholder="digite seu email">
    <input type="password" name="password" placeholder="digite sua senha">
    <button type="submit" name="logar">Login</button>
</form>
@endsection