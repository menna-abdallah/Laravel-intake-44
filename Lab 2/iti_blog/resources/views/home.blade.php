@extends('layout.app')


@section('content')

    <h1 style="background-color: white;"> All posts</h1>
    <a href="{{route('posts.create')}}" class="btn btn-dark">Create new post </a>
    <table class='table'> 
        <tr>
             <td>ID </td>
             <td> Title</td>
             <td> Content</td> 
             <td> BY</td>
             <td> created AT</td>
             <td> Show </td>
            <td> Edit</td>
            <td> Delete</td>
        </tr>
        @foreach($posts as $post)
            <tr>
                <td> {{$post->id}}</td>
                <td> {{$post->title}}</td>
                <td> {{$post->body}}</td>
                <td> {{$post->user}}</td>
                <td> {{$post->created_at}}</td>
                <td> 
                <x-button type="primary"><a href="{{route('posts.show', $post->id)}}" class="text-white text-decoration-none" >view </a></x-button>
                </td>
                <td> 
                <x-button type="secondary"><a href="{{route('posts.edit', $post->id)}}" class="text-white text-decoration-none" >Edit </a></x-button>
                </td>

                <td>
                    <form method="post" action="{{route('posts.destroy', $post->id)}}">
                        @method('delete')
                        @csrf
                        <x-button type="danger">
                        <input type="submit" value="Delete" class="bg-danger text-white border-0">
                        </x-button>
                    </form>
                </td> 

            </tr>

        @endforeach

    </table>

   


{{ $posts->links() }}

@endsection