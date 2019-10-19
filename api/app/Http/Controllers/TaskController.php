<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('updated_at', 'DESC')->where('user_id', auth()->user()->id)->get();

        return TaskResource::collection($tasks);
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
          'body' => 'required|string',
          'end' => 'required|date'
      ]);

      $post = Task::create([
          'title' => $request->title,
          'body' =>  $request->body,
          'end' => $request->end,
          'user_id' => auth()->user()->id
      ]);

      $post->log()->create([
          'message' => 'Добавлена новая задача: ' . $post->title,
          'type' => 'create',
          'user_id' => auth()->user()->id
      ]);

      return response()->json(['message' => [
          'type' => 'success',
          'body' => 'Новая задача успешно добавлена'
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
      $task = Task::find($id);
      if($task->user_id === auth()->user()->id) {
        $updatedTask = $task->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'end' => $request->input('end'),
        ]);

        $updatedTask->log()->create([
            'message' => 'Изменена задача: ' . $task->title,
            'type' => 'update',
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'post' => $updatedTask,
            'message' => [
                'type' => 'success',
                'body' => 'Задача успешно обновлена'
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
      $task = Task::find($id);

      if($task->user_id === auth()->user()->id) {
        $task->delete();

        $task->log()->create([
            'message' => 'Удалёна задача: ' . $task->title,
            'type' => 'delete',
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => [
                'type' => 'success',
                'body' => 'Задача успешно удалена!'
            ]
        ]);
      } else {
        return response()->json(['message' => [
            'type' => 'warning',
            'body' => 'Данная задача не ваш!'
        ]
        ]);
      }
    }
}
