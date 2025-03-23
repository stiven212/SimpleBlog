<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'user' => User::find($this->user_id),
            'user_link' => "/api/users/". $this->user_id,
//            'updated_at' => $this->updated_at,
        ];
    }
}
