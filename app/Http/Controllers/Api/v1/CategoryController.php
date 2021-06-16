<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
      return response()->json([
        "status" => true,
        "response" => new CategoryCollection(Category::paginate(10))
      ]);
    }
}
