<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Session;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable to store all the blog post in it from the database
        $posts = Post::all();        

        // return a view an pass in the above variable
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return View('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'title'       => 'required|max:255',
            'body'        => 'required',
            'slug'        => 'required|alpha_dash|min:5|max:255|unique:posts,slug',            
            'category_id' => 'required|integer',
            'featured_image' => 'sometimes|image'
            ));

        // store in the database
        $post = new Post;

        $post->title = $request->title;
        $post->body  = Purifier::clean($request->body);
        $post->slug  = $request->slug;        
        $post->category_id = $request->category_id;

        //save our image
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();            
            
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->tags()->sync($request->tags, false); //true will clear any tags assocation that already exsits, false will add to wis there.

        Session::flash('success', 'The blog post was successfully saved!');

        // redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // fine the post in the database and save to a var
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        //puts categories into an array so is can be used in the select field in the edit view.
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags2 =array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        // return the view and pass in the var we previously created
        return view('posts.edit')->with('post', $post)->with('categories', $cats)->with('tags', $tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate the data
       
        $post = Post::find($id);

        
        $this->validate($request, array(
        'title' => 'required|max:255',
        'body'  => 'required',
        'slug'  => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
        'category_id' => 'required|integer',
        'featured_image' => 'image'            
        ));        

        //Save the data to the database
        $post = Post::find($id);        
        $post->title = $request->input('title');
        $post->body  = Purifier::clean($request->input('body'));
        $post->slug  = $request->input('slug');
        $post->category_id = $request->input('category_id');

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);            
            $oldFilename = $post->image;
            $post->image = $filename;

            //Storage::delete($oldFilename);
            if ($oldFilename){
                unlink(public_path('images/' . $oldFilename));
            }
        }

        $post->save();

        if (isset($request->tags)) {
        $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array());
        }

        //set flash data with success message
        Session::flash('success', 'This post was successfully saved!');

        //Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $oldImage = $post->image;
        if ($oldImage){
            unlink(public_path('images/' . $oldImage));
        }
        $post->tags()->detach();
        $post->delete();
        Session::flash('success', 'The post was successfully deleted!');

        return redirect()->route('posts.index');

    }
}
