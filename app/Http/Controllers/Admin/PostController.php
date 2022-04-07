<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all();
        return view('admin.posts.create',compact('posts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
            'title'=>'required',
            'content'=>'required|min:20'
        ]);

        $slug=Str::slug($data['title']);

        $counter = 1;

        //                    **PER IL CICLO WHILE**
        //'slug' si riferisce alla colonna della tabella 'post'
        // $slug è il valore che sta cercando nella colonna 'slug' della tabella 'post'


        while (Post::where('slug', $slug)->first()) {
            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;
        }


        //sto aggiungendo a $data (che è un array associativo), un nuovo elemento chiave/valore con la sintassi sotto,
        //in questa maniera posso prendere il valore di slug da 'title', anche se il valore slug non è presente nel form
       
        $data['slug'] = $slug;

        $post = new Post;

        $post->fill($data);
        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        return view('admin.posts.edit', compact('post'));
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
        $data = $request->all();

        $request->validate(
            [
            'title'=>'required',
            'content'=>'required|min:20'
        ]);

        $slug=Str::slug($data['title']);


        //                    **PER IL CICLO WHILE**
        //'slug' si riferisce alla colonna della tabella 'post'
        // $slug è il valore che sta cercando nella colonna 'slug' della tabella 'post'



        //Aggiunto if statement per prevenire che venga assegnato un nuovo slug se non viene modificato il titolo

        if ($post->slug != $slug) {
            $counter = 1;
            while (Post::where('slug', $slug)->first()) {
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }


        //sto aggiungendo a $data (che è un array associativo), un nuovo elemento chiave/valore con la sintassi sotto,
        //in questa maniera posso prendere il valore di slug da 'title', anche se il valore slug non è presente nel form
       
        $data['slug'] = $slug;

        $post = new Post;

        $post->fill($data);
        $post->save();

        return redirect()->route('admin.posts.index');
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
        return redirect()->route('admin.posts.index');
    }
}
