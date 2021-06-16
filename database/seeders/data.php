<?php

use App\Helpers\AppHelper;
use App\Models\Office;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

$max_count = rand(20,100);

function get_category($category_name) {
  switch ($category_name) {
    case "Телефоны":
      return 1;
      break;
    case "Компьютеры":
      return 2;
      break;
    case "Периферия":
      return 3;
      break;
    default:
      return null;
  }
}

return [
    'categories' => [
      [
        'title' => 'Телефоны'
      ],
      [
        'title' => 'Компьютеры'
      ],
      [
        'title' => 'Периферия'
      ]
    ],
    'employees' => [
        [
            'name' => 'Константинов Константин Константинопольский',
            'username'  => 'general',
            'code' => 'E-99999999',
            'password' => Hash::make('general'), // general
            'email' => 'Peroman49@yandex.ru',
//            'is_head' => 1,
//            'is_general' => 1,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'Александр Александров Александрович',
            'username' => 'employee',
            'code' => 'E-99999998',
            'password' => Hash::make('employee'), // employee
            'email' => 'Peroman49@yandex.ru',
//            'is_head' => 0,
//            'is_general' => 0,
            'created_at' => Carbon::now(),
        ],
        [
            'name' => 'Алексеев Алексей Алексеевич',
            'username' => 'employee_head',
            'code' => 'E-99999997',
            'password' => Hash::make('employee_head'), // employee_head
            'email' => 'Peroman49@yandex.ru',
//            'is_head' => 1,
//            'is_general' => 0,
            'created_at' => Carbon::now(),
        ]
    ],
    'addresses' => [
        [
            'city' => 'Иркутск',
            'street' => 'Мира',
            'house' => 5,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
        [
            'city' => 'Иркутск',
            'street' => 'Мира',
            'house' => 10,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
        [
            'city' => 'Иркутск',
            'street' => 'Баумана',
            'house' => 210,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
        [
            'city' => 'Иркутск',
            'street' => 'Карла Маркса',
            'house' => 105,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
        [
            'city' => 'Иркутск',
            'street' => 'Советская',
            'house' => 14,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
        [
            'city' => 'Иркутск',
            'street' => 'Советская',
            'house' => 15,
            'corpus' => null,
            'id_office' => rand(1, 5),
        ],
    ],
    'products' => [
        [
          "title" => "Just Huawei",
          "count" => $max_count,
          "price" => 349,
          "id_category" => get_category("Телефоны"),
          "created_at" => Carbon::now(),
        ],
        [
          "title" => "Super Huawei",
          "count" => $max_count,
          "price" => 259,
          "id_category" => get_category("Телефоны"),
          "created_at" => Carbon::now(),
        ],
        [
          "title" => "Nokia 3349",
          "count" => $max_count,
          "price" => 149,
          "id_category" => get_category("Телефоны"),
          "created_at" => Carbon::now(),
        ],
        [
          "title" => "Samsung Galaxy S4 Mini",
          "count" => $max_count,
          "price" => 529,
          "id_category" => get_category("Телефоны"),
          "created_at" => Carbon::now(),
        ],
        [
          "title" => "Honor 10 Lite",
          "count" => $max_count,
          "price" => 129,
          "id_category" => get_category("Телефоны"),
          "created_at" => Carbon::now(),
        ],
        [
          "title" => "Notebook DELL Nova",
          "count" => $max_count,
          "price" => 600,
          'id_category' => get_category("Компьютеры"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'Lenovo Legion 5 15ARH05H',
          'count' => $max_count,
          'price' => 240,
          'id_category' => get_category("Компьютеры"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'Msi SuperVersion Notebook',
          'count' => $max_count,
          'price' => 345,
          'id_category' => get_category("Компьютеры"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'System unit Velton',
          'count' => $max_count,
          'price' => 300,
          'id_category' => get_category("Компьютеры"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'HP Pavilion g6',
          'count' => $max_count,
          'price' => 400,
          'id_category' => get_category("Компьютеры"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'Monitor LG v5',
          'count' => $max_count,
          'price' => 300,
          'id_category' => get_category("Периферия"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'A4Tech X7',
          'count' => $max_count,
          'price' => 250,
          'id_category' => get_category("Периферия"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'Keyboard logitech g413',
          'count' => $max_count,
          'price' => 400,
          'id_category' => get_category("Периферия"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => 'Mouse Logitech G Pro',
          'count' => $max_count,
          'price' => 200,
          'id_category' => get_category("Периферия"),
          "created_at" => Carbon::now(),
        ],
        [
          'title' => "Samson C01U PRO",
          'count' => $max_count,
          'price' => 200,
          'id_category' => get_category("Периферия"),
          "created_at" => Carbon::now(),
        ]
    ],
    'deliveries' => [
        [
            'title' => 'Курьером',
            'created_at' => Carbon::now()
        ],
        [
            'title' => 'Самовывоз',
            'created_at' => Carbon::now()
        ]
    ],
    'pickup_points' => [
        [
            'address' => 'г. Иркутск, Ленина, 10',
            'hours' => '09:00 — 18:00'
        ],
        [
            'address' => 'г. Иркутск, Карла Маркса, 5',
            'hours' => '11:00 — 18:00'
        ],
        [
            'address' => 'г. Иркутск, Карла Маркса, 1',
            'hours' => '10:00 — 18:00'
        ],
        [
            'address' => 'г. Иркутск, Мира, 10',
            'hours' => '09:00 — 17:00'
        ],
        [
            'address' => 'г. Иркутск, Карла Либнекхта, 1',
            'hours' => '12:00 — 16:00'
        ],
        [
            'address' => 'г. Иркутск, Баумана, 10',
            'hours' => '10:00 — 18:00'
        ],
    ],
];
