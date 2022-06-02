<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *      path="/clients",
     *      operationId="getClientList",
     *      tags={"Clients"},
     *      summary="Get list of Clients",
     *      description="Returns list of Clients",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       ),
     *
     *
     *     )
     */
    public function index(): JsonResource
    {
        return ClientResource::collection(Client::paginate(10));
    }

    /**
     * @OA\Post (
     *      path="/clients",
     *      operationId="storeClient",
     *      tags={"Clients"},
     *      summary="Get Clients information",
     *      description="Clients branch data",
     *     @OA\Parameter(
     *          name="firstName",
     *          description="Clients FirstName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastName",
     *          description="Clients LastName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phoneNumber",
     *          description="Clients phoneNumber",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="Clients Country",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="Clients City",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine",
     *          description="Clients AdressLine",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine2",
     *          description="Clients AdressLine2",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="canSwim",
     *          description="Clients CanSwim",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Clients Email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Clients Password",
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
    public function store(StoreClientRequest $request): object
    {
        $client = Client::create($request->only([
            'firstName',
            'lastName',
            'phoneNumber',
            'emergencyNumber',
            'country',
            'city',
            'adressLine',
            'adressLine2',
            'canSwim',
            'email',
            'password',
        ]));

        return new ClientResource($client);
    }

    /**
     * @OA\Get(
     *      path="/clients/{id}",
     *      operationId="getClientById",
     *      tags={"Clients"},
     *      summary="Get Clients information",
     *      description="Returns Clients data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Clients id",
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

    public function show(Client $client): object
    {
        if($client->exists){
            return ClientResource::make($client);
        }

         abort(404,'error');
    }

    /**
     * @OA\Put  (
     *      path="/clients/{id}",
     *      operationId="updateClient",
     *      tags={"Clients"},
     *      summary="Update Clients information",
     *      description="Update Clients  data",
     *     @OA\Parameter(
     *          name="firstName",
     *          description="Clients FirstName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastName",
     *          description="Clients LastName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phoneNumber",
     *          description="Clients phoneNumber",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="Clients Country",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="Clients City",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine",
     *          description="Clients AdressLine",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine2",
     *          description="Clients AdressLine2",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="canSwim",
     *          description="Clients CanSwim",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Clients Email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Clients Password",
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
    public function update(UpdateClientRequest $request, Client $client): object
    {

        if($client->exists){
            $client->update($request->only([
                'firstName',
                'lastName',
                'phoneNumber',
                'emergencyNumber',
                'country',
                'adressLine',
                'adressLine2',
                'canSwim',
              //  'Email',
                'password',
            ]));
            return (new ClientResource($client))->response()->setStatusCode(201);
        }
        abort(404,'no recored ');
    }

    /**
     * @OA\Delete (
     *      path="/clients/{id}",
     *      operationId="deleteClientById",
     *      tags={"Clients"},
     *      summary="delete Clients information",
     *      description="delete Clients data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Clients id",
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
    public function destroy(Client $client): object
    {
        if($client->exists){
            if ($client->delete()){
                return response()->json([
                    'msg' => 'recored deleted'
                ]);
            }
        }
        abort(404,'error');
    }

    /**
     * @OA\Get(
     *      path="/clients/restore/{id}",
     *      operationId="restoreClientById",
     *      tags={"Clients"},
     *      summary="restore Clients information",
     *      description="restore Clients data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Clients id",
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
    public function RestoreDeletedItemWithId(int $id): string|int
    {

        if(Client::withTrashed()->find($id)->restore()){
            return back();
        };

        return 'No Data To Restore';
    }

    /**
     * @OA\Get(
     *      path="/clients/restore",
     *      operationId="restoreAllClient",
     *      tags={"Clients"},
     *      summary="restore all deleted Clients information",
     *      description="restore all  Clients data",
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

    public function RestoreAll(): string|int
    {


        if(Client::onlyTrashed()->restore()){
            return back();
        }
        return 'No Data To Restore';
    }
}
