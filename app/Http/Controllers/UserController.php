<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getUserList",
     *      tags={"Users"},
     *      summary="Get list of Users",
     *      description="Returns list of Users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *     )
     */
    public function index(): object
    {
        return UserResource::collection(User::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/users",
     *      operationId="storeUser",
     *      tags={"Users"},
     *      summary="Store Users information",
     *      description="Returns Users data",
     *      @OA\Parameter(
     *          name="name",
     *          description="User name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="email"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string/integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="job_title",
     *          description="User job_title",
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

    public function store(RegisterRequest $request): object
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'job_title' => $request->input('job_title'),
          ]);

        $user->roles()->attach($request->role);

        return new UserResource($user);
    }

    /**
     * @OA\Get(
     *      path="/users/{id}",
     *      operationId="getUserById",
     *      tags={"Users"},
     *      summary="Get Users information",
     *      description="Returns Users data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
    public function show(User $user): object
    {
        return UserResource::make($user->load('roles'));
    }

    /**
     * @OA\Put  (
     *      path="/users/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update Users information",
     *      description="Returns Users data",
     *      @OA\Parameter(
     *          name="name",
     *          description="User name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="email"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="User password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string/integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="job_title",
     *          description="User job_title",
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
    public function update(UserUpdateRequest $request, User $user): object
    {

        $user->update([
            'name' => $request->name,
            //'email' => $request->email,
            'password' => Hash::make($request->password),
            'job_title' => $request->input('job_title'),
        ]);

          $user->roles()->sync($request->role);

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * @OA\Delete (
     *      path="/users/{id}",
     *      operationId="DeleteUserById",
     *      tags={"Users"},
     *      summary="Delete Users information",
     *      description="Delete Users data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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

    public function destroy(User $user): object
    {
        if($user->exists){
            if($user->delete()){
                return response()->json([
                    'message' => 'users deleted succsfuly'
                ],200);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/users/restore/{id}",
     *      operationId="restoreUserById",
     *      tags={"Users"},
     *      summary="restore deleted Users information",
     *      description="restore Users data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
        if (User::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/users/restore",
     *      operationId="restoreAllUser",
     *      tags={"Users"},
     *      summary="restore all deleted Users information",
     *      description="restore all  Users data",
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

        if (User::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}


