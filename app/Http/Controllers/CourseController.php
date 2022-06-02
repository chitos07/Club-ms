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
     *      path="/courses",
     *      operationId="getCourse",
     *      tags={"Courses"},
     *      summary="Get list of Courses",
     *      description="Returns list of Courses",
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
        return CourseResource::collection(Course::paginate(10));
    }


    /**
     * @OA\Post (
     *      path="/courses",
     *      operationId="storeCourse",
     *      tags={"Courses"},
     *      summary="store Courses information",
     *      description="store Courses  data",
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
     *      path="/courses/{id}",
     *      operationId="getCourseById",
     *      tags={"Courses"},
     *      summary="Get Courses information",
     *      description="Returns Courses data",
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
     *      path="/courses/{id}",
     *      operationId="updateCourse",
     *      tags={"Courses"},
     *      summary="update Courses information",
     *      description="update Courses  data",
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
     *      path="/courses/{id}",
     *      operationId="deleteCourseById",
     *      tags={"Courses"},
     *      summary="delete Courses information",
     *      description="delete Courses data",
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
     *      path="/courses/restore/{id}",
     *      operationId="restoreCourse",
     *      tags={"Courses"},
     *      summary="restore deleted Courses information",
     *      description="restore Courses data",
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
     *      path="/courses/restore",
     *      operationId="restoreAllCourse",
     *      tags={"Courses"},
     *      summary="restore all deleted Courses information",
     *      description="restore all  Courses data",
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
