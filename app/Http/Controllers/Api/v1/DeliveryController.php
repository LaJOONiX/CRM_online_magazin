<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index() {
      return response()->json([
        "status" => true,
        "response" => Delivery::all()
      ]);
    }
}
