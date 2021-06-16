<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\Client as ClientResource;
use App\Models\Address;
use App\Models\Client;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            "status" => true,
            "response" => new ClientCollection(Client::orderBy('updated_at','desc')->paginate(10)),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request_data = $request->only(['name', 'email']);

        $validator = Validator::make($request_data, [
            "name" => "required",
            "email" => "required|email",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages(),
            ],422);
        }

        $id_office = AppHelper::check_employee()->id_office;

        $unique_code = AppHelper::generate_code("C", \App\Models\Client::class);

        $client = Client::create([
            "code" => $unique_code,
            "name" => $request->name,
            "email" => $request->email,
        ]);

        return response()->json([
            "status" => true,
            "response" => new ClientResource($client)
        ])->setStatusCode( 201, "Client has been created");
    }

    /**
     * Display the specified resource by code
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($code) {
      $client = Client::where('code',$code)->first();
      if (!$client) {
        return response()->json([
          "status" => false,
          "error" => "Client not found",
        ])->setStatusCode(404, "Client not found");
      }
      $client = new ClientResource($client);
      return response()->json([
          "status" => true,
          "response" => $client,
      ]);
    }

  /** Update specific fields of a specific resource
   * @param Request $request
   * @param Client $client
   * @return \Illuminate\Http\JsonResponse|object
   */

    public function update_patch(Request $request, Client $client) {
      $request_data = $request->only(['name','email']);

      if (count($request_data) == 0) {
        return response()->json([
          "status" => false,
          "error" => "All fields are empty"
        ])->setStatusCode(422, "All fields are empty");
      }

      $rules_const = [
        "name" => "required",
        "email" => "required",
      ];

      $rules = [];

      foreach ($request_data as $key => $value) {
        $rules[$key] = $rules_const[$key];
      }

      $validator = Validator::make($request_data, $rules);

      if ($validator->fails()) {
        return response()->json([
          "status" => false,
          "errors" => $validator->messages()
        ])->setStatusCode(422);
      }

      if (!$client) {
        return response()->json([
          "status" => false,
          "error" => "Client not found"
        ])->setStatusCode(404, "Client not found");
      }

      foreach ($request_data as $key => $data) {
        $client->$key = $data;
      }

      $client->save();

      return response()->json([
        "status" => true,
        "error" => "Client has been updated"
      ])->setStatusCode(200, "Client has been updated");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Client $client)
    {
        $request_data = $request->only(['name','code','email','apartment']);

        $validator = Validator::make($request_data, [
            "name" => "required",
            "code" => "required",
            "email" => "required",
            "apartment" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 422);
        }

        if (!$client) {
            return response()->json([
                "status" => false,
                "error" => "Client not found"
            ], 404,"Client not found");
        }

        if ($client->id_office !== Auth::user()->id_office) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ],403);
        }

        $client->name = $request->name;
        $client->code = $request->code;
        $client->email = $request->email;
        $client->apartment = $request->apartment;
        $client->save();

        return response()->json([
            "status" => true,
            "response" => "Client has been updated"
        ], 200, "Client has been updated");
    }

    public function get_office(Request $request) {
//       $request->city;
//       $request->street
//       $request->house
//       $request->corpus
//       $request->apartment
      $request_data = $request->only(['city', 'street', 'house', 'corpus']);

      $validator = Validator::make($request_data, [
        'city' => 'required',
        'street' => 'required',
        'house' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json([
          "status" => false,
          "errors" => $validator->messages(),
        ],422);
      }

      $request_data = (Object) $request_data;

      $office = Office::all()->filter(function ($item) use ($request_data) {
        foreach($item->addresses as $address) {
          if ($address->city === $request_data->city && $address->street === $request_data->street &&
          $request_data->house === $address->house ) {
            return true;
          }
        }
        return false;
      })->first();

      if (!$office) {
        return response()->json([
          "status" => false,
          "error" => "Office not found"
        ], 404);
      }

      return response()->json([
        "status" => true,
        "response" => $office->address
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Client $client)
    {
        if (!$client) {
            return response()->json([
                "status" => true,
                "error" => "Client not found",
            ])->setStatusCode( 404, "Client not found");
        }
        $client->delete();
        return response()->json([
            "status" => true,
            "response" => "Client has been deleted"
        ])->setStatusCode(200, "Client has been deleted");
    }

}
