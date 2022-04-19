<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * @OA\Get(
     *      path="/client",
     *      operationId="getClientList",
     *      tags={"Client"},
     *      summary="Get list of Client",
     *      description="Returns list of Client",
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
        return ClientResource::collection(Client::all());
    }

    /**
     * @OA\Post (
     *      path="/client",
     *      operationId="storeClient",
     *      tags={"Client"},
     *      summary="Get Client information",
     *      description="Client branche data",
     *     @OA\Parameter(
     *          name="firstName",
     *          description="Client FirstName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastName",
     *          description="Client LastName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phoneNumber",
     *          description="Client phoneNumber",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="Client Country",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="Client City",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine",
     *          description="Client AdressLine",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine2",
     *          description="Client AdressLine2",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="canSwim",
     *          description="Client CanSwim",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Client Email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Client Password",
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
     *      path="/client/{id}",
     *      operationId="getClientById",
     *      tags={"Client"},
     *      summary="Get Client information",
     *      description="Returns Client data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Client id",
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
     *      path="/client/{id}",
     *      operationId="updateClient",
     *      tags={"Client"},
     *      summary="Update Client information",
     *      description="Update Client  data",
     *     @OA\Parameter(
     *          name="firstName",
     *          description="Client FirstName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastName",
     *          description="Client LastName",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phoneNumber",
     *          description="Client phoneNumber",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="country",
     *          description="Client Country",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="city",
     *          description="Client City",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine",
     *          description="Client AdressLine",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="adressLine2",
     *          description="Client AdressLine2",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="canSwim",
     *          description="Client CanSwim",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="bool"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Client Email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Client Password",
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
     *      path="/client/{id}",
     *      operationId="deleteClientById",
     *      tags={"Client"},
     *      summary="delete Client information",
     *      description="delete Client data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Client id",
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
     *      path="/client/restore/{id}",
     *      operationId="restoreClientById",
     *      tags={"Client"},
     *      summary="restore Client information",
     *      description="restore Client data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Client id",
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
     *      path="/client/restore",
     *      operationId="restoreAllClient",
     *      tags={"Client"},
     *      summary="restore all deleted Client information",
     *      description="restore all  Client data",
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
