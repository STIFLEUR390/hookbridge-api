<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Role\CreateRoleRequest;
use App\Http\Requests\V1\Role\UpdateRoleRequest;
use App\Http\Resources\V1\Role\RoleResource;
use App\Models\V1\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @tags Gestion des rôles
 */
final class RoleController extends Controller
{
    public function __construct()
    {
        // Les middlewares sont définis dans les routes
    }

    /**
     * Liste tous les rôles
     *
     * @queryParam search string Recherche par nom ou guard_name
     * @queryParam name string Filtre par nom
     * @queryParam guard_name string Filtre par guard_name
     * @queryParam page int Numéro de page
     * @queryParam per_page int Nombre d'éléments par page
     *
     * @return AnonymousResourceCollection<LengthAwarePaginator<RoleResource>>
     */
    public function index(): AnonymousResourceCollection
    {
        $roles = Role::with('permissions')->useFilters()->dynamicPaginate();

        return RoleResource::collection($roles);
    }

    /**
     * Crée un nouveau rôle
     *
     * @bodyParam name string required Nom du rôle
     * @bodyParam guard_name string required Nom du guard
     * @bodyParam permissions array Liste des IDs des permissions à attribuer
     * @bodyParam permissions.* int ID de la permission
     *
     * @response array{status: int, message: string, data: RoleResource}
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        $role = Role::create($request->validated());

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return $this->responseCreated('Role created successfully', new RoleResource($role->load('permissions')));
    }

    /**
     * Affiche un rôle spécifique
     *
     * @urlParam role int required ID du rôle
     *
     * @response array{status: int, message: string, data: RoleResource}
     */
    public function show(Role $role): JsonResponse
    {
        return $this->responseSuccess(null, new RoleResource($role->load('permissions')));
    }

    /**
     * Met à jour un rôle
     *
     * @urlParam role int required ID du rôle
     * @bodyParam name string Nom du rôle
     * @bodyParam guard_name string Nom du guard
     * @bodyParam permissions array Liste des IDs des permissions à attribuer
     * @bodyParam permissions.* int ID de la permission
     *
     * @response array{status: int, message: string, data: RoleResource}
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->validated());

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return $this->responseSuccess('Role updated Successfully', new RoleResource($role->load('permissions')));
    }

    /**
     * Supprime un rôle
     *
     * @urlParam role int required ID du rôle
     *
     * @response void
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return $this->responseDeleted();
    }
}