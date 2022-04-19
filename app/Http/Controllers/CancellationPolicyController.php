<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCancellationPolicyRequest;
use App\Http\Requests\UpdateCancellationPolicyRequest;
use App\Http\Resources\CancellationPolicyResource;
use App\Models\CancellationPolicy;

class CancellationPolicyController extends Controller
{
    /**
     * @OA\Get(
     *      path="/cancellationpolicy",
     *      operationId="getCancellationPolicyList",
     *      tags={"CancellationPolicy"},
     *      summary="Get list of CancellationPolicy",
     *      description="Returns list of CancellationPolicy",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *
     *
     *     )
     */
    public function index(): object
    {
        return CancellationPolicyResource::collection(CancellationPolicy::all());

    }

    /**
     * @OA\Post (
     *      path="/cancellationpolicy",
     *      operationId="storeCancellationPolicy",
     *      tags={"CancellationPolicy"},
     *      summary="Get CancellationPolicy information",
     *      description="CancellationPolicy branche data",
     *     @OA\Parameter(
     *          name="title",
     *          description="CancellationPolicy title",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="policy",
     *          description="CancellationPolicy policy",
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

    public function store(StoreCancellationPolicyRequest $request): object
    {
        $cancellationPolicy = CancellationPolicy::create($request->only(['title','policy']));

        return new CancellationPolicyResource($cancellationPolicy);
    }

    /**
     * @OA\Get(
     *      path="/cancellationpolicy/{id}",
     *      operationId="getCancellationPolicyById",
     *      tags={"CancellationPolicy"},
     *      summary="Get CancellationPolicy information",
     *      description="Returns CancellationPolicy data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CancellationPolicy id",
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
    public function show(CancellationPolicy $cancellationPolicy): object
    {
        return CancellationPolicyResource::make($cancellationPolicy);
    }

    /**
     * @OA\Put  (
     *      path="/cancellationpolicy/{id}",
     *      operationId="updateCancellationPolicy",
     *      tags={"CancellationPolicy"},
     *      summary="Get CancellationPolicy information",
     *      description="update CancellationPolicy data",
     *     @OA\Parameter(
     *          name="title",
     *          description="CancellationPolicy title",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="policy",
     *          description="CancellationPolicy policy",
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
    public function update(UpdateCancellationPolicyRequest $request, CancellationPolicy $cancellationPolicy): object
    {
        $cancellationPolicy->update($request->only(['title','policy']));
        return new CancellationPolicyResource($cancellationPolicy);
    }

    /**
     * @OA\Delete (
     *      path="/cancellationpolicy/{id}",
     *      operationId="deleteCancellationPolicyById",
     *      tags={"CancellationPolicy"},
     *      summary="delete CancellationPolicy information",
     *      description="delete CancellationPolicy data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CancellationPolicy id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
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

    public function destroy(CancellationPolicy $cancellationPolicy): object
    {
        if($cancellationPolicy->exists){
            if($cancellationPolicy->delete()){
                return response()->json(['message' => 'record deleted',],200);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/cancellationpolicy/restore/{id}",
     *      operationId="restoreCancellationPolicyById",
     *      tags={"CancellationPolicy"},
     *      summary="restore deleted CancellationPolicy information",
     *      description="restore CancellationPolicy data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CancellationPolicy id",
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
        if (CancellationPolicy::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/cancellationpolicy/restore",
     *      operationId="restoreAllCancellationPolicy",
     *      tags={"CancellationPolicy"},
     *      summary="restore all deleted CancellationPolicy information",
     *      description="restore all  CancellationPolicy data",
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

        if (CancellationPolicy::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
