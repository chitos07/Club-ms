<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseElementRequest;
use App\Http\Requests\UpdateCourseElementRequest;
use App\Http\Resources\CourseElementResource;
use App\Models\CourseElement;
use Illuminate\Http\Response;

class CourseElementController extends Controller
{
    /**
     * @OA\Get(
     *      path="/courseelements",
     *      operationId="getCourseElement",
     *      tags={"CourseElements"},
     *      summary="Get list of CourseElements",
     *      description="Returns list of CourseElements",
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
        return CourseElementResource::collection(CourseElement::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/courseelements",
     *      operationId="storeCourseElement",
     *      tags={"CourseElements"},
     *      summary="store CourseElements information",
     *      description="store CourseElements  data",
     *     @OA\Parameter(
     *          name="course_template_id",
     *          description="CourseElement course_template_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="name",
     *          description="CourseElement name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="price",
     *          description="CourseElement StartDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="applyTax",
     *          description="CourseElement EndDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
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

    public function store(StoreCourseElementRequest $request): object
    {
        $courseElement = CourseElement::create($request->only(['name', 'course_template_id', 'price', 'applyTax']));
        return new CourseElementResource($courseElement);
    }

    /**
     * @OA\Get(
     *      path="/courseelements/{id}",
     *      operationId="getCourseElementById",
     *      tags={"CourseElements"},
     *      summary="Get CourseElements information",
     *      description="Returns CourseElements data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseElement id",
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

    public function show(CourseElement $courseElement): object
    {
        return CourseElementResource::make($courseElement->load(['course_template']));
    }

    /**
     * @OA\Put  (
     *      path="/courseelements/{id}",
     *      operationId="updateCourseElement",
     *      tags={"CourseElements"},
     *      summary="update CourseElements information",
     *      description="update CourseElements  data",
     *     @OA\Parameter(
     *          name="course_template_id",
     *          description="CourseElement course_template_id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="name",
     *          description="CourseElement name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *       @OA\Parameter(
     *          name="price",
     *          description="CourseElement StartDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *        @OA\Parameter(
     *          name="applyTax",
     *          description="CourseElement EndDate",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
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


    public function update(UpdateCourseElementRequest $request, CourseElement $courseElement): object
    {
        $courseElement->update($request->only(['name', 'course_template_id', 'price', 'applyTax']));
        return new CourseElementResource($courseElement);
    }

    /**
     * @OA\Delete (
     *      path="/courseelements/{id}",
     *      operationId="deleteCourseElementById",
     *      tags={"CourseElements"},
     *      summary="Delete CourseElements information",
     *      description="Delete CourseElements data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseElement id",
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

    public function destroy(CourseElement $courseElement): object
    {
        if ($courseElement->exists) {
            if ($courseElement->delete()) {
                return response()->json(['message' => 'Record deleted'], 200);

            }
        }
        abort(404, 'error');
    }

    /**
     * @OA\Get  (
     *      path="/courseelements/restore/{id}",
     *      operationId="restoreCourseElementById",
     *      tags={"CourseElements"},
     *      summary="Restore deleted CourseElements information",
     *      description="Restore deleted CourseElements data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseElement id",
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
        if (CourseElement::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/courseelements/restore",
     *      operationId="restoreAllCourseElement",
     *      tags={"CourseElements"},
     *      summary="restore all deleted CourseElements information",
     *      description="restore all  CourseElements data",
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

        if (CourseElement::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
