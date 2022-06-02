<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Http\Resources\StaffResource;
use App\Models\Staff;

class StaffController extends Controller
{
    /**
     * @OA\Get(
     *      path="/staffs",
     *      operationId="getStaffList",
     *      tags={"Staffs"},
     *      summary="Get list of Staffs",
     *      description="Returns list of Staffs",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *     )
     */
    public function index(): object
    {
        return StaffResource::collection(Staff::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/staffs",
     *      operationId="storeStaff",
     *      tags={"Staffs"},
     *      summary="Store Staffs information",
     *      description="Returns Staffs data",
     *      @OA\Parameter(
     *          name="user_id",
     *          description="Staff user_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="startDate",
     *          description="Staff startDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="branch_id",
     *          description="Staff branch_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="role",
     *          description="Staff role",
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

    public function store(StoreStaffRequest $request): object
    {
        $staff = Staff::create($request->only(['user_id','startDate','branch_id','role']));
        return new StaffResource($staff);
    }
    /**
     * @OA\Get(
     *      path="/staffs/{id}",
     *      operationId="getStaffById",
     *      tags={"Staffs"},
     *      summary="Get Staffs information",
     *      description="Returns Staffs data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Staff id",
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

    public function show(Staff $staff): object
    {
        return StaffResource::make($staff->load('branch','user'));
    }

    /**
     * @OA\Put  (
     *      path="/staffs/{id}",
     *      operationId="updateStaff",
     *      tags={"Staffs"},
     *      summary="Update Staffs information",
     *      description="Returns Staffs data",
     *      @OA\Parameter(
     *          name="user_id",
     *          description="Staff user_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="startDate",
     *          description="Staff StartDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="branch_id",
     *          description="Staff branch_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="role",
     *          description="Staff role",
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
    public function update(UpdateStaffRequest $request, Staff $staff): object
    {
        if($staff->exists){
            $staff->update($request->only(['user_id','startDate','branch_id','role']));
            return new StaffResource($staff);
        }
        abort(404,'error');
    }

    /**
     * @OA\Delete (
     *      path="/staffs/{id}",
     *      operationId="deleteStaffById",
     *      tags={"Staffs"},
     *      summary="delete Staffs information",
     *      description="delete Staffs data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Staff id",
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

    public function destroy(Staff $staff): object
    {
        if($staff->exists){
            if($staff->delete()){
                return response()->json(['message' => 'Record deleted','status' => true], 200);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/staffs/restore/{id}",
     *      operationId="restoreStaffById",
     *      tags={"Staffs"},
     *      summary="restore deleted Staffs information",
     *      description="restore Staffs data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Staff id",
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
        if (Staff::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/staffs/restore",
     *      operationId="restoreAllStaff",
     *      tags={"Staffs"},
     *      summary="restore all deleted Staffs information",
     *      description="restore all  Staffs data",
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

        if (Staff::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
