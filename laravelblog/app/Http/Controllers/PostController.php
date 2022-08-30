<?php

namespace App\Http\Controllers;

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
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company' => 'nullable',
            'date' => 'nullable',
            'photo' => 'nullable'
        ]);
        if (!empty($request['photo'])) {
            $post = new Post();
            $post->name = $request->input('name');
            $post->company = $request->input('company');
            $post->phone = $request->input('phone');
            $post->email = $request->input('email');
            $post->date = $request->input('date');
            $path = $request->file('photo')->store('photos', 'public');
            $post->photo = $path;
            $post->save();
        } else {
            Post::create($validatedData);
        }

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
        $validatedData =  $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company' => 'nullable',
            'date' => 'nullable',
            'photo' => 'nullable'
        ]);

        if (!empty($request['photo'])) {
            $post->update($validatedData);
            $post->date = $request->input('date');
            $path = $request->file('photo')->store('photos', 'public');
            $post->photo = $path;
            $post->save();
        } else {
            $post->update($validatedData);
        }
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
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'post deleted successfully');
    }
}
