<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\resourcesResource;
use App\Models\Resource;

class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/resources",
     *      operationId="getResourceList",
     *      tags={"Resources"},
     *      summary="Get list of Resources",
     *      description="Returns list of Resources",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *     )
     */
    public function index(): object
    {
        return resourcesResource::collection(Resource::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/resources",
     *      operationId="storeResource",
     *      tags={"Resources"},
     *      summary="Get Resources information",
     *      description="Resources Resource data",
     *      @OA\Parameter(
     *          name="branch_id",
     *          description="Resource branch_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Resource name",
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

    public function store(StoreResourceRequest $request): object
    {
        $resources = Resource::create($request->only(['branch_id','name']));
        return new resourcesResource($resources);
    }

    /**
     * @OA\Get(
     *      path="/resources/{id}",
     *      operationId="getResourceById",
     *      tags={"Resources"},
     *      summary="Get Resources information",
     *      description="Returns Resources data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Resource id",
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

    public function show(Resource $resources): object
    {
        if($resources->exists){
            return resourcesResource::make($resources->load('branch'));
        }
        abort(404,'no data');
    }

    /**
     * @OA\Put  (
     *      path="/resources/{id}",
     *      operationId="updateResource",
     *      tags={"Resources"},
     *      summary="update Resources information",
     *      description="update Resources data",
     *      @OA\Parameter(
     *          name="branch_id",
     *          description="Resource branch_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Resource name",
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
    public function update(UpdateResourceRequest $request, Resource $resources): object
    {
        if($resources->exists){
            $resources->update($request->only(['branch_id', 'name']));
            return new resourcesResource($resources);
        }
        abort(404,'error');
    }

    /**
     * @OA\Delete (
     *      path="/resources/{id}",
     *      operationId="deleteResourceById",
     *      tags={"Resources"},
     *      summary="delete Resources information",
     *      description="delete Resources data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Project id",
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

    public function destroy(Resource $resources): object
    {
             if ($resources->delete()) {
                    return response()->json([
                       'message' => 'Resource deleted succsfuly'
                    ], 200);
               }
                abort(404, 'error');
    }

    /**
     * @OA\Get(
     *      path="/resources/restore/{id}",
     *      operationId="restoreResourceById",
     *      tags={"Resources"},
     *      summary="restore deleted Resources information",
     *      description="restore Resources data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Resource id",
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
        if(Resource::withTrashed()->find($id)->restore()){
            return back();
        };

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/resources/restore",
     *      operationId="restoreAllResource",
     *      tags={"Resources"},
     *      summary="restore all deleted Resources information",
     *      description="restore all  Resources data",
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

    public function RestoreAll()
    {

        if(Resource::onlyTrashed()->restore()){
            return back();
        }
        return 'No Data To Restore';
    }
}
