<?php

namespace App\Models\V1;

use App\Filters\V1\ProjectTargetFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProjectTarget extends Model
{
    use HasFactory, Filterable;

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

    protected function casts(): array
    {
        return [
            'requires_authentication' => 'boolean',
            'active' => 'boolean',
        ];
    }

	public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

}