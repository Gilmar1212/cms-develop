@extends('layouts.template')
@section('title', 'Doutores cms')
@section('content')
    <a class="dash-btn" href="{{route('blog')}}" title="Blog">Blog</a>
    @isset($posts)
        <ul id="lista-posts">
            @foreach ($posts as $post)
                <li>
                    <strong>Titulo: {{ $post->title }}</strong><br>
                    <span>Conteúdo: {{ $post->content }}</span>
                </li>
                <img src="{{ asset('storage/' . $post->image_slug) }}" alt="Imagem do Blog" width="200">
            @endforeach
        </ul>
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