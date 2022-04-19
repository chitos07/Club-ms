<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\resourceResource;
use App\Models\Resource;

class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *      path="/resource",
     *      operationId="getResourceList",
     *      tags={"Resource"},
     *      summary="Get list of Resource",
     *      description="Returns list of Resource",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *     )
     */
    public function index(): object
    {
        return resourceResource::collection(Resource::all());
    }

    /**
     * @OA\Post (
     *      path="/resource",
     *      operationId="storeResource",
     *      tags={"Resource"},
     *      summary="Get Resource information",
     *      description="Returns Resource data",
     *      @OA\Parameter(
     *          name="branche_id",
     *          description="Resource branche_id",
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
        $resource = Resource::create($request->only(['branche_id','name']));
        return new resourceResource($resource);
    }

    /**
     * @OA\Get(
     *      path="/resource/{id}",
     *      operationId="getResourceById",
     *      tags={"Resource"},
     *      summary="Get resource information",
     *      description="Returns resource data",
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

    public function show(Resource $resource): object
    {
        if($resource->exists){
            return resourceResource::make($resource->load('branche'));
        }
        abort(404,'no data');
    }

    /**
     * @OA\Put  (
     *      path="/resource/{id}",
     *      operationId="updateResource",
     *      tags={"Resource"},
     *      summary="update Resource information",
     *      description="update Resource data",
     *      @OA\Parameter(
     *          name="branche_id",
     *          description="Resource branche_id",
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
    public function update(UpdateResourceRequest $request, Resource $resource): object
    {
        if($resource->exists){
            $resource->update($request->only(['branche_id', 'name']));
            return new resourceResource($resource);
        }
        abort(404,'error');
    }

    /**
     * @OA\Delete (
     *      path="/resource/{id}",
     *      operationId="deleteResourceById",
     *      tags={"Resource"},
     *      summary="delete resource information",
     *      description="delete resource data",
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

    public function destroy(Resource $resource): object
    {
             if ($resource->delete()) {
                    return response()->json([
                       'message' => 'Resource deleted succsfuly'
                    ], 200);
               }
                abort(404, 'error');
    }

    /**
     * @OA\Get(
     *      path="/resource/restore/{id}",
     *      operationId="restoreResourceById",
     *      tags={"Resource"},
     *      summary="restore deleted Resource information",
     *      description="restore Resource data",
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
     *      path="/resource/restore",
     *      operationId="restoreAllResource",
     *      tags={"Resource"},
     *      summary="restore all deleted resource information",
     *      description="restore all  resource data",
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
