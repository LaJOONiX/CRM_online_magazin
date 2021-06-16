<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductOfferCollection;
use App\Models\ProductOffer;
use App\Http\Resources\ProductOffer as ProductOfferResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductOfferController extends Controller
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
            "response" => new ProductOfferCollection(ProductOffer::with('receipt','product','delivery')->paginate(10)),
        ]);
    }

    /**
     * Display the specified resource by code.
     */

    public function show_code($code) {

        $product_offer = new ProductOfferResource(ProductOffer::where('code', $code)->with('receipt', 'product', 'delivery')->first());

        if (!$product_offer) {
            return response()->json([
                "status" => false,
                "error" => "Product Offer not found",
            ])->setStatusCode(404, "Product Offer not found");
        }

        if ($product_offer->receipt->id_employee !== AppHelper::check_employee()->id) {
            return response()->json([
                "status" => false,
                "error" => "Access denied"
            ])->setStatusCode(403, "Access denied");
        }

        return response()->json([
            "status" => true,
            "response" => $product_offer,
        ]);

    }

  /**
   * Deliver
   */

    public function deliver($code) {
      if (!$code) {
        return response()->json([
          "status" => false,
          "error" => "code is empty"
        ])->setStatusCode(404, "code is empty");
      }

      $product_offer = ProductOffer::where('code', $code)->first();

      if (!$product_offer) {
        return response()->json([
          "status" => false,
          "error" => "Product Offer not found"
        ]);
      }

      $product_offer->delivered_at = Carbon::now();
      $product_offer->save();

      return response()->json([
        "status" => true,
        "response" => $product_offer->delivered_at->format('M d Y')
      ]);

    }

    // Update the specified in storage (patch)

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($product_offer_code)
    {
        $product_offer = ProductOffer::where('code', $product_offer_code)->first();
        if (!$product_offer) {
            return response()->json([
                "status" => true,
                "error" => "Product Offer not found",
            ])->setStatusCode( 404, "Product Offer not found");
        }
        $product_offer->delete();
        return response()->json([
            "status" => true,
            "response" => "Product Offer has been deleted"
        ])->setStatusCode( 200, "Product Offer has been deleted");
    }
}
