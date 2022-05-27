<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * @OA\Get(
     *      path="/branches",
     *      operationId="getBranchList",
     *      tags={"Branches"},
     *      summary="Get list of Branchs",
     *      description="Returns list of Branchs",
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
        return  BranchResource::collection(Branch::paginate(15));
    }

    /**
     * @OA\Post (
     *      path="/branches",
     *      operationId="storeBranch",
     *      tags={"Branches"},
     *      summary="Get Branch information",
     *      description="Returns branch data",

     *     @OA\Parameter(
     *          name="name",
     *          description="Branch name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          description="Branch phone",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          description="Branch address",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="is_active",
     *          description="Branch is_active",
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
    public function store(BranchRequest $request): object
    {
        $branch = Branch::create($request->only(['name','phone','is_active','address']));

        return  new BranchResource($branch);
    }

    /**
     * @OA\Get(
     *      path="/branches/{id}",
     *      operationId="getBranchById",
     *      tags={"Branches"},
     *      summary="Get Branch information",
     *      description="Returns branch data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Branch id",
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

    public function show(Branch $branch):  object
    {
        if($branch->exists){
            return BranchResource::make($branch);
        }
        abort(404,'No Data');

    }

    /**
     * @OA\Put  (
     *      path="/branches/{id}",
     *      operationId="updateBranch",
     *      tags={"Branches"},
     *      summary="Update Branch information",
     *      description="Returns branch data",

     *     @OA\Parameter(
     *          name="name",
     *          description="Branch name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          description="Branch phone",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="address",
     *          description="Branch address",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="is_active",
     *          description="Branch is_active",
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
    public function update(BranchRequest $request, Branch $branch): object
    {
        if($branch->exists){
            $branch->update($request->only([ 'name','phone','is_active','address']));
            return (new BranchResource($branch))->response()->setStatusCode(201);
        }
        abort(404,'no data');
    }


    /**
     * @OA\Delete (
     *      path="/branches/{id}",
     *      operationId="deleteBranchById",
     *      tags={"Branches"},
     *      summary="delete Branch information",
     *      description="delete branch data",
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
    public function destroy(Branch $branch): object
    {
            if($branch->exists){
                $branch->delete();
                return response()->json([
                    'message' => 'Branch deleted succsfuly'
                ], 200);
            }
            abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/branches/restore/{id}",
     *      operationId="restoreBranchById",
     *      tags={"Branches"},
     *      summary="restore deleted branch information",
     *      description="restore branch data",
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
        if(Branch::withTrashed()->find($id)->restore()){
            return back();
        };

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/branches/restore",
     *      operationId="restoreAllBranch",
     *      tags={"Branches"},
     *      summary="restore all deleted branch information",
     *      description="restore all  branch data",
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

        if(Branch::onlyTrashed()->restore()){
            return back();
        }
        return 'No Data To Restore';
    }
}
