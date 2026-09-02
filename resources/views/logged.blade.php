@extends('layouts.template')
@section('title', 'CMS ALL')
@section('content')
<div>
    <div class="flex flex-row justify-between gap-2">
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
               @csrf
           <button type="submit" class="bg-blue-500 px-3 py-2">Logout</button>
           </form>
           <div><a class="bg-green-400 px-3 py-2" href="{{route('blog.create')}}" title="Blog">Cadastrar Post</a></div>
    </div>
 <h1 class="text-white text-3xl my-5">Bem-vindo, {{ $user }}</h1>
    @if(Auth::user() == true)
    @isset($posts)
    <ul id="lista-posts">
        @foreach ($posts as $post)
        <li>
            <strong>Titulo: {{ $post->title }}</strong><br>
            <span>Conteúdo: {{ $post->content }}</span>
        </li>
        <img src="{{ asset('storage/'.$post->image_url) }}" alt="Imagem do Blog" width="200">
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