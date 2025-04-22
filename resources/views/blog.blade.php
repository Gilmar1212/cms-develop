@extends('layouts.template')
    @section('title','Blog')
    @section('content')
    <a href="{{route('showjson')}}" title="json">teste</a>
    <form action="{{route('store')}}" method="post">
        @csrf
        <div>
            <label for="title">Blog Title:</label><br>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="content">Content:</label><br>
            <textarea name="content" id="content" required></textarea>
        </div>        
        <button type="submit">Send</button>
    @endsection