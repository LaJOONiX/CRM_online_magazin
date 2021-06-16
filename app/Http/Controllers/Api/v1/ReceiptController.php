<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReceiptCollection;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Resources\Receipt as ReceiptResource;
use App\Models\ProductOffer;
use App\Models\Receipt;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Resources\Subscription as SubscriptionResource;
use Illuminate\Support\Facades\Validator;

class ReceiptController extends Controller
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
            "response" => new ReceiptCollection(Receipt::where('id_employee',AppHelper::check_employee()->id)
              ->with('client', 'employee', 'product_offers')->orderBy('created_at','desc')->paginate(6))
        ], 200);
    }

  /**
   * Issue a receipt
   */

    public function issue(Request $request) {


      $request_data = $request->only(['id_client', 'product_offers']);

      $validator = Validator::make($request_data, [
        "id_client" => "required|numeric",
        "product_offers" => "required",
      ]);

      if ($validator->fails()) {
        return response()->json([
          "status" => false,
          "errors" => $validator->messages()
        ], 422);
      }

      foreach ($request->product_offers as $product_offer) {

        $validator = Validator::make($product_offer, [
          "id_delivery" => "required|numeric",
          'count' => 'required|numeric',
          "id_product" => "required|numeric",
          "date_start" => "required|date",
          "date_end" => "required|date"
        ]);

        if ($validator->fails()) {
          return response()->json([
            "status" => false,
            "errors" => $validator->messages()
          ], 422);
        }
      }

      $code = AppHelper::generate_code('R',Receipt::class);

      $receipt = Receipt::create([
        'code' => $code,
        'id_employee' => AppHelper::check_employee()->id,
        'id_client' => $request->id_client
      ]);

      // subscriptions
      foreach ($request->product_offers as $product_offer) {
        $product_offer = (object) $product_offer;

        ProductOffer::create([
          'id_receipt' => $receipt->id,
          'id_delivery' => $product_offer->id_delivery,
          'id_product' => $product_offer->id_product,
          'count' => $product_offer->count,
          'code' => AppHelper::generate_code('POF', ProductOffer::class),
          'start_at' => $product_offer->date_start,
          'end_at' => $product_offer->date_end
        ]);
      }

      $receipt->sum = $receipt->product_offers->reduce(function ($sum, $item) {
        return $sum + $item->product->price * $item->count;
      }, 0);

      if (!$receipt->sum) {
        return response()->json([
          "status" => false,
          "response" => "No product offers in receipt"
        ], 422);
      }

      $receipt->save();

      return response()->json([
        "status" => true,
        "response" => [
          'code_employee' => AppHelper::check_employee()->code,
          'code_client' => $receipt->client->code,
          'code' => $receipt->code,
          'created_at' => $receipt->created_at->format('M d Y'),
          'sum' => $receipt->sum
        ],
      ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id_receipt)
    {
        $receipt = new ReceiptResource(Receipt::where('id',$id_receipt)->with('subscriptions')->first());
        if (!$receipt) {
            return response()->json([
                "status" => false,
                "error" => "Receipt not found",
            ])->setStatusCode(404, "Receipt not found");
        }
        if ($receipt->subscriptions[0]->id_office !== AppHelper::check_employee()->id_office) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ])->setStatusCode(403, "Access denied");
        }
        return response()->json([
            "status" => true,
            "response" => $receipt,
        ]);
    }

    /**
     * Display the specified resource by code
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */

    public function show_code($code) {
        $receipt = new ReceiptResource(Receipt::where('code', $code)->with('subscriptions')->first());
        if (!$receipt->resource) {
            return response()->json([
                "status" => false,
                "error" => "Receipt not found",
            ])->setStatusCode(404,"Receipt not found");
        }
        if ($receipt->id_employee !== AppHelper::check_employee()->id) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ])->setStatusCode(403, "Access denied");
        }
        return response()->json([
            "status" => true,
            "response" => $receipt,
        ],200);
    }

    /**
     * Pay the receipt by code
     */

    public function pay($code, Request $request) {
        $receipt = Receipt::where('code',$code)->first();
        if (!$receipt) {
            return response()->json([
                "status" => false,
                "error" => "Receipt not found",
            ])->setStatusCode(404, "Receipt not found");
        }

        if ($receipt->id_employee !== AppHelper::check_employee()->id) {
          return response()->json([
            "status" => false,
            "error" => "Access denied"
          ])->setStatusCode(403, "Access denied");
        }

        if (!$request->payment_code) {
          return response()->json([
            "status" => false,
            "error" => "payment_code field required"
          ], 422);
        }

        if (Receipt::where('payment_code', $request->payment_code)->first()) {
          return response()->json([
            "status" => false,
            "error" => "payment code already exists"
          ], 400);
        }

        if (!str_starts_with($request->payment_code,'PY-')) {
          $request->payment_code = 'PY-'.$request->payment_code;
        }
        $receipt->payment_code = $request->payment_code;
        $receipt->save();
        return response()->json([
            "status" => true,
            "response" => "Payment code successfully set",
        ])->setStatusCode(200, "Payment code successfully set");
    }

    /**
     * show subscriptions in receipt by receipt_code
     */
    public function subscriptions($code_receipt) {
        $receipt = Receipt::where('code', $code_receipt)->first();
        if (!$receipt) {
            return response()->json([
                "status" => false,
                "response" => "Receipt not found",
            ])->setStatusCode(404, "Receipt not found");
        }

        if(Receipt::where('code', $code_receipt)->first()->subscriptions->first()->id_employee !== AppHelper::check_employee()->id)
        {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ])->setStatusCode(403, "Access denied");
        }

        $subscriptions = new SubscriptionCollection(Subscription::where('id_receipt',$receipt->id)
            ->with('publication','delivery','receipt','employee')->get());


        return response()->json([
            "status" => true,
            "response" => $subscriptions,
        ],200);
    }

    /**
     * Update the specified subscription in receipt.
     *
     * @param \Illuminate\Http\Request $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_subscription(Request $request, Receipt $receipt, Subscription $subscription)
    {
        $request_data = $request->only(['months', 'id_publication', 'id_delivery', 'id_employee']);

        $validator = Validator::make($request_data, [
            "months" => "required",
            "id_publication" => "required",
            "id_delivery" => "required",
            "id_employee" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 422);
        }

        if (!$receipt) {
            return response()->json([
                "status" => false,
                "error" => "Receipt not found",
            ], 404, "Receipt not found");
        }

        if (!$subscription) {
            return response()->json([
                "status" => false,
                "error" => "Subscription not found"
            ], 404,"Subscription not found");
        }

        $subscription->months = $request->months;
        $subscription->id_publication = $request->id_publication;
        $subscription->id_delivery = $request->id_delivery;
        $subscription->id_employee = $request->id_employee;

        $subscription->save();

        return response()->json([
            "status" => true,
            "response" => "Subscription has been updated"
        ])->setStatusCode(200,"Subscription had been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($code)
    {
        $receipt = Receipt::where('code',$code)->with('subscriptions')->first();
        if (!$receipt) {
            return response()->json([
                "status" => "false",
                "error" => "Receipt not found",
            ])->setStatusCode(404, "Receipt not found");
        }
        if ($receipt->subscriptions->first()->id_employee !== AppHelper::check_employee()->id) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ])->setStatusCode(403, "Access denied");
        }


        $receipt->delete();

        return response()->json([
            "status" => "true",
            "response" => "Receipt has been deleted",
        ],200);
    }

}
