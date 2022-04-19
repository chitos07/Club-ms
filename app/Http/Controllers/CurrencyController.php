<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @OA\Get(
     *      path="/currency",
     *      operationId="getCurrenyList",
     *      tags={"Currency"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *
     *     )
     */

    public function index(): object
    {
        return CurrencyResource::collection(Currency::all());
    }

    /**
     * @OA\Post (
     *      path="/currency",
     *      operationId="storeCurrency",
     *      tags={"Currency"},
     *      summary="Get Currency information",
     *      description="Returns currency data",
     *      @OA\Parameter(
     *          name="code",
     *          description="Currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Currency name",
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

    public function store(StoreCurrencyRequest $request): object
    {
        $currency = Currency::create($request->only(['code', 'name']));
        return new CurrencyResource($currency);
    }

    /**
     * @OA\Get(
     *      path="/currency/{id}",
     *      operationId="getCuurencyById",
     *      tags={"Currency"},
     *      summary="Get currency information",
     *      description="Returns currency data",
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

    public function show(Currency $currency): object
    {
        if ($currency->exists) {
            return CurrencyResource::make($currency);
        }
        abort(404, 'no data');
    }

    /**
     * @OA\Put  (
     *      path="/currency/{id}",
     *      operationId="updateCurrency",
     *      tags={"Currency"},
     *      summary="Update Currency information",
     *      description="Returns currency data",
     *      @OA\Parameter(
     *          name="code",
     *          description="Currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Currency name",
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

    public function update(UpdateCurrencyRequest $request, Currency $currency): object
    {
        if ($currency->exists) {
            $currency->update($request->only(['code', 'name']));
            return (new CurrencyResource($currency))->response()->setStatusCode(201);
        }
        abort(404, 'no data');
    }


    /**
     * @OA\Delete (
     *      path="/currency/{id}",
     *      operationId="deleteCurrencyById",
     *      tags={"Currency"},
     *      summary="delete currency information",
     *      description="delete currency data",
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

    public function destroy(Currency $currency): object
    {

        if ($currency->exists) {
            if ($currency->delete()) {
                return response()->json(['message' => 'Currency deleted succsfuly'], 200);

            }
        }
        abort(404, 'Error');
    }

    /**
     * @OA\Get(
     *      path="/currency/restore/{id}",
     *      operationId="restoreCurrencyById",
     *      tags={"Currency"},
     *      summary="restore deleted currency information",
     *      description="restore currency data",
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

    public function RestoreDeletedItemWithId(int $id): void
    {
        Currency::withTrashed()->find($id)->restore();
    }

    /**
     * @OA\Get(
     *      path="/currency/restore",
     *      operationId="restoreAllCurrency",
     *      tags={"Currency"},
     *      summary="restore all deleted currency information",
     *      description="restore all  currency data",
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

        if(Currency::onlyTrashed()->restore()){
            return back();
        }
        return 'No Data To Restore';
    }
}
