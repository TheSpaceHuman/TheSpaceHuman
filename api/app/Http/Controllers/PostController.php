<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->where('user_id', auth()->user()->id)->get();

        PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'title' => 'required|string|max:255',
          'body' => 'required|string'
      ]);

      $post = Post::create([
          'title' => $request->title,
          'body' =>  $request->body,
          'tags' => $request->tags,
          'user_id' => auth()->user()->id
      ]);

      $post->log()->create([
          'message' => 'Добавлен новый пост: ' . $post->title,
          'type' => 'create',
          'user_id' => auth()->user()->id
      ]);

      return response()->json(['message' => [
          'type' => 'success',
          'body' => 'Новый пост успешно добавлен'
      ]
      ]);


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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $post = Post::find($id);
      if($post->user_id === auth()->user()->id) {
        $updatedPost = $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'tags' => $request->input('tags'),
        ]);

        $updatedPost->log()->create([
            'message' => 'Изменен пост: ' . $post->title,
            'type' => 'update',
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'post' => $updatedPost,
            'message' => [
                'type' => 'success',
                'body' => 'Пост успешно обновлен'
            ]
        ]);
      } else {
        return response()->json(['message' => [
            'type' => 'warning',
            'body' => 'Данный пост не ваш!'
        ]
        ]);
      }
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

      if($post->user_id === auth()->user()->id) {
        $post->delete();

        $post->log()->create([
            'message' => 'Удалён пост: ' . $post->title,
            'type' => 'delete',
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => [
                'type' => 'success',
                'body' => 'Пост успешно удалён!'
            ]
        ]);
      } else {
        return response()->json(['message' => [
            'type' => 'warning',
            'body' => 'Данный пост не ваш!'
        ]
        ]);
      }
    }
}
