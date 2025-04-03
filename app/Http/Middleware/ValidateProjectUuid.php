<?php

namespace App\Http\Middleware;

use App\Models\V1\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateProjectUuid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupération de l'UUID depuis la route
        $uuid = $request->route('uuid');

        // Vérifier si un projet avec cet UUID existe
        $project = Project::where('uuid', $uuid)->first();

        if (!$project) {
            return response()->json([
                'message' => 'Unauthorized: Project not found'
            ], 401);
        }

        // Vous pouvez éventuellement attacher le projet à la requête pour y accéder plus tard
        $request->attributes->add(['project' => $project]);

        return $next($request);
    }
}
