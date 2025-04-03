<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Messages d'API
    |--------------------------------------------------------------------------
    |
    | Les messages suivants sont utilisés pour les réponses d'API.
    |
    */

    // Messages de succès
    'success' => 'Opération réussie',
    'created' => 'Ressource créée avec succès',
    'updated' => 'Ressource mise à jour avec succès',
    'deleted' => 'Ressource supprimée avec succès',
    'status_changed' => 'Statut modifié avec succès',

    // Messages d'erreur
    'not_found' => 'Ressource non trouvée',
    'bad_request' => 'Requête invalide',
    'unauthorized' => 'Non autorisé',
    'forbidden' => 'Accès interdit',
    'validation_error' => 'Erreur de validation',
    'server_error' => 'Erreur serveur',

    // Messages de validation
    'required' => 'Le champ :attribute est requis',
    'email' => 'Le champ :attribute doit être une adresse e-mail valide',
    'min' => 'Le champ :attribute doit contenir au moins :min caractères',
    'max' => 'Le champ :attribute ne peut pas dépasser :max caractères',
    'unique' => 'La valeur du champ :attribute est déjà utilisée',

    // Messages de pagination
    'pagination' => [
        'first' => 'Première page',
        'last' => 'Dernière page',
        'next' => 'Page suivante',
        'previous' => 'Page précédente',
    ],
];