<?php
namespace App\Helpers;

use App\Models\Employee;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppHelper {

    /**
     * Генерация случайного кода $start-и 8 цифр после дефиса
     * @param $start
     * @param $class
     * @return string
     */
//    public static function generate_code($start, $class) {
//        $code = $start . '-' . Str::random(8);
//        if ($class::where('code',$code)->first()) {
//            self::generate_code($start, $class);
//        } else {
//            return $code;
//        }
//    }

    public static function generate_code($start, $class) {
        $code = mb_strtoupper($start)."-".random_int(10000000, 99999999);
        if ($start === 'PY') {
          $item = $class::where('payment_code',$code)->first();
        } else {
          $item = $class::where('code', $code)->first();
        }
        if ($item) {
            self::generate_code($start,$class);
           // self::generate_code($start,$class);
            return false; // хз, зачем это
        } else {
            return $code;
        }
    }


    /**
     * Check employee
     * @param Request $request
     */

    public static function check_employee() {
        $api_token = request()->bearerToken();

        if(!$api_token) {
            return false;
        }

        $employee = Employee::where('api_token',$api_token)->first();

        if(!$employee) {
            return false;
        }

        return $employee;
    }

    /**
     * Check employee head
     * @return false
     */

    public static function check_employee_head() {
        $employee = self::check_employee();
        if (!$employee) {
            return false;
        }
        if ($employee->is_head != 1) {
            return false;
        }
        return $employee;
    }

    /**
     * Check general_director
     * @return false
     */

    public static function check_general() {
        $employee_head = self::check_employee_head();

        if (!$employee_head) {
            return false;
        }

        if ($employee_head->is_general != 1) {
            return false;
        }

        return false;
    }
}
