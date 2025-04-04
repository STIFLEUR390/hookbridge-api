<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\ProjectTarget;

use App\Http\Resources\V1\Project\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ProjectTargetResource extends JsonResource
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
            'project_id' => $this->project_id,
            'url' => $this->url,
            'requires_authentication' => $this->requires_authentication,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'project' => $this->whenLoaded('project', fn() => new ProjectResource($this->project)),
        ];
    }
}
