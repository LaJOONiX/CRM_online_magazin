<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function addSubscription(Request $request) {
      $publication = [];
      $result = (new Basket(true))->addSubscription($publication);

      if ($result) {
        return response()->json([
          "status" => true,
          "response" => "Подписка успешно оформлена"
        ]);
      }
      else {
        return response()->json([
          "status" => false,
          "error" => "Добавление подписки провалилось"
        ])->setStatusCode(500);
      }
    }

    public function removeSubscription(Request $request) {
      $publication = [];
      $result = (new Basket(true))->removeSubscription($publication);

      if ($result) {
        return response()->json([
          "status" => true,
          "response" => "Подписка успешно удалена",
        ]);
      }
      else {
        return response()->json([
          "status" => false,
          "response" => "Удаление подписки провалилось",
        ])->setStatusCode(500);
      }
    }

    public function issueReceipt() {
      $basket = new Basket();
      if ($basket->saveOrder()) {
        return response()->json([
          "status" => true,
          "response" => "Квитанция успешно оформлена",
        ]);
      } else {
        return response()->json([
          "status" => false,
          "response" => "Не удалось оформить квитанцию",
        ])->setStatusCode(500);
      }
    }
}
