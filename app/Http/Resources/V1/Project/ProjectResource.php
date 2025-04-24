<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Project;

use App\Enums\ProjectType;
use App\Http\Resources\V1\ProjectTarget\ProjectTargetResource;
use App\Http\Resources\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProjectResource extends JsonResource
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
            'type' => $this->type->value,
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
            'projectTargets' => $this->whenLoaded('projectTargets', fn() => ProjectTargetResource::collection($this->projectTargets)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->active ? 'actif' : 'inactif',
            'url_callback' => $this->type === 'callback' ? route('hook.callback', ['uuid' => $this->uuid]) : route('hook.webhook', ['uuid' => $this->uuid]),
            'domain_url' => $this->allowed_subdomain ?? "https://{$this->allowed_domain}",
        ];
    }
}