<?php

namespace App\Models\V1;

use App\Filters\V1\IncomingRequestFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class IncomingRequest extends Model
{
    use HasFactory, Filterable;

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

	public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
	{
		return $this->belongsTo(Project::class);
	}

}
