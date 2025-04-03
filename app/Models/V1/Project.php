<?php

namespace App\Models\V1;

use App\Filters\V1\ProjectFilters;
use App\Models\V1\ProjectTarget;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Project extends Model
{
    use HasFactory, Filterable, CascadesDeletes;

    protected string $default_filters = ProjectFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'allowed_domain',
		'allowed_subdomain',
		'header',
		'provider_config',
		'uuid',
		'active',
		'user_id',
    ];

    /**
     * Les relations qui doivent être supprimées en cascade.
     *
     * @var array<string>
     */
    protected $cascadeDeletes = [
        'projectTargets',
        'incomingRequests',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'provider_config' => 'array',
        ];
    }

	public function user(): BelongsTo
	{
		return $this->belongsTo(\App\Models\User::class);
	}

    /**
     * Obtenir les cibles du projet.
     */
    public function projectTargets(): HasMany
    {
        return $this->hasMany(ProjectTarget::class);
    }

    /**
     * Obtenir les requêtes entrantes du projet.
     */
    public function incomingRequests(): HasMany
    {
        return $this->hasMany(IncomingRequest::class);
    }
}