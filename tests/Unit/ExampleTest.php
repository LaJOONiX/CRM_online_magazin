<?php

namespace Tests\Unit;

use App\Helpers\AppHelper;
use App\Http\Controllers\Api\v1\GoodController;
use App\Models\Publication;
use App\Models\Receipt;
use App\Models\Subscription;
use Carbon\Carbon;
use Database\Seeders\ClientsSeeder;
use Database\Seeders\EmployeesSeeder;
use Database\Seeders\OfficesSeeder;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;
use Tests\TestCase as BaseTestCase;
use Tests\CreatesApplication;

class ExampleTest extends BaseTestCase
{
  use RefreshDatabase;


  protected $seed = true;

  /**
   * @test
   */

  public function publication_test_true() {
    $publication_title = 'Капитанская дочка'; // формируем название издания

    $publication_controller = new GoodController(); // искусственно инициализируем контроллер

    $publication_response = $publication_controller->show_name_test($publication_title); // вызываем метод show_name_test на получение сущности по имени

    $this->assertTrue($publication_response->getOriginalContent()['status']); // проверяем, есть ли сущность с таким именем --> если status --> true, то запись с таким именем имеется, если false - не имеется

  }

  /**
   * @test
   */

  public function publication_test_false() {
    $publication_title = 'Несуществующее имя'; // формируем название издания

    $publication_controller = new GoodController(); // искусственно инициализируем контроллер

    $publication_response = $publication_controller->show_name_test($publication_title); // вызываем метод show_name_test на получение сущности по имени

    $this->assertFalse($publication_response->getOriginalContent()['status']); // проверяем, есть ли сущность с таким именем --> если status --> true, то запись с таким именем имеется, если false - не имеется

  }


//  public function first_test() {
//    $receipt = Receipt::create([
//        'code' => 'R-12345678',
//        'id_employee' => rand(1,3),
//        'id_client' => rand(1,3)
//      ]);
//
//    $this->assertEquals($receipt->code, 'R-12345678');
//  }
//
//  /**
//   * @test
//   */
//
//  public function get_total_sum_receipt() {
//
//
//    $data_publications = [
//        [
//          "title" => "Капитанская дочка_test",
//          "count" => 43,
//          "price" => 349,
//        ],
//        [
//          "title" => "Старуха Изергиль_test",
//          "count" => 64,
//          "price" => 259,
//        ],
//        [
//          "title" => "Горе от ума_test",
//          "count" => 76,
//          "price" => 149,
//        ],
//        [
//          "title" => "Обломов_test",
//          "count" => 32,
//          "price" => 529,
//        ],
//        [
//          "title" => "Война и мир_test",
//          "count" => 26,
//          "price" => 129,
//        ]
//      ];
//
//      DB::table('publications')->insert($data_publications);
//
//      $receipt = Receipt::create([
//        'code' => 'R-12345678',
//        'id_employee' => rand(1,10),
//        'id_client' => rand(1,10)
//      ]);
//
//      Subscription::create([
//        'code' => AppHelper::generate_code('S',Subscription::class),
//        'id_publication' => Publication::where('title','Капитанская дочка_test')->first()->id, // 349
//        'count' => 2,
//        'id_delivery' => rand(1,2),
//        'id_receipt' => $receipt->id,
//        'start_at' => Carbon::now()->addWeeks(rand(1,3)),
//        'end_at' => Carbon::now()->addMonths(rand(1,4)),
//      ]);
//
//      Subscription::create([
//        'code' => AppHelper::generate_code('S',Subscription::class),
//        'id_publication' => Publication::where('title','Старуха Изергиль_test')->first()->id, // 259
//        'count' => 3,
//        'id_delivery' => rand(1,2),
//        'id_receipt' => $receipt->id,
//        'start_at' => Carbon::now()->addWeeks(rand(1,3)),
//        'end_at' => Carbon::now()->addMonths(rand(1,4)),
//      ]);
//
//      Subscription::create([
//        'code' => AppHelper::generate_code('S',Subscription::class),
//        'id_publication' => Publication::where('title','Горе от ума_test')->first()->id, // 149
//        'count' => 4,
//        'id_delivery' => rand(1,2),
//        'id_receipt' => $receipt->id,
//        'start_at' => Carbon::now()->addWeeks(rand(1,3)),
//        'end_at' => Carbon::now()->addMonths(rand(1,4)),
//      ]);
//
//      // 698 + 777 + 596 = 2071
//
//      $this->assertEquals(2071,$receipt->calculateFullSum());
//  }
}
