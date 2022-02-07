<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);

        $categories = Category::all();

        return view('admin.posts.index', compact('posts','categories'));
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
        return view('admin.posts.create',compact('tags'),compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationData(),$this->validationErrors());
        $data = $request->all();
        $new_post = new Post();
        $data['slug'] = Post::generateSlug($data['title']);
        $new_post->fill($data);
        $new_post->save();

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.index');
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
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();

        
            return view('admin.posts.edit',compact('post','categories','tags'));
                
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate($this->validationData(),$this->validationErrors());
        $data = $request->all();

        $data['slug'] = Post::generateSlug($data['title']);
        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }else{
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show' ,$post);
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
        return redirect()->route('admin.posts.index')->with('deleted',"il post $post->title è stato eliminato");
    }

    private function validationData(){
        return[
            'title' => 'required|max:50|min:2',
            'content' => 'required|max:255|min:2',
        ];
    }
    private function validationErrors(){
        return[
           'title.required' => 'il titolo è un campo obbligatorio',
           'title.max' => 'il numero di caratteri  consentito è di :max caratteri',
           'title.min' => 'il numero di caratteri  consentito è di minimo :min caratteri',
           'content.required' => 'il contenuto è un campo obbligatorio',
           'content.min' => 'il numero di caratteri consentito è di minimo :min caratteri'

        ];
    }
}
