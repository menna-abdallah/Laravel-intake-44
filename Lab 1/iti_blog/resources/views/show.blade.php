@extends("layout.app")

@section("content")
        <div class="card" style="width: 18rem;">
            <img height="300"
                src="{{asset('images/posts/'.$post['image'])}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$post['title']}}</h5>
                <p class="card-text">content:{{$post['body']}}</p>
                <a href="{{route("post.home")}}" class="btn btn-primary">Back</a>
            </div>
        </div>
@endsection