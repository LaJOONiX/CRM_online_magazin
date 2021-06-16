<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

Route::group(['prefix' => 'receipt'], function () {
  Route::post('/add',[BasketController::class,'addSubscription']);
  Route::post('/remove',[BasketController::class,'removeSubscription']);
});
