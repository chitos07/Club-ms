<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseCategoryRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Http\Resources\CourseCatResource;
use App\Models\CourseCategory;
use Illuminate\Http\Response;

class CourseCategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/coursecategory",
     *      operationId="getCourseCategory",
     *      tags={"CourseCategory"},
     *      summary="Get list of CourseCategory",
     *      description="Returns list of CourseCategory",
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
        return CourseCatResource::collection(CourseCategory::all());
    }

    /**
     * @OA\Post (
     *      path="/coursecategory",
     *      operationId="storeCourseCategory",
     *      tags={"CourseCategory"},
     *      summary="store CourseCategory information",
     *      description="store CourseCategory  data",
     *     @OA\Parameter(
     *          name="name",
     *          description="CourseCategory name",
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
    public function store(StoreCourseCategoryRequest $request): object
    {
        $courseCategory = CourseCategory::create($request->only(['name']));

        return new CourseCatResource($courseCategory);
    }

    /**
     * @OA\Get(
     *      path="/coursecategory/{id}",
     *      operationId="getCourseCategoryById",
     *      tags={"CourseCategory"},
     *      summary="Get CourseCategory information",
     *      description="Returns CourseCategory data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseCategory id",
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

    public function show(CourseCategory $courseCategory): object
    {
        if ($courseCategory->exists) {
            return CourseCatResource::make($courseCategory);
        }
        abort(404, 'No data');
    }

    /**
     * @OA\Put  (
     *      path="/coursecategory/{id}",
     *      operationId="updateCourseCategory",
     *      tags={"CourseCategory"},
     *      summary="update CourseCategory information",
     *      description="update CourseCategory  data",
     *     @OA\Parameter(
     *          name="name",
     *          description="CourseCategory name",
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
    public function update(UpdateCourseCategoryRequest $request, CourseCategory $courseCategory): object
    {
        $courseCategory->update($request->only(['name']));

        return new CourseCatResource($courseCategory);
    }

    /**
     * @OA\Delete (
     *      path="/coursecategory/{id}",
     *      operationId="deleteCourseCategoryById",
     *      tags={"CourseCategory"},
     *      summary="delete CourseCategory information",
     *      description="delete CourseCategory data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CourseCategory id",
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
    public function destroy(CourseCategory $courseCategory): object
    {
        if ($courseCategory->exists) {
            $courseCategory->delete();
            return response()->json(['message' => 'Course Category deleted succsfuly'], 200);
        }
        abort(404, 'error');
    }

    /**
     * @OA\Get(
     *      path="/coursecategory/restore/{id}",
     *      operationId="restoreCourseCategory",
     *      tags={"CourseCategory"},
     *      summary="restore deleted CourseCategory information",
     *      description="restore CourseCategory data",
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
        if (CourseCategory::withTrashed()->find($id)->restore()) {
            return back();
        }

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/coursecategory/restore",
     *      operationId="restoreAllCourseCategory",
     *      tags={"CourseCategory"},
     *      summary="restore all deleted CourseCategory information",
     *      description="restore all  CourseCategory data",
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

        if (CourseCategory::onlyTrashed()->restore()) {
            return back();
        }
        return 'No Data To Restore';
    }
}
