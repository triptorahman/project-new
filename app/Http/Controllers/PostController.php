<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('created_by',auth()->user()->id)->get();
        return view('post.list',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $status_array = ['1'=> 'Active','0'=>'Inactive'];
        return view('post.create',compact('status_array'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $added_data = Post::create([
            'title' => $request->title,
            'status' => $request->status,
            'short_description' => $request->short_description,
            'created_by' => auth()->user()->id,

        ]);


        session()->flash('message', "Post Created Successfully");
        return redirect()->route('posts.index');
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
        
    }

    public function print(Request $request)
    {
        // dd($request->all());

        $posts = Post::where('created_by',$request->user_id)->get();

        $data = view('post.list_pdf',compact('posts'))->render();
        return response()->json(['schema' => $data]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $status_array = ['1'=> 'Active','0'=>'Inactive'];
        return view('post.edit',compact('status_array','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        
        $data['title'] = $request->title;
        $data['short_description'] = $request->short_description;
        $data['status'] = $request->status;
        
        
        $post->update($data);

        session()->flash('message', "Post Update Successfully");
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('message', "Post Delete Successfully");
        return redirect()->route('posts.index');
    }
}
