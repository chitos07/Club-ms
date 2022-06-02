<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;


class RoleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/roles",
     *      operationId="getRoleList",
     *      tags={"Roles"},
     *      summary="Get list of Roles",
     *      description="Returns list of Roles",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index(): object
    {

        return RoleResource::collection(Role::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/roles",
     *      operationId="storeRole",
     *      tags={"Roles"},
     *      summary="Get Roles information",
     *      description="Returns Roles data",
     *      @OA\Parameter(
     *          name="roles",
     *          description="Role roles",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */
    public function store(StoreroleRequest $request): object
    {
        $role = Role::create($request->only(['roles']));

        return new RoleResource($role);
    }


    /**
     * @OA\Get(
     *      path="/roles/{id}",
     *      operationId="getRoleById",
     *      tags={"Roles"},
     *      summary="Get Roles information",
     *      description="Returns Roles data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */

    public function show(Role $role): object
    {
        return RoleResource::make($role);
    }

    /**
     * @OA\Post (
     *      path="/roles/{id}",
     *      operationId="updateRole",
     *      tags={"Roles"},
     *      summary="update Roles information",
     *      description="update Roles data",
     *      @OA\Parameter(
     *          name="roles",
     *          description="Role roles",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */
    public function update(UpdateroleRequest $request, Role $role): object
    {

        $role->update($request->only(['roles']));

        return new RoleResource($role);
    }

    /**
     * @OA\Delete (
     *      path="/roles/{id}",
     *      operationId="deleteRoleById",
     *      tags={"Roles"},
     *      summary="delete Roles information",
     *      description="delete Roles data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */

    public function destroy(roles $role): object
    {
        if ($role->exists) {
            if ($role->delete()) {
                return response()->json(['message' => 'Record deleted'], 200);

            }
        }
        abort(404, 'error');

    }

    /**
     * @OA\Get(
     *      path="/roles/restore/{id}",
     *      operationId="restoreRoleById",
     *      tags={"Roles"},
     *      summary="restore deleted Roles information",
     *      description="restore roles data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Role id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */

    public function RestoreDeletedItemWithId(int $id): mixed
    {
        if (Role::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/roles/restore",
     *      operationId="restoreAllRole",
     *      tags={"Roles"},
     *      summary="restore all deleted Roles information",
     *      description="restore all  Roles data",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */


    public function RestoreAll(): mixed
    {

        if (Role::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
