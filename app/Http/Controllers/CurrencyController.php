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
     *      path="/currencies",
     *      operationId="getCurrenyList",
     *      tags={"Currencies"},
     *      summary="Get list of Currencies",
     *      description="Returns list of Currencies",
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
        return CurrencyResource::collection(Currency::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/currencies",
     *      operationId="storeCurrency",
     *      tags={"Currencies"},
     *      summary="Get Currencies information",
     *      description="Returns Currencies data",
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
     *      path="/currencies/{id}",
     *      operationId="getCuurencyById",
     *      tags={"Currencies"},
     *      summary="Get Currencies information",
     *      description="Returns Currencies data",
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
     *      path="/currencies/{id}",
     *      operationId="updateCurrency",
     *      tags={"Currencies"},
     *      summary="Update Currencies information",
     *      description="Returns Currencies data",
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
     *      path="/currencies/{id}",
     *      operationId="deleteCurrencyById",
     *      tags={"Currencies"},
     *      summary="delete Currencies information",
     *      description="delete Currencies data",
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
     *      path="/currencies/restore/{id}",
     *      operationId="restoreCurrencyById",
     *      tags={"Currencies"},
     *      summary="restore deleted Currencies information",
     *      description="restore Currencies data",
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
     *      path="/currencies/restore",
     *      operationId="restoreAllCurrency",
     *      tags={"Currencies"},
     *      summary="restore all deleted Currencies information",
     *      description="restore all  Currencies data",
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
