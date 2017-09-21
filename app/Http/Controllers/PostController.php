<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $posts = Post::all();
//        return $post;
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //

        $input = $request->all();
        $file = $input['file'];
        $file->move('Images', $file->getClientOriginalName());
        $input['path'] = $file->getClientOriginalName();
        Post::create($input);
        return redirect('/posts');

//        $file->move('Images', $file->getClientOriginalName());




//        Post::create(['name'=>$request->name, 'title'=>$request->title, 'description'=>$request->description]);
//        $post = new Post();
//        $post->name = $request->name;
//        $post->save($request->all());
//        return redirect('/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findorfail($id);
        return view('posts.show', compact('post'));
//        return $post->name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findorfail($id);
        return view('posts.edit', compact('post'));
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
        //
        $post = Post::findorfail($id);
        $post->name = $request->name;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::whereId($id)->delete();
        return redirect('/posts');
    }
}
