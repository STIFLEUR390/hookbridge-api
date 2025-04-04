<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Project Messages
    |--------------------------------------------------------------------------
    |
    | The following messages are used for projects.
    |
    */

    // Success messages
    'created' => 'Project created successfully',
    'updated' => 'Project updated successfully',
    'deleted' => 'Project deleted successfully',
    'status_activated' => 'Project activated successfully',
    'status_deactivated' => 'Project deactivated successfully',

    // Error messages
    'not_found' => 'Project not found',
    'already_exists' => 'A project with this name already exists',

    // Attributes
    'attributes' => [
        'name' => 'name',
        'description' => 'description',
        'is_active' => 'active status',
    ],
];
