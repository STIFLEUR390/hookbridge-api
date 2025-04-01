<?php

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    /*
     * Chemin de l'API. Par défaut, toutes les routes commençant par ce chemin seront ajoutées à la documentation.
     */
    'api_path' => 'api/v1',

    /*
     * Domaine de l'API. Par défaut, le domaine de l'application est utilisé.
     */
    'api_domain' => null,

    /*
     * Le chemin où la spécification OpenAPI sera exportée.
     */
    'export_path' => 'api/v1/openapi.json',

    'info' => [
        /*
         * Version de l'API.
         */
        'version' => env('API_VERSION', '1.0.0'),

        /*
         * Description affichée sur la page d'accueil de la documentation API.
         */
        'description' => <<<'EOT'
# API HookBridge

Cette API permet de gérer les projets et leurs configurations pour le service HookBridge.

## Authentification

L'API utilise l'authentification par token Sanctum. Pour utiliser l'API, vous devez :

1. Obtenir un token d'authentification via la route `/api/v1/auth/login`
2. Inclure le token dans l'en-tête `Authorization: Bearer {token}` de vos requêtes

## Projets

Les projets sont les entités principales de l'API. Chaque projet contient :

- Un nom unique
- Un domaine autorisé
- Un sous-domaine optionnel (URL complète)
- Une configuration de fournisseur
- Un statut actif/inactif

## Sécurité

- Toutes les routes sont protégées par authentification
- Les utilisateurs ne peuvent accéder qu'à leurs propres projets
- Les tokens d'authentification expirent après 24 heures
EOT
    ],

    /*
     * Personnalisation de l'interface utilisateur Stoplight Elements
     */
    'ui' => [
        /*
         * Define the title of the documentation's website. App name is used when this config is `null`.
         */
        'title' => 'HookBridge API Documentation',

        /*
         * Define the theme of the documentation. Available options are `light` and `dark`.
         */
        'theme' => 'light',

        /*
         * Hide the `Try It` feature. Enabled by default.
         */
        'hide_try_it' => false,

        /*
         * Hide the schemas in the Table of Contents. Enabled by default.
         */
        'hide_schemas' => false,

        /*
         * URL to an image that displays as a small square logo next to the title, above the table of contents.
         */
        'logo' => '',

        /*
         * Use to fetch the credential policy for the Try It feature. Options are: omit, include (default), and same-origin
         */
        'try_it_credentials_policy' => 'include',
    ],

    /*
     * Liste des serveurs de l'API
     */
    'servers' => null,

    /**
     * Stratégie de stockage des descriptions des cas d'énumération
     */
    'enum_cases_description_strategy' => 'description',

    'middleware' => [
        'web',
        RestrictedDocsAccess::class,
    ],

    'extensions' => [],
];