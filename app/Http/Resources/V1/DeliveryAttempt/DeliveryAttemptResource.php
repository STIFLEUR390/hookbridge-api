<?php

namespace App\Http\Resources\V1\DeliveryAttempt;

use App\Http\Resources\V1\IncomingRequest\IncomingRequestResource;
use App\Http\Resources\V1\ProjectTarget\ProjectTargetResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryAttemptResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'incoming_request_id' => $this->incoming_request_id,
            'incoming_request' => new IncomingRequestResource($this->whenLoaded('incomingRequest')),
            'project_target_id' => $this->project_target_id,
            'project_target' => new ProjectTargetResource($this->whenLoaded('projectTarget')),
            'attempt_count' => $this->attempt_count,
            'status' => $this->status,
            'response_code' => $this->response_code,
            'response_body' => $this->response_body ? json_decode($this->response_body, true) : null,
            'next_attempt_at' => $this->next_attempt_at?->toIso8601String(),
            'last_attempt_at' => $this->last_attempt_at?->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
            'updated_at' => $this->updated_at->toIso8601String(),
        ];
    }
}