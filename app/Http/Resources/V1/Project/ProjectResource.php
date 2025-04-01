<?php

namespace App\Http\Resources\V1\Project;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request): array
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->active ? 'actif' : 'inactif',
            'domain_url' => $this->allowed_subdomain ?? "https://{$this->allowed_domain}",
        ];
    }
}