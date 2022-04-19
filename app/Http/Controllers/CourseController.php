<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * @OA\Get(
     *      path="/course",
     *      operationId="getCourse",
     *      tags={"Course"},
     *      summary="Get list of Course",
     *      description="Returns list of Course",
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
        return CourseResource::collection(Course::all());
    }


    /**
     * @OA\Post (
     *      path="/course",
     *      operationId="storeCourse",
     *      tags={"Course"},
     *      summary="store Course information",
     *      description="store Course  data",
     *     @OA\Parameter(
     *          name="course_template_id",
     *          description="Course course_template_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="staff_id",
     *          description="Course staff_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="startDate",
     *          description="Course startDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="endDate",
     *          description="Course endDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="maxNumber",
     *          description="Course MaxNumber",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="startTime",
     *          description="Course name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="duration",
     *          description="Course Duration",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="weekDay",
     *          description="Course WeekLds",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="weekLds",
     *          description="Course WeekLds",
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

    public function store(StoreCourseRequest $request): object
    {
        $course = Course::create($request->only(['course_template_id','staff_id','startDate','endDate','maxNumber']));

        if($course->id){
            $course->session()->create([
                'startTime' => $request->startTime,
                'duration' =>  $request->duration,
                'weekDay' => $request->weekDay,
                'weekLds' => $request->weekLds
            ]);
        } else{
            abort(404,'error in saving session');
        }

        return new CourseResource($course);

    }

    /**
     * @OA\Get(
     *      path="/course/{id}",
     *      operationId="getCourseById",
     *      tags={"Course"},
     *      summary="Get Course information",
     *      description="Returns Course data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
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

    public function show(Course $course): object
    {
        if($course->exists)
        {
            return CourseResource::make($course)->load('staff','session','course_template');
        }
        abort(404,'error');
    }

    /**
     * @OA\Put  (
     *      path="/course/{id}",
     *      operationId="updateCourse",
     *      tags={"Course"},
     *      summary="update Course information",
     *      description="update Course  data",
     *     @OA\Parameter(
     *          name="course_template_id",
     *          description="Course course_template_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="staff_id",
     *          description="Course staff_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="startDate",
     *          description="Course StartDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="endDate",
     *          description="Course EndDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="date"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="maxNumber",
     *          description="Course MaxNumber",
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

    public function update(UpdateCourseRequest $request, Course $course): object
    {
        if($course->exists)
        {
            $course->update($request->only(['course_template_id', 'staff_id', 'startDate', 'endDate', 'maxNumber']));
            return new CourseResource($course);
        }
        abort(404,'error');
    }


    /**
     * @OA\Delete (
     *      path="/course/{id}",
     *      operationId="deleteCourseById",
     *      tags={"Course"},
     *      summary="delete Course information",
     *      description="delete Course data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
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

    public function destroy(Course $course): object
    {
        if ($course->exists){
            if($course->session()->exists()){
                $course->session()->delete();
            }
            if($course->delete()){
                return response()->json([
                    'message' => 'Record deletd',], 200);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/course/restore/{id}",
     *      operationId="restoreCourse",
     *      tags={"Course"},
     *      summary="restore deleted Course information",
     *      description="restore Course data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
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
        if (Course::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/course/restore",
     *      operationId="restoreAllCourse",
     *      tags={"Course"},
     *      summary="restore all deleted Course information",
     *      description="restore all  Course data",
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

        if (Course::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
