<?php

namespace App\Models\V1;

use App\Filters\V1\ProjectTargetFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class ProjectTarget extends Model
{
    use HasFactory, Filterable, CascadesDeletes;

    protected string $default_filters = ProjectTargetFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
		'url',
		'requires_authentication',
		'secret',
		'active',
    ];

    /**
     * Les relations qui doivent être supprimées en cascade.
     *
     * @var array<string>
     */
    protected $cascadeDeletes = [
        'deliveryAttempts',
    ];

    protected function casts(): array
    {
        return [
            'requires_authentication' => 'boolean',
            'active' => 'boolean',
        ];
    }

	public function project(): BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

    /**
     * Obtenir les tentatives de livraison de la cible.
     */
    public function deliveryAttempts(): HasMany
    {
        return $this->hasMany(DeliveryAttempt::class);
    }
}