@extends('admin.layouts.base')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
            {{$post->category->name}}
            </div>
            <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->content}}</p>
            <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna a tutti i Post</a>
            </div>
        </div>
    </div>
@endsection
