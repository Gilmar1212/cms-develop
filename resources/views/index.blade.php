@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
        @endauth
    </div>
    @endif

    <a class="dash-btn" href="{{route('blog.create')}}" title="Blog">Cadastrar Post</a>
    <form action="{{route('blog.edit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="email">E-mail:</label><br>
            <input type="text" value="{{old('email')}}" name="email" id="email" required>
        </div>
        <div>
            <label for="senha">Senha:</label><br>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Send</button>
    </form>
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