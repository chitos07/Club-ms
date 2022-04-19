<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseTemplateRequest;
use App\Http\Requests\UpdateCourseTemplateRequest;
use App\Http\Resources\CourseTemplateResource;
use App\Models\CourseTemplate;

class CourseTemplateController extends Controller
{
    /**
     * @OA\Get(
     *      path="/coursetemplate",
     *      operationId="getCourseTemplate",
     *      tags={"CourseTemplate"},
     *      summary="Get list of CourseTemplate",
     *      description="Returns list of CourseTemplate",
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
        return CourseTemplateResource::collection(CourseTemplate::latest()->get());
    }

    /**
     * @OA\Post (
     *      path="/coursetemplate",
     *      operationId="storeCourseTemplate",
     *      tags={"CourseTemplate"},
     *      summary="store CourseTemplate information",
     *      description="store CourseTemplate  data",
     *     @OA\Parameter(
     *          name="branche_id",
     *          description="CourseTemplate branche_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="course_category_id",
     *          description="CourseTemplate course_category_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="cancellation_policy_id",
     *          description="CourseTemplate cancellation_policy_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="name",
     *          description="CourseTemplate name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="note",
     *          description="CourseTemplate note",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="calendarColor",
     *          description="CourseTemplate calendarColor",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="enabled",
     *          description="CourseTemplate enabled",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="requirements",
     *          description="CourseTemplate Requirements",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="slotDuration",
     *          description="CourseTemplate slotDuration",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="clientCanCancel",
     *          description="CourseTemplate clientCanCancel",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="courseType",
     *          description="CourseTemplate CourseType",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
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


    public function store(StoreCourseTemplateRequest $request): object
    {
        $course = CourseTemplate::create($request->only([
            'branche_id',
            'course_category_id',
            'cancellation_policy_id',
            'name',
            'note',
            'calendarColor',
            'enabled',
            'requirements',
            'slotDuration',
            'clientCanCancel',
            'courseType',
        ]));
        return new CourseTemplateResource($course);
    }

    /**
     * @OA\Get(
     *      path="/coursetemplate/{id}",
     *      operationId="getCourseTemplateById",
     *      tags={"CourseTemplate"},
     *      summary="Get CourseTemplate information",
     *      description="Returns CourseTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseTemplate id",
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

    public function show(CourseTemplate $courseTemplate): object
    {

        return CourseTemplateResource::make($courseTemplate->load(['branche','course_category','cancellation_policy']));
    }

    /**
     * @OA\Put  (
     *      path="/coursetemplate/{id}",
     *      operationId="updateCourseTemplate",
     *      tags={"CourseTemplate"},
     *      summary="update CourseTemplate information",
     *      description="update CourseTemplate  data",
     *     @OA\Parameter(
     *          name="branche_id",
     *          description="CourseTemplate branche_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="course_category_id",
     *          description="CourseTemplate course_category_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="cancellation_policy_id",
     *          description="CourseTemplate cancellation_policy_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="name",
     *          description="CourseTemplate name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="note",
     *          description="CourseTemplate note",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="calendarColor",
     *          description="CourseTemplate calendarColor",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="enabled",
     *          description="CourseTemplate enabled",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="requirements",
     *          description="CourseTemplate Requirements",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="slotDuration",
     *          description="CourseTemplate slotDuration",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="clientCanCancel",
     *          description="CourseTemplate clientCanCancel",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="courseType",
     *          description="CourseTemplate CourseType",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
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

    public function update(UpdateCourseTemplateRequest $request, CourseTemplate $courseTemplate): object
    {
        $courseTemplate->update($request->only([
            'branche_id',
            'course_category_id',
            'cancellation_policy_id',
            'name',
            'note',
            'calendarColor',
            'enabled',
            'requirements',
            'slotDuration',
            'clientCanCancel',
            'courseType',
        ]));
        return new CourseTemplateResource($courseTemplate);
    }

    /**
     * @OA\Delete (
     *      path="/coursetemplate/{id}",
     *      operationId="deleteCourseTemplateById",
     *      tags={"CourseTemplate"},
     *      summary="Delete CourseTemplate information",
     *      description="Delete CourseTemplate data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseTemplate id",
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

    public function destroy(CourseTemplate $courseTemplate): object
    {
        if($courseTemplate->exists){
            if($courseTemplate->delete()){
                return response()->json(['message' => 'Record deleted'], 200);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/coursetemplate/restore/{id}",
     *      operationId="restoreAllCourseTemplateById",
     *      tags={"CourseTemplate"},
     *      summary="restore all deleted CourseTemplate information",
     *      description="restore all deleted CourseTemplate data",
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
        if (CourseTemplate::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/coursetemplate/restore",
     *      operationId="restoreAllCourseTemplate",
     *      tags={"CourseTemplate"},
     *      summary="restore all deleted CourseTemplate information",
     *      description="restore all  CourseTemplate data",
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


    public function RestoreAll():  mixed
    {

        if (CourseTemplate::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
