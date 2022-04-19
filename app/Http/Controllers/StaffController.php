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
     *      path="/staff",
     *      operationId="getStaffList",
     *      tags={"Staff"},
     *      summary="Get list of Staff",
     *      description="Returns list of Staff",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *     )
     */
    public function index(): object
    {
        return StaffResource::collection(Staff::all());
    }

    /**
     * @OA\Post (
     *      path="/staff",
     *      operationId="storeStaff",
     *      tags={"Staff"},
     *      summary="Store Staff information",
     *      description="Returns Staff data",
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
     *          name="branche_id",
     *          description="Staff branche_id",
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
        $staff = Staff::create($request->only(['user_id','startDate','branche_id','role']));
        return new StaffResource($staff);
    }
    /**
     * @OA\Get(
     *      path="/staff/{id}",
     *      operationId="getStaffById",
     *      tags={"Staff"},
     *      summary="Get Staff information",
     *      description="Returns Staff data",
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
        return StaffResource::make($staff->load('branche','user'));
    }

    /**
     * @OA\Put  (
     *      path="/staff/{id}",
     *      operationId="updateStaff",
     *      tags={"Staff"},
     *      summary="Update Staff information",
     *      description="Returns Staff data",
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
     *          name="branche_id",
     *          description="Staff branche_id",
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
            $staff->update($request->only(['user_id','startDate','branche_id','role']));
            return new StaffResource($staff);
        }
        abort(404,'error');
    }

    /**
     * @OA\Delete (
     *      path="/staff/{id}",
     *      operationId="deleteStaffById",
     *      tags={"Staff"},
     *      summary="delete Staff information",
     *      description="delete Staff data",
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
     *      path="/staff/restore/{id}",
     *      operationId="restoreStaffById",
     *      tags={"Staff"},
     *      summary="restore deleted staff information",
     *      description="restore staff data",
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
     *      path="/staff/restore",
     *      operationId="restoreAllStaff",
     *      tags={"Staff"},
     *      summary="restore all deleted staff information",
     *      description="restore all  staff data",
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
