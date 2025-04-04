<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\IncomingRequest;

use App\Http\Resources\V1\Project\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class IncomingRequestResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'type' => $this->type,
            'http_method' => $this->http_method,
            'headers' => $this->headers,
            'payload' => $this->payload,
            'status' => $this->status,
            'received_at' => $this->received_at->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}
