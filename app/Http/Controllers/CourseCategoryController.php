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
     *      path="/coursecategories",
     *      operationId="getCourseCategory",
     *      tags={"CourseCategories"},
     *      summary="Get list of CourseCategories",
     *      description="Returns list of CourseCategories",
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
        return CourseCatResource::collection(CourseCategory::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/coursecategories",
     *      operationId="storeCourseCategory",
     *      tags={"CourseCategories"},
     *      summary="store CourseCategories information",
     *      description="store CourseCategories  data",
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
     *      path="/coursecategories/{id}",
     *      operationId="getCourseCategoryById",
     *      tags={"CourseCategories"},
     *      summary="Get CourseCategories information",
     *      description="Returns CourseCategories data",
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
     *      path="/coursecategories/{id}",
     *      operationId="updateCourseCategory",
     *      tags={"CourseCategories"},
     *      summary="update CourseCategories information",
     *      description="update CourseCategories  data",
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
     *      path="/coursecategories/{id}",
     *      operationId="deleteCourseCategoryById",
     *      tags={"CourseCategories"},
     *      summary="delete CourseCategories information",
     *      description="delete CourseCategories data",
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
     *      path="/coursecategories/restore/{id}",
     *      operationId="restoreCourseCategory",
     *      tags={"CourseCategories"},
     *      summary="restore deleted CourseCategories information",
     *      description="restore CourseCategories data",
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
     *      path="/coursecategories/restore",
     *      operationId="restoreAllCourseCategory",
     *      tags={"CourseCategories"},
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
