<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;



class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::findOrFail($this->user_id);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => "/images/students/{$this->image}",
            'slug' => $this->slug,
            'user_obj' => $this->user_id ? new UserResource($this->user) : null
        ];
    }
}
