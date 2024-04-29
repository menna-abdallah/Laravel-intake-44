<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    private $posts= [
        ['id'=>1, 'title'=>'post1', 'body'=>'content1', 'image'=>'pic1.jpg'],
        ['id'=>2, 'title'=>'post2', 'body'=>'content2','image'=>'pic1.jpg'],
        ['id'=>3, 'title'=>'post3', 'body'=>'content3','image'=>'pic1.jpg'],
        ['id'=>4, 'title'=>'post4', 'body'=>'content4', 'image'=>'pic1.jpg']
    ];

    public function index (){
        return view("home", ["posts"=>$this->posts]);
    }

    public function show($id){
        if ($id <= count($this->posts)) {
            $post = $this->posts[$id - 1];
            return view('show', ["post" => $post]);
        }
        return abort(404);
    }

    public function edit($id){
        if ($id <= count($this->posts)) {
            $post = $this->posts[$id - 1];
            return view('edit', ["post" => $post]);
        }
        return abort(404);
    }
    public function destroy($id)
    {
        $postIndex = $id - 1;

        if ($postIndex < count($this->posts)) {
            unset($this->posts[$postIndex]);

            $this->posts = array_values($this->posts);
            return view('home', ["posts" => $this->posts]);
        }

        return abort(404);
    }
 


    public function create()
    {
        // Add logic to return the view for creating a new post
        return view('create');
    }
}
