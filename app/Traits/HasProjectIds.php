<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\V1\Project;
use App\Models\V1\IncomingRequest;

trait HasProjectIds
{

    /**
     * Récupère tous les IDs des projets liés à l'utilisateur.
     *
     * @param int $user_id
     */
    public function getProjectIds(int $user_id)
    {
        return Project::where('user_id', $user_id)->pluck('id');
    }

    /**
     * Récupère tous les IDs des requêtes entrantes liées aux projets de l'utilisateur.
     *
     * @param int $user_id
     */
    public function getIncomingRequestIds(int $user_id)
    {
        $projectIds = $this->getProjectIds($user_id);
        return IncomingRequest::whereIn('project_id', $projectIds)->pluck('id');
    }
}