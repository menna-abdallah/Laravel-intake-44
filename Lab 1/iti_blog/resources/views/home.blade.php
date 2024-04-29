@extends('layout.app')

@section('content')
    <h1 style="background-color: white;">All posts</h1>
    <a href="{{ route('post.create') }}" class="btn btn-info">Create Post</a>
    <table class='table'> 
        <tr>
            <td>ID</td> 
            <td>Title</td>
            <td>Content</td> 
            <td>Show</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr> 
        @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['body'] }}</td>
                <td><a href="{{ route('post.show', $post['id']) }}" class="btn btn-info">Show</a></td>
                <td><a href="{{ route('post.edit', $post['id']) }}" class="btn btn-info">Edit</a></td>
                <td><form method="post" action="{{route('posts.destroy', $post['id'])}}">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
