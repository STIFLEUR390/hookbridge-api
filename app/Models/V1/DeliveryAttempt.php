<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Filters\V1\DeliveryAttemptFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class DeliveryAttempt extends Model
{
    use Filterable;
    use HasFactory;

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

    public function incomingRequest(): BelongsTo
    {
        return $this->belongsTo(IncomingRequest::class, 'incoming_request_id');
    }

    public function projectTarget(): BelongsTo
    {
        return $this->belongsTo(ProjectTarget::class);
    }

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
}