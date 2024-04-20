<?php

namespace App\Http\Resources;

use App\Http\Resources\Tenant\TenantResource;
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
            'email' => $this->email,
            'about' => $this->about,
            'ambitions' => $this->ambitions,
            'email_verified_at' => $this->email_verified_at
        ];
    }
}
