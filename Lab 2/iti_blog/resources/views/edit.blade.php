@extends('layout.app')


@section('content')
    <h1>Update Post {{$post->title}} </h1>
    <form method="post" action="{{route('posts.update', $post->id)}}">
    @csrf
        @method('put')
        <div class="form-group m-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div class="form-group m-4">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body">{{ $post->body}}</textarea>
        </div>
        <button type="submit"
                class="btn btn-success">
                Save post</button>
                or
                <a href="{{route("posts.index")}}" class="btn btn-primary">Back to All Posts</a>

    </form>

@endsection