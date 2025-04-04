<?php

declare(strict_types=1);

namespace App\Models\V1;

use App\Enums\ProjectType;
use App\Filters\V1\ProjectFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

final class Project extends Model
{
    use CascadesDeletes;
    use Filterable;
    use HasFactory;

    /**
     * Types de projets disponibles
     */
    public const TYPE_CALLBACK = 'callback';
    public const TYPE_WEBHOOK = 'webhook';

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
        'type',
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

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'provider_config' => 'array',
            'type' => ProjectType::class,
        ];
    }
}
