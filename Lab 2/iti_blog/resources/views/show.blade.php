@extends("layout.app")

@section("content")
        <div class="card" style="width: 18rem;">
            <img height="300"
                src="{{asset('images/posts/'.$post->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">Author:{{$post->user}}</p>
                <p class="card-text">Created_at:{{$post->created_at}}</p>
                <p class="card-text">Content:{{$post->body}}</p>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back to all posts </a>
            </div>
        </div>
@endsection


