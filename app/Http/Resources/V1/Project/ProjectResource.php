<?php

namespace App\Http\Resources\V1\Project;

use App\Http\Resources\V1\User\UserResource;
use App\Http\Resources\V1\ProjectTarget\ProjectTargetResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'allowed_domain' => $this->allowed_domain,
            'allowed_subdomain' => $this->allowed_subdomain,
            'header' => $this->header,
            'provider_config' => $this->provider_config,
            'uuid' => $this->uuid,
            'active' => $this->active,
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
            'targets' => $this->whenLoaded('targets', fn() => ProjectTargetResource::collection($this->targets)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->active ? 'actif' : 'inactif',
            'domain_url' => $this->allowed_subdomain ?? "https://{$this->allowed_domain}",
        ];
    }
}