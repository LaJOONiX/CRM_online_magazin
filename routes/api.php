<?php

use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ClientController;
use App\Http\Controllers\Api\v1\DeliveryController;
use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\OfficeController;
use App\Http\Controllers\Api\v1\PickupPointController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductOfferController;
use App\Http\Controllers\Api\v1\ReceiptController;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\Address as AddressResource;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\OfficeCollection;
use App\Http\Resources\Office as OfficeResource;
use App\Http\Resources\Publication as PublicationResource;
use App\Http\Resources\PublicationCollection;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Employee;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('deliveries', function () {
  return response()->json([
    "status" => true,
    "response" => Delivery::all()
  ]);
});

//Route::get('deliveries', [DeliveryController::class, 'index']);
//Route::put('deliveries') // put - редактирование

/**
 * Get delivery via specified name
 */

Route::get('delivery/title', function (Request $request) {

  if (!$request->title) {
    return response()->json([
      "status" => false,
      "error" => "title param is empty"
    ], 400);
  }

  $delivery = Delivery::where('title', $request->title)->first();

  if (!$delivery) {
    return response()->json([
      "status" => false,
      "error" => "Delivery not found"
    ], 404);
  }

  return response()->json([
    "status" => true,
    "response" => $delivery,
  ], 200);

});


Route::get('test', function() {
  dd(Receipt::where('code','R-18510864')->first()->employee()->toSql());
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('reset', function () {
    Artisan::call('migrate:fresh --seed');
    return response()->json([
       "status" => true,
       "response" => "Site in initial state"
    ], 200);
});


/**
 * Аутентификация
 */

Route::post('/create',[EmployeeController::class,"create"]);
Route::post('/login',[EmployeeController::class,"login"]);

/**
 * Товары
 */

Route::get('products', [ProductController::class,'index']);
Route::get('products/name', [ProductController::class, 'show_name']);
Route::get('products_price/{name}', [ProductController::class, 'learn_price']);
Route::get('products/{code}', [ProductController::class,'show']);
Route::group(['middleware' => 'bearer_auth'], function () {

//    Route::group(['middleware' => 'check.admin'], function () {
        Route::post('products', [ProductController::class, 'store']);
        Route::put('products/{product}', [ProductController::class,'update']);
        Route::patch('products/{product}', [ProductController::class, 'update_patch']);
        Route::delete('products/{product}', [ProductController::class, 'destroy']);
//    });
});

/**
 * Категории
 */

Route::group(['middleware' => 'bearer_auth'], function () {
  Route::get('categories', [CategoryController::class, 'index']);
});

/**
 * Товарные_предложения
 */

Route::group(['middleware' => 'bearer_auth'], function () {
    Route::get('product_offers', [ProductOfferController::class,'index']);
    Route::get('product_offers/{code}', [ProductOfferController::class,'show_code']);
    Route::get('product_offers/deliver/{code}', [ProductOfferController::class,'deliver']);
    Route::post('product_offers', [ProductOfferController::class, 'store']);
    Route::delete('product_offers/{product_offer}', [ProductOfferController::class, 'destroy']);
    Route::group(['middleware' => 'check.admin'], function () {
        Route::put('product_offers/{subscription}', [ProductOfferController::class, 'update']);
    });
});

/**
 * Пункты выдачи
 */

Route::get('pickup_points', [PickupPointController::class, 'index']);
Route::get('pickup_points/{code}', [PickupPointController::class,'show_code']);

Route::post('pickup_points', [PickupPointController::class, 'store']);
Route::group(['middleware' => 'bearer_auth'], function () {
    Route::group(['middleware' => 'check.admin'], function () {
        Route::put('pickup_points/{pickup_point}', [PickupPointController::class,'update']);
        Route::delete('pickup_points/{pickup_point}', [PickupPointController::class, 'destroy']);
    });
});

/**
 * Адреса
 */

Route::get('addresses', [AddressController::class, 'index']);
Route::get('addresses/{id_address}', [AddressController::class, 'show']);

Route::group(['middleware' => 'bearer_auth'], function () {
  Route::post('addresses', [AddressController::class, 'store']);
  Route::put('addresses/{address}', [AddressController::class, 'update']);
  Route::delete('addresses/{address}', [AddressController::class, 'destory']);
});

/**
 * Клиенты
 */

Route::post('clients/get_office', [ClientController::class, 'get_office']);

Route::group(['middleware' => 'bearer_auth'], function () {
    Route::get('clients', [ClientController::class, 'index']);
    Route::get('clients/{code}', [ClientController::class, 'show']);
    Route::post('clients', [ClientController::class, 'store']);
    Route::put('clients/{client}', [ClientController::class, 'update']);
    Route::patch('clients/{client}', [ClientController::class, 'update_patch']);
    Route::delete('clients/{client}', [ClientController::class, 'destroy']);
});

/**
 * Квитанции
 */


Route::group(['middleware' => 'bearer_auth'], function () {
   Route::get('receipts', [ReceiptController::class, 'index']);
   Route::post('receipts/issue', [ReceiptController::class, 'issue']);
   Route::get('receipts/{code}', [ReceiptController::class, 'show_code']);
   Route::post('receipts/{code}/pay', [ReceiptController::class, 'pay']);
   Route::get('receipts/{code}/subscriptions', [ReceiptController::class, 'subscriptions']);
   Route::post('receipts', [ReceiptController::class, 'store']);
   Route::group(['middleware' => 'check.admin'], function() {
       Route::put('receipts/{receipt}', [ReceiptController::class, 'update']);
   });
   Route::delete('receipts/{receipt}', [ReceiptController::class, 'destroy']);
});

/**
 * Сотрудники
 */

Route::group(['middleware' => 'bearer_auth'], function () {
   Route::get('employees', [EmployeeController::class ,'index']);
   Route::get('employees/{code}', [EmployeeController::class,'show_code']);
   Route::patch('update_profile', [EmployeeController::class,'update_profile']);
 //  Route::get('employees/{id_office}', [EmployeeController::class, 'office']);
   Route::group(['middleware' => 'check.admin'], function () {
       Route::post('employess', [EmployeeController::class, 'store']);
       Route::put('employess/{employee}', [EmployeeController::class, 'update']);
       Route::delete('employees/{employee}', [EmployeeController::class, 'destroy']);
   });
});

/**
 * Получение всех почтовых офисов и их сотрудников
 */

//Route::get('offices/{office}/addresses', function (Request $request, Office $office) { // получить все адреса, обслуживаемые почт. отделением
//    return new OfficeResource($office);
//});

// получить все доступные квартиры в доме


/**
 * Обслуживается ли адрес почтовым отделением?
 */

Route::get('offices/{office}/addresses/{address}', function (Request $request, Office $office, Address $address) {
    $result = $office->addresses()->get()->filter(function ($value, $key) use ($address) {
        return $value->id === $address->id ? true : false;
    });
    if (!$result) {
        return response()->json([
            "status" => false,
            "response" => "Address not serviced"
        ], 404);
    }
    return response()->json([
        "status" => true,
        "response" => $result
    ], 200);
});

/**
 * Получить отделение по id-адреса
 */

Route::get('addresses/{id}/office', function (Request $request, Address $address) {
    $office = $address->office;
    if (!$office) {
      return response()->json([
          "status" => true,
          "response" => $address->office,
      ], 200);
    } else {
        return response()->json([
            "status" => false,
            "error" => "Office not found"
        ], 404);
    }
});

/**
 * Получить клиентов по id почтового отделения
 */

Route::get('office/{office}/clients', function (Request $request, Office $office) {
    return $office->clients()->get();
});



// найти клиента по коду

//Route::get('clients/{code}', function (Request $request) {
//    $code = $request->code;
//    $client = Client::where('code', $code)->get();
//    if (!$client) {
//        return response()->json([
//            "status" => false,
//            "error" => "Page not found"
//        ], 404);
//    }
//    return response()->json([
//        "status" => true,
//        "response" => $client,
//    ], 200);
//});

// получить все квитанции, принадлежащие определенному клиенту

//Route::get('clients/{client_id}/receipts', function (Client $client) {
//    return $client->receipts;
//});

// получить все подписки, входящие в эту квитанцию

Route::get('receipts/{id_receipt}/subscriptions', function (Receipt $receipt) {
   return $receipt->subscriptions;
});

// получичть сотрудника, входящий в подписку, которая в свою очередь входит в квитанцию

Route::get('receipts/{id_receipt}/subscriptions/{id_subscription}/employee', function (Receipt $receipt, Subscription $subscription) {
    return $receipt->subscription->employee;
});

// получить подписку по ее коду

Route::get('subscriptions?{param}', function (Request $request) {
    $subscription = Subscription::where('code', $request->code)->get();
    if (!$subscription) {
        return response()->json([
            "status" => false,
            "error" => "Subscription not found"
        ], 404);
    }
    return response()->json([
       "status" => true,
       "response" => $subscription
    ], 200);
}); // здесь обязтаельно должен быть GET-параметр


Route::get('ad/{address}', function (Request $request, Address $address) {
    if (!$address) {
        response()->json([
            "status" => false,
            "error" => "Address not found"
        ], 404);
    }
    return response()->json([
        "status" => true,
        "response" => $address->apartments()
    ]);
});



// здесь какая-то группа для пивного токена
