@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
 <h1>Bem-vindo, {{ $user }}</h1>
<p>Seu token: {{ $token }}</p>
    <a class="dash-btn" href="{{route('blog.create')}}" title="Blog">Cadastrar Post</a>
    @if(Auth::user() == true)
    @isset($posts)
    <ul id="lista-posts">
        @foreach ($posts as $post)
        <li>
            <strong>Titulo: {{ $post->title }}</strong><br>
            <span>Conteúdo: {{ $post->content }}</span>
        </li>
        <img src="{{ asset('storage/' . $post->image_url) }}" alt="Imagem do Blog" width="200">
        <a class="dash-btn" href="{{ route('blog.update', ['id' => $post->id]) }}" title="Blog">Alterar Post</a>
        <form action="{{ route('blog.delete', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('Você tem certeza que deseja deletar este post?')">
            @csrf
            @method('DELETE')
            <button type="submit">Deletar</button>
        </form>
        @endforeach
    </ul>
    <!-- <button id="recarregar" class="dash-btn">Recarregar Posts</button> -->
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @endisset
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