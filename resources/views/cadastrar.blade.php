@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
<form action="{{route('register-sys.store-usr')}}" method="post">
        @csrf
        <input type="text" name="name" placeholder="digite seu Nome">
        <input type="email" name="email" placeholder="digite seu email">
        <input type="password" name="password" placeholder="digite sua senha">
        <input type="password" name="password_confirmation" placeholder="confirme sua senha">
        <input type="submit" value="Enviar">
    </form>

</div>
@endsection