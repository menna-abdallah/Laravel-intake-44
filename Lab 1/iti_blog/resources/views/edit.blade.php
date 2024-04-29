@extends("layout.app")
@section("content")

<h1>Edit Post</h1>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group m-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post['title'] }}">
        </div>
        <div class="form-group m-4">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body">{{ $post['body'] }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary m-4">Update Post</button>
        <a href="{{route("post.home")}}" class="btn btn-primary">Back</a>

    </form>
@endsection