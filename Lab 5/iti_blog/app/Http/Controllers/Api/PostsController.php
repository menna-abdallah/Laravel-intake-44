<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostsResource;
class PostsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    private function file_operations($request){
        if($request->hasFile('image')){

            $image = $request->file('image');
            $filepath=$image->store("images","posts_uploads" );
            return $filepath;

        }
        return null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();
        return PostsResource::collection($posts);

}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             # validate post request
             $post_validator = Validator::make($request->all(),
             [
                 'title' => 'required|unique:posts',
                 'body' => 'required'
             ]);

         if ($post_validator->fails()) {
             return response()->json(
                 [
                     'validation_errors' => $post_validator->errors(),
                     'message' =>'please review your post form data',
                     'typealert'=>'danger'
                 ], 422
             );
         }
 
         $file_path = $this->file_operations($request);
         $request_parms = request()->all();
         $request_parms['image'] = $file_path;
         $request_parms['user_id']=Auth::id();
         $post = Posts::create($request_parms);
         $post->save();
         return new PostsResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $posts)
    {
        //
        return new PostsResource($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $posts)
    {
        //
        $post_validator = Validator::make($request->all(),
            [
                'body' => 'required',
                'title' => Rule::unique('posts')->ignore($posts)
            ]);


        if ($post_validator->fails()) {
            return response()->json(
                [
                    'validation_errors' => $post_validator->errors(),
                    'message' =>'please review your post form data',
                    'typealert'=>'danger'
                ], 422
            );
        }

        $file_path = $this->file_operations($request);
        $request_parms = request()->all();

        if($file_path != null){
            $request_parms['image'] = $file_path;
        }

        $posts->update($request_parms);
        return new PostsResource($posts);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $posts)
    {
        //
        $posts->delete();
        return response()->json('delete', 204);
    }
}
