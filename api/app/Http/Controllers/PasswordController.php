<?php

namespace App\Http\Controllers;

use App\Http\Resources\PasswordResource;
use App\Password;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $passwords = Password::orderBy('updated_at', 'DESC')->where('user_id', auth()->user()->id)->get();

      return PasswordResource::collection($passwords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = json_encode($request->fields) ;

        Password::create([
            'title' => $request->title,
            'fields' => $fields,
            'user_id' => auth()->user()->id
        ]);

      return response()->json(['message' => 'Новый пароль успешно добавлен']);
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
        $password = Password::find($id);
        if($password->user_id === auth()->user()->id) {
          $fields = json_encode($request->input('fields')) ;
          $updatedPassword = $password->update([
            'title' => $request->input('title'),
            'fields' => $fields
          ]);
          return response()->json([
              'password' => $updatedPassword,
              'message' => [
                  'type' => 'success',
                  'body' => 'Пароль успешно обновлен'
              ]
          ]);
        } else {
          return response()->json(['message' => [
              'type' => 'warning',
              'body' => 'Данный пароль не ваш!'
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
      $password = Password::find($id);

      if($password->user_id === auth()->user()->id) {
        $password->delete();
        return response()->json([
            'message' => [
                'type' => 'success',
                'body' => 'Пароль успешно удалён!'
            ]
        ]);
      } else {
        return response()->json(['message' => [
            'type' => 'warning',
            'body' => 'Данный пароль не ваш!'
          ]
        ]);
      }
    }
}
