<?php

namespace App\Models\V1;

use App\Filters\V1\DeliveryAttemptFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryAttempt extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = DeliveryAttemptFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'incoming_request_id',
        'project_target_id',
        'attempt_count',
        'status',
        'response_code',
        'response_body',
        'next_attempt_at',
        'last_attempt_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'attempt_count' => 'integer',
            'response_code' => 'integer',
            'next_attempt_at' => 'datetime',
            'last_attempt_at' => 'datetime',
        ];
    }

    public function incomingRequest(): BelongsTo
    {
        return $this->belongsTo(IncomingRequest::class);
    }

    public function projectTarget(): BelongsTo
    {
        return $this->belongsTo(ProjectTarget::class);
    }
}