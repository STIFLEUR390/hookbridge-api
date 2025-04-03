<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer la langue depuis le header 'Accept-Language'
        $locale = $request->header('Accept-Language');

        // Si aucune langue n'est spécifiée, utiliser la langue par défaut
        if (!$locale) {
            $locale = config('app.locale');
        }

        // Vérifier si la langue est supportée
        $supportedLocales = ['en', 'fr'];
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.locale');
        }

        // Définir la langue de l'application
        App::setLocale($locale);

        return $next($request);
    }
}