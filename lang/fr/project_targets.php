<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Messages de cibles de projet
    |--------------------------------------------------------------------------
    |
    | Les messages suivants sont utilisés pour les cibles de projet.
    |
    */

    // Messages de succès
    'created' => 'Cible de projet créée avec succès',
    'updated' => 'Cible de projet mise à jour avec succès',
    'deleted' => 'Cible de projet supprimée avec succès',
    'status_activated' => 'Cible activée avec succès',
    'status_deactivated' => 'Cible désactivée avec succès',

    // Messages d'erreur
    'not_found' => 'Cible de projet non trouvée',
    'already_exists' => 'Une cible avec cette URL existe déjà pour ce projet',

    // Attributs
    'attributes' => [
        'project_id' => 'projet',
        'type' => 'type',
        'url' => 'URL',
        'is_active' => 'statut actif',
    ],

    // Types
    'types' => [
        'webhook' => 'Webhook',
        'callback' => 'Callback',
    ],
];