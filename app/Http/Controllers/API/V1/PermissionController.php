<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Permission\CreatePermissionRequest;
use App\Http\Requests\V1\Permission\UpdatePermissionRequest;
use App\Http\Resources\V1\Permission\PermissionResource;
use App\Models\V1\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @tags Gestion des permissions
 */
final class PermissionController extends Controller
{
    public function __construct()
    {
        // Les middlewares sont définis dans les routes
    }

    /**
     * Liste toutes les permissions
     *
     * @queryParam search string Recherche par nom ou guard_name
     * @queryParam name string Filtre par nom
     * @queryParam guard_name string Filtre par guard_name
     * @queryParam page int Numéro de page
     * @queryParam per_page int Nombre d'éléments par page
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "view projects",
     *       "guard_name": "web",
     *       "roles": [
     *         {
     *           "id": 1,
     *           "name": "admin",
     *           "guard_name": "web",
     *           "created_at": "2025-04-08 12:00:00",
     *           "updated_at": "2025-04-08 12:00:00"
     *         }
     *       ],
     *       "created_at": "2025-04-08 12:00:00",
     *       "updated_at": "2025-04-08 12:00:00"
     *     }
     *   ],
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "per_page": 15,
     *     "to": 1,
     *     "total": 1
     *   }
     * }
     */
    public function index(): AnonymousResourceCollection
    {
        $permissions = Permission::with('roles')->useFilters()->dynamicPaginate();

        return PermissionResource::collection($permissions);
    }

    /**
     * Crée une nouvelle permission
     *
     * @bodyParam name string required Nom de la permission
     * @bodyParam guard_name string required Nom du guard
     *
     * @response 201 {
     *   "message": "Permission created successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "view projects",
     *     "guard_name": "web",
     *     "roles": [],
     *     "created_at": "2025-04-08 12:00:00",
     *     "updated_at": "2025-04-08 12:00:00"
     *   }
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": [
     *       "Le nom est déjà utilisé."
     *     ]
     *   }
     * }
     */
    public function store(CreatePermissionRequest $request): JsonResponse
    {
        $permission = Permission::create($request->validated());

        return $this->responseCreated('Permission created successfully', new PermissionResource($permission->load('roles')));
    }

    /**
     * Affiche une permission spécifique
     *
     * @urlParam permission int required ID de la permission
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "view projects",
     *     "guard_name": "web",
     *     "roles": [
     *       {
     *         "id": 1,
     *         "name": "admin",
     *         "guard_name": "web",
     *         "created_at": "2025-04-08 12:00:00",
     *         "updated_at": "2025-04-08 12:00:00"
     *       }
     *     ],
     *     "created_at": "2025-04-08 12:00:00",
     *     "updated_at": "2025-04-08 12:00:00"
     *   }
     * }
     *
     * @response 404 {
     *   "message": "Permission not found"
     * }
     */
    public function show(Permission $permission): JsonResponse
    {
        return $this->responseSuccess(null, new PermissionResource($permission->load('roles')));
    }

    /**
     * Met à jour une permission
     *
     * @urlParam permission int required ID de la permission
     * @bodyParam name string Nom de la permission
     * @bodyParam guard_name string Nom du guard
     *
     * @response 200 {
     *   "message": "Permission updated Successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "view projects",
     *     "guard_name": "web",
     *     "roles": [
     *       {
     *         "id": 1,
     *         "name": "admin",
     *         "guard_name": "web",
     *         "created_at": "2025-04-08 12:00:00",
     *         "updated_at": "2025-04-08 12:00:00"
     *       }
     *     ],
     *     "created_at": "2025-04-08 12:00:00",
     *     "updated_at": "2025-04-08 12:00:00"
     *   }
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": [
     *       "Le nom est déjà utilisé."
     *     ]
     *   }
     * }
     *
     * @response 404 {
     *   "message": "Permission not found"
     * }
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission->update($request->validated());

        return $this->responseSuccess('Permission updated Successfully', new PermissionResource($permission->load('roles')));
    }

    /**
     * Supprime une permission
     *
     * @urlParam permission int required ID de la permission
     *
     * @response 200 {
     *   "message": "Permission deleted successfully"
     * }
     *
     * @response 404 {
     *   "message": "Permission not found"
     * }
     */
    public function destroy(Permission $permission): JsonResponse
    {
        $permission->delete();

        return $this->responseDeleted();
    }
}
