<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;

// Commande pour démarrer le worker de queue
Artisan::command('queue:start', function (): void {
    $this->info('Démarrage du worker de queue...');
    $this->call('queue:work', [
        '--tries' => 3,
        '--timeout' => 60,
        '--sleep' => 3,
        '--max-jobs' => 1000,
        '--max-time' => 3600,
        '--stop-when-empty' => true,
    ]);
})->purpose('Démarrer le worker de queue avec les paramètres optimisés pour la production')
->everyMinute();

// Commande pour nettoyer les jobs échoués
Artisan::command('queue:cleanup', function (): void {
    $this->info('Nettoyage des jobs échoués...');
    $this->call('queue:prune-failed');
})->purpose('Nettoyer les jobs échoués de plus de 24 heures')
->hourlyAt(17);

// Commande pour redémarrer les workers
Artisan::command('queue:restart-workers', function (): void {
    $this->info('Redémarrage des workers de queue...');
    $this->call('queue:restart');
})->purpose('Redémarrer tous les workers de queue')
->dailyAt('01:00');