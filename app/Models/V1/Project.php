<?php

namespace App\Models\V1;

use App\Filters\V1\ProjectFilters;
use App\Models\V1\ProjectTarget;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, Filterable;

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

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'provider_config' => 'array',
        ];
    }

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(\App\Models\User::class);
	}

    public function projectTargets(): HasMany
    {
        return $this->hasMany(ProjectTarget::class);
    }
}
