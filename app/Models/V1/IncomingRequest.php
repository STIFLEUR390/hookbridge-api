<?php

namespace App\Models\V1;

use App\Filters\V1\IncomingRequestFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class IncomingRequest extends Model
{
    use HasFactory, Filterable, CascadesDeletes;

    protected string $default_filters = IncomingRequestFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
		'type',
		'http_method',
		'headers',
		'payload',
		'status',
		'received_at',
    ];

    /**
     * Les relations qui doivent être supprimées en cascade.
     *
     * @var array<string>
     */
    protected $cascadeDeletes = [
        'deliveryAttempts',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'headers' => 'array',
            'payload' => 'array',
            'received_at' => 'datetime',
        ];
    }

	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

    /**
     * Obtenir les tentatives de livraison de la requête.
     */
    public function deliveryAttempts(): HasMany
    {
        return $this->hasMany(DeliveryAttempt::class);
    }
}