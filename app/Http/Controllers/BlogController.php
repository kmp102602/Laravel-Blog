<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getIndex(){

    	// Fech all from the DB
    	$post = Post::paginate(10);


    	// Return a view 
    	return view('blog.index')->with('posts', $post);

    }


    public function getSingle($slug) {
    	
    	// fetch from the DB based on the slug
    	$post = Post::where('slug', '=', $slug)->first();

    	// Return the view and pass in the post
    	return view('blog.single')->with('post', $post);
    }
}
