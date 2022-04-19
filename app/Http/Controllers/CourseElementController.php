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
     *      path="/courseelement",
     *      operationId="getCourseElement",
     *      tags={"CourseElement"},
     *      summary="Get list of CourseElement",
     *      description="Returns list of CourseElement",
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
        return CourseElementResource::collection(CourseElement::all());
    }

    /**
     * @OA\Post (
     *      path="/courseelement",
     *      operationId="storeCourseElement",
     *      tags={"CourseElement"},
     *      summary="store CourseElement information",
     *      description="store CourseElement  data",
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
     *      path="/courseelement/{id}",
     *      operationId="getCourseElementById",
     *      tags={"CourseElement"},
     *      summary="Get CourseElement information",
     *      description="Returns CourseElement data",
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
     *      path="/courseelement/{id}",
     *      operationId="updateCourseElement",
     *      tags={"CourseElement"},
     *      summary="update CourseElement information",
     *      description="update CourseElement  data",
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
     *      path="/courseelement/{id}",
     *      operationId="deleteCourseElementById",
     *      tags={"CourseElement"},
     *      summary="Delete CourseElement information",
     *      description="Delete CourseElement data",
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
     *      path="/courseelement/restore/{id}",
     *      operationId="restoreCourseElementById",
     *      tags={"CourseElement"},
     *      summary="Restore deleted CourseElement information",
     *      description="Restore deleted CourseElement data",
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
     *      path="/courseelement/restore",
     *      operationId="restoreAllCourseElement",
     *      tags={"CourseElement"},
     *      summary="restore all deleted CourseElement information",
     *      description="restore all  CourseElement data",
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
