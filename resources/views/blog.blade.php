@extends('layouts.template')
@section('title','Blog')
@section('content')
<form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Titulo:</label><br>
        <input type="text" name="title" id="title" required>
    </div>
    <div>
        <label for="title">Breve descrição:</label><br>
        <input type="text" name="short_description" id="short-description">
    </div>
    <div>
        <label for="content">Content:</label><br>
        <textarea name="content" id="content" required></textarea>
    </div>
    <div>
        <label for="image">image:</label><br>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <button type="submit">Send</button>
</form>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection