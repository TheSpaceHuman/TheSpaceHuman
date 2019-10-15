<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function passwords()
    {
      $passwords = Log::orderBy('updated_at', 'DESC')
          ->where('user_id', auth()->user()->id)
          ->where('loggable_type', 'App\Password')
          ->limit(10)
          ->get();

      return LogResource::collection($passwords);
    }

}
