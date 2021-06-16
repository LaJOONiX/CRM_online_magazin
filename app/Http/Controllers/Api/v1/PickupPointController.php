<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Resources\Pickup_point;
use App\Http\Resources\Pickup_pointCollection;
use App\Http\Resources\Pickup_point as Pickup_pointResource;
use App\Models\PickupPoint;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PickupPointController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return JsonResponse
   */
  public function index()
  {
    return response()->json([
      "status" => true,
      "response" => new Pickup_pointCollection(PickupPoint::paginate(5)),
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function store(Request $request)
  {
    $request_data = $request->only(['address']);

    $validator = Validator::make($request_data, [
      "address" => "required",
    ]);

    if ($validator->fails()) {
      return response()->json([
        "status" => false,
        "errors" => $validator->messages(),
      ],422);
    }

    $office = PickupPoint::create([
      "address" => $request->address,
    ]);

    return response()->json([
      "status" => true,
      "response" => $office
    ])->setStatusCode( 201, "PickupPoint has been created");
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return JsonResponse
   */
  public function show($pickup_point_id)
  {
    $pickup_point = new Pickup_pointResource(PickupPoint::where('id',$pickup_point_id)->first());

    if (!$pickup_point) {
      return response()->json([
        "status" => false,
        "error" => "Pickup Point not found"
      ])->setStatusCode(404,"Pickup Point not found");
    }
    return response()->json([
      "status" => true,
      "response" => $pickup_point,
    ]);
  }

  /**
   * Display the specified resource by code
   * @param $code
   * @return \Illuminate\Http\JsonResponse
   */

  public function show_code($code) {
    $pickup_point = new Pickup_pointResource(Pickup_point::where('code', $code)->first());
    if (!$pickup_point) {
      return response()->json([
        "status" => false,
        "error" => "Pickup Point not found",
      ])->setStatusCode( 404, "Pickup Point not found");
    }
    return response()->json([
      "status" => true,
      "response" => $pickup_point,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Office $office
   * @return JsonResponse
   */
  public function update(Request $request, PickupPoint $pickup_point)
  {
    $request_data = $request->only(['address']);

    $validator = Validator::make($request_data, [
      "address" => "required"
    ]);

    if ($validator->fails()) {
      return response()->json([
        "status" => false,
        "errors" => $validator->messages()
      ], 422);
    }

    if (!$pickup_point) {
      return response()->json([
        "status" => false,
        "error" => "Pickup Point not found"
      ])->setStatusCode( 404,"Pickup Point not found");
    }

    $pickup_point->address = $request->address;
    $pickup_point->save();

    return response()->json([
      "status" => true,
      "response" => "Pickup Point has been updated"
    ])->setStatusCode( 200, "Pickup Point has been updated");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param PickupPoint $pickup_point
   * @return JsonResponse
   * @throws \Exception
   */
  public function destroy(PickupPoint $pickup_point)
  {
    if (!$pickup_point) {
      return response()->json([
        "status" => true,
        "error" => "Pickup Point not found",
      ])->setStatusCode( 404, "Pickup Point not found");
    }
    $pickup_point->delete();
    return response()->json([
      "status" => true,
      "response" => "Pickup Point has been deleted"
    ])->setStatusCode( 200, "Pickup Point has been deleted");
  }
}
