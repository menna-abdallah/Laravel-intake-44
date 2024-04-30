<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Posts;

class PostController extends Controller
{
    protected $fillable = ['title', 'body', 'image', 'user', '_token'];

    public function index()
    {
        $posts = Posts::paginate($perPage = 5, $columns = ['*'], $pageName = 'posts');


        return view('home', ['posts' => $posts]);
    }


    public function create()
    {
        $users = User::all();
        return view('create', compact('users'));    
    }
    function show($id){

        $post = Posts::findOrFail($id); 
        return view('show', ['post' => $post]);
            }
    private function file_operations($request){
        if($request->hasFile('image')){

            $image = $request->file('image');
            $filepath=$image->store("images","posts_uploads" );
            return $filepath;

        }
        return null;
    }
    function store(){
        $request_parms = request();

        $file_path = $this->file_operations($request_parms);
        $request_parms = request()->all();

        $post = new Posts();
        $post->title = $request_parms['title'];
        $post->body = $request_parms['body'];
        $post->image = $file_path;
        $post->user = $request_parms['user'];
        $post->save();
        return to_route("posts.show", $post->id);

    }
    function edit($id){
        $post = Posts::findOrFail($id);
        return view('edit', ['post' => $post]);
    }

    function update( $id){

        $post = Posts::findOrFail($id);
        $updated_data = request()->all();
        // dump($updated_data);
        $post->title = $updated_data['title'];
        $post->body = $updated_data['body'];
        $post->save();

        return to_route("posts.show", $post->id);
    }
    

    function destroy($id){
        $post = Posts::findOrFail($id);
        $post->delete();
        return to_route('posts.index');

    }

}


