@extends('admin.layouts.base')

@section('content')
    <form class="container" action="{{route('admin.posts.update',$post->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Contenuto:</label>
            <textarea class="form-control"  id="content" name="content" rows="3">{{old('content' , $post->content)}}</textarea>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Modifica</button>
          </div>
    </form>
@endsection