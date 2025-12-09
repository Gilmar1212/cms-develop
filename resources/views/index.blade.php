@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
<form action="{{route('login-sys.login')}}" method="post">
        @csrf
        <input type="email" name="email" placeholder="digite seu email">
        <input type="password" name="password" placeholder="digite sua senha">
        <button type="submit" name="logar">Login</button>
    </form>
    <a href="{{route('register-sys.register')}}" title="Cadastrar">Registrar</a>    
    <!-- <button id="recarregar" class="dash-btn">Recarregar Posts</button> -->
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <script>
        document.getElementById('recarregar').addEventListener('click', () => {
            fetch('/api/blogs') // você pode ter essa rota separada só pra JS
                .then(res => res.json())
                .then(data => {
                    const lista = document.getElementById('lista-posts');
                    lista.innerHTML = ''; // limpa a lista atual

                    data.forEach(post => {
                        const li = document.createElement('li');

                        lista.appendChild(li);
                    });
                });
        });
    </script>
    @endsection