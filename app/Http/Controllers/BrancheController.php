<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrancheRequest;
use App\Http\Resources\BrancheResource;
use App\Models\Branche;
use Illuminate\Http\Request;

class BrancheController extends Controller
{
    /**
     * @OA\Get(
     *      path="/branche",
     *      operationId="getBrancheList",
     *      tags={"Branche"},
     *      summary="Get list of Branches",
     *      description="Returns list of Branches",
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
        return  BrancheResource::collection(Branche::all());
    }

    /**
     * @OA\Post (
     *      path="/branche",
     *      operationId="storeBranche",
     *      tags={"Branche"},
     *      summary="Get Branche information",
     *      description="Returns branche data",

     *     @OA\Parameter(
     *          name="name",
     *          description="Branche name",
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
    public function store(BrancheRequest $request): object
    {
        $branche = Branche::create($request->only(['name']));

        return  new BrancheResource($branche);
    }

    /**
     * @OA\Get(
     *      path="/branche/{id}",
     *      operationId="getBrancheById",
     *      tags={"Branche"},
     *      summary="Get Branche information",
     *      description="Returns branche data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Branche id",
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

    public function show(Branche $branche):  object
    {
        if($branche->exists){
            return BrancheResource::make($branche);
        }
        abort(404,'No Data');

    }

    /**
     * @OA\Put  (
     *      path="/branche/{id}",
     *      operationId="updateBranche",
     *      tags={"Branche"},
     *      summary="Update Branche information",
     *      description="Returns branche data",

     *     @OA\Parameter(
     *          name="name",
     *          description="Branche name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=202,
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
    public function update(BrancheRequest $request, Branche $branche): object
    {
        if($branche->exists){
            $branche->update($request->only([ 'name']));
            return (new BrancheResource($branche))->response()->setStatusCode(201);
        }
        abort(404,'no data');
    }


    /**
     * @OA\Delete (
     *      path="/branche/{id}",
     *      operationId="deleteBrancheById",
     *      tags={"Branche"},
     *      summary="delete Branche information",
     *      description="delete branche data",
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
    public function destroy(Branche $branche): object
    {
            if($branche->exists){
                $branche->delete();
                return response()->json([
                    'message' => 'Branche deleted succsfuly'
                ], 200);
            }
            abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/branche/restore/{id}",
     *      operationId="restoreBrancheById",
     *      tags={"Branche"},
     *      summary="restore deleted branche information",
     *      description="restore branche data",
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

    public function RestoreDeletedItemWithId(int $id): mixed
    {
        if(Branche::withTrashed()->find($id)->restore()){
            return back();
        };

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/branche/restore",
     *      operationId="restoreAllBranche",
     *      tags={"Branche"},
     *      summary="restore all deleted branche information",
     *      description="restore all  branche data",
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

        if(Branche::onlyTrashed()->restore()){
            return back();
        }
        return 'No Data To Restore';
    }
}
