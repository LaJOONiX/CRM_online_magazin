<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
      "response" => new ProductCollection(Product::with('product_offers')->orderBy('updated_at','desc')->paginate(10)),
    ]);
  }

  /**
   * Create a new Product
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse|object
   */

  public function store(Request $request)
  {
    $request_data = $request->only(['title', 'count', 'price', 'id_category']);

    $validator = Validator::make($request_data, [
      "title" => "required",
      "count" => "required",
      "price" => "required",
      "id_category" => "required|numeric"
    ]);

    if ($validator->fails()) {
      return response()->json([
        "status" => false,
        "errors" => $validator->messages()
      ]);
    }

    $product = Product::create([
      "id_category" => $request->id_category,
      "title" => $request->title,
      "count" => $request->count,
      "price" => $request->price,
    ]);

    return response()->json([
      "status" => true,
      "response" => new ProductResource($product),
    ])->setStatusCode( 201, "Product has been created");
  }

  /**
   * Display the specified resource by code
   * @param $code
   * @return \Illuminate\Http\JsonResponse
   */

  public function show_code($product_code) {
    $product = new ProductResource(Product::where('code', $product_code)->with('product_offers')->first());
    if (!$product) {
      return response()->json([
        "status" => false,
        "error" => "Product not found",
      ])->setStatusCode( 404, "Product not found");
    }
    return response()->json([
      "status" => true,
      "response" => $product,
    ]);
  }

  /**
   * Update specific fields of a specific resource
   * @param Request $request
   * @param Product $product
   */

  public function update_patch(Request $request, Product $product) {
    $request_data = $request->only(['title', 'count', 'price']);

    if (count($request_data) == 0) {
      return response()->json([
        "status" => false,
        "error" => "All fields are empty"
      ])->setStatusCode(422, "All fields are empty");
    }

    $rules_const = [
      "title" => "required",
      "count" => "required|numeric",
      "price" => "required|numeric",
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

    if (!$product) {
      return response()->json([
        "status" => false,
        "error" => "Product not found"
      ])->setStatusCode(404, "Product not found");
    }

    foreach ($request_data as $key => $data) {
      $product->$key = $data;
    }

    $product->save();

    return response()->json([
      "status" => true,
      "error" => "Product has been updated"
    ])->setStatusCode(200, "Product has been updated");
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\JsonResponse
   * @throws \Exception
   */
  public function destroy(Product $product)
  {
    if (!$product) {
      return response()->json([
        "status" => true,
        "error" => "Product not found",
      ])->setStatusCode( 404, "Product not found");
    }
    $product->delete();
    return response()->json([
      "status" => true,
      "response" => "Product has been deleted"
    ])->setStatusCode( 200, "Product has been deleted");
  }

  /** Show good via specified name
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */

  public function show_name(Request $request) {
    if (!$request->name) {
      return response()->json([
        "status" => false,
        "error" => "Product name is not specified"
      ], 404);
    }
    $product = Product::where('title', $request->name)->first();
    if (!$product) {
      return response()->json([
        "status" => false,
        "error" => "Product not found"
      ], 404);
    }
    return response()->json([
      "status" => false,
      "response" => $product
    ]);
  }


  public function learn_price($product_name) {
    if (!$product_name) {
      return response()->json([
        "status" => false,
        "error" => "Product name not specified"
      ], 422);
    }

    $product = Product::where('name',$product_name)->first();
    if (!$product) {
      return response()->json([
        "status" => false,
        "error" => "Product not found"
      ]);
    }

    return response()->json([
      "status" => true,
      "response" => $product->price
    ]);
  }

}
