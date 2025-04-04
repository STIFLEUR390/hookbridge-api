<?php

use Illuminate\Support\Facades\Artisan;

// Commande pour démarrer le worker de queue
Artisan::command('queue:start', function () {
    $this->info('Démarrage du worker de queue...');
    $this->call('queue:work', [
        '--tries' => 3,
        '--timeout' => 60,
        '--sleep' => 3,
        '--max-jobs' => 1000,
        '--max-time' => 3600
    ]);
})->purpose('Démarrer le worker de queue avec les paramètres optimisés pour la production');

// Commande pour nettoyer les jobs échoués
Artisan::command('queue:cleanup', function () {
    $this->info('Nettoyage des jobs échoués...');
    $this->call('queue:prune-failed', [
        '--hours' => 24
    ]);
})->purpose('Nettoyer les jobs échoués de plus de 24 heures');

// Commande pour redémarrer les workers
Artisan::command('queue:restart-workers', function () {
    $this->info('Redémarrage des workers de queue...');
    $this->call('queue:restart');
})->purpose('Redémarrer tous les workers de queue');