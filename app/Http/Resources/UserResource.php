<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'avatar_url' => $this->avatar_url,
            'email' => $this->email,
            'about' => $this->about,
            'ambitions' => $this->ambitions,
            'skills' => $this->skills,
            'email_verified_at' => $this->email_verified_at
        ];
    }
}
