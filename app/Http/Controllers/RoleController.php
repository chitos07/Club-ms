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
     *      path="/role",
     *      operationId="getRoleList",
     *      tags={"Role"},
     *      summary="Get list of Role",
     *      description="Returns list of Role",
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

        return RoleResource::collection(Role::all());
    }

    /**
     * @OA\Post (
     *      path="/role",
     *      operationId="storeRole",
     *      tags={"Role"},
     *      summary="Get Role information",
     *      description="Returns Role data",
     *      @OA\Parameter(
     *          name="role",
     *          description="Role role",
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
        $role = Role::create($request->only(['role']));

        return new RoleResource($role);
    }


    /**
     * @OA\Get(
     *      path="/role/{id}",
     *      operationId="getRoleById",
     *      tags={"Role"},
     *      summary="Get Role information",
     *      description="Returns Role data",
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
     *      path="/role/{id}",
     *      operationId="updateRole",
     *      tags={"Role"},
     *      summary="update Role information",
     *      description="update Role data",
     *      @OA\Parameter(
     *          name="role",
     *          description="Role role",
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

        $role->update($request->only(['role']));

        return new RoleResource($role);
    }

    /**
     * @OA\Delete (
     *      path="/role/{id}",
     *      operationId="deleteRoleById",
     *      tags={"Role"},
     *      summary="delete Role information",
     *      description="delete Role data",
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

    public function destroy(role $role): object
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
     *      path="/role/restore/{id}",
     *      operationId="restoreRoleById",
     *      tags={"Role"},
     *      summary="restore deleted Resource information",
     *      description="restore role data",
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
     *      path="/role/restore",
     *      operationId="restoreAllRole",
     *      tags={"Role"},
     *      summary="restore all deleted role information",
     *      description="restore all  role data",
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
