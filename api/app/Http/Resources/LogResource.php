<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'message' => $this->message,
          'type' => $this->type,
          'user_id' => $this->user_id,
          'loggable_id' => $this->loggable_id,
          'loggable_type' => $this->loggable_type,
          'created_at' => date('d/m/Y h:m', strtotime($this->created_at)),
          'updated_at' => date('d/m/Y h:m', strtotime($this->updated_at)),
      ];
    }
}
