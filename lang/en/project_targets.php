<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Project Target Messages
    |--------------------------------------------------------------------------
    |
    | The following messages are used for project targets.
    |
    */

    // Success messages
    'created' => 'Project target created successfully',
    'updated' => 'Project target updated successfully',
    'deleted' => 'Project target deleted successfully',
    'status_activated' => 'Target activated successfully',
    'status_deactivated' => 'Target deactivated successfully',

    // Error messages
    'not_found' => 'Project target not found',
    'already_exists' => 'A target with this URL already exists for this project',

    // Attributes
    'attributes' => [
        'project_id' => 'project',
        'type' => 'type',
        'url' => 'URL',
        'is_active' => 'active status',
    ],

    // Types
    'types' => [
        'webhook' => 'Webhook',
        'callback' => 'Callback',
    ],
];
