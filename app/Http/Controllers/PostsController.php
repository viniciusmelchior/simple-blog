<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$posts = Post::orderBy('id', 'desc')->take(1)->get();
        
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function userPosts(){

        $post = Post::all();
        $userPosts = $post->where('user_id', '=', Auth::id());

        $title = 'Meus Posts';
        return view('dashboard', ['title' => $title, 'userPosts' => $userPosts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'nullable'
        ]);

        //tratando recebimento de arquivo
        if($request->hasFile('cover_image')){
            //pegando nome do arquivo e a extensão
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //pegando o nome do arquivo
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //pegando a extensao
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //nome a ser armazenado no banco
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //armazenando imagem
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpeg';
        }
        
        //criando post
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->cover_image = $fileNameToStore;
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
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
        return view('posts.show', compact('post'));
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'nullable'
        ]);

        //tratando recebimento de arquivo
        if($request->hasFile('cover_image')){
            //pegando nome do arquivo e a extensão
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //pegando o nome do arquivo
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //pegando a extensao
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //nome a ser armazenado no banco
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //armazenando imagem
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }
        
        //criando post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
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
        if($post->cover_image != 'noimage.jpeg'){
            //apagar imagem
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
