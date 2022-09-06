<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Отображает список ресурсов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = new  Post();
        return view('posts.index', ['posts'  => $posts->paginate(5)]);
    }

    /**
     * Выводит форму для создания нового ресурса
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Помещает созданный ресурс в хранилище
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company' => 'nullable',
            'date' => 'nullable',
            'photo' => 'nullable',
        ]);
    
        $post = new Post();
        $post->name = $request-> input('name');
        $post->company = $request-> input('company');
        $post->phone = $request-> input('phone');
        $post->email = $request-> input('email');
        $post->date = $request-> input('date');
    
        if($request->hasFile('photo')) {
            $post->photo = $request->file('photo')->store('photos', ['disk'=>'public']);

        } 
    $post->save();
    
        
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Отображает указанный ресурс.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Выводит форму для редактирования указанного ресурса
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Обновляет указанный ресурс в хранилище
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
          $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company' => 'nullable',
            'date' => 'nullable',
            'photo' => 'nullable'
        ]);

        // dd($validatedData);
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('photos', basename($post->photo), ['disk'=>'public']);
        }
        $post->update($request->all());
        
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

   

    
    /**
     * Удаляет указанный ресурс из хранилища
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // dd($post);
        $post->delete();
        if ($post->delete() === true){
            if(Storage::disk('public')->exists($post->photo)=== true){ 
                Storage::disk('public')->delete('photos', ['disk'=>'public']); //Скорее всего ошибка
                // $post->file('photo')->delete('photos', ['disk'=>'public']);
        //    dd();
            }
        return redirect()->route('posts.index')
            ->with('success', 'post deleted successfully');
        } else {
        return redirect()->route('posts.index')
            ->with('error', 'post is not deleted');
        }

    }
}
