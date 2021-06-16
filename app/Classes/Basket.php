<?php


namespace App\Classes;


use App\Helpers\AppHelper;
use App\Models\Publication;
use App\Models\Receipt;
use App\Models\Subscription;

class Basket
{
    protected $receipt;

    // basket constructor.

    public function __construct($createReceipt = false) {
        $receipt = session('receipt');

        if (is_null($receipt) && $createReceipt) {
            $data = [];
            if (AppHelper::check_employee()) {
                $data['employee_id'] = AppHelper::check_employee()->id;
            }

            $this->receipt = new Receipt($data);
            session(['receipt' => $this->receipt]);
        } else {
            $this->receipt = $receipt;
        }
    }

    /**
     * get the Receipt
     */

    public function getReceipt() {
        return $this->receipt;
    }

    public function countAvailable($updateCount = false) {
        $subscriptions = collect([]);

        foreach ($this->receipt->subscriptions as $receipt_subscription) { // перебор подписок внутри сессии
            $subscription = Subscription::find($receipt_subscription->id);
            if ($receipt_subscription->countInReceipt > $subscription->id) {
                return false;
            }

            if ($updateCount) {
                $subscription->count -= $receipt_subscription->countInReceipt;
                $subscriptions->push($subscription);
            }
        }

        if ($updateCount) {
            $subscriptions->map->save();
        }

        return true;
    }

    public function saveReceipt($name, $phone, $email) {
        if (!$this->countAvailable(true)) {
            return false;
        }

        $this->receipt->saveReceipt($name, $phone);
        // здесь может быть отправка на электронную почту
        return true;
    }


    public function removeSubscription($publication)
    {
      foreach ($this->receipt->subscriptions as $subscription) {
        if ($subscription->contains($publication)) {
          if ($subscription->countInReceipt < 2) {
            $this->receipt->pop($subscription);
          }
          else {
            $subscription->countInReceipt--;
          }
        }
      }
    }

    public function addSubscription($publication)
    {

      foreach ($this->receipt->subscriptions as $subscription) {
        if ($subscription->contains($publication)) {
          if ($subscription->countInReceipt >= $publication->count) {
            return false;
          }
          $subscription->countInOrder++;
        } else {
          if ($publication->count == 0) {
            return false;
          }
          $subscription->countInOrder = 1;
          $this->receipt->subscriptions->push($subscription);
        }
      }

      return true;
    }
}
