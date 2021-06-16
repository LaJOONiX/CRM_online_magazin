<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use App\Http\Resources\Employee as EmployeeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EmployeeController extends Controller
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
            "response" => new EmployeeCollection(Employee::where('id_office',AppHelper::check_employee()->id_office)->with('receipts')->paginate(10)),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request_data = $request->only(['name','username','password','email','id_office']);

        $validator = Validator::make($request_data, [
            "name" => "required",
            "username" => "required",
            "password" => "required",
            "email" => "required",
            "id_office" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages(),
            ],422);
        }

        if (Employee::where('username',$request->username)->first()) {
            return response()->json([
                "status" => false,
                "error" => "Email already in use",
            ], 400);
        }

        $unique_code = AppHelper::generate_code("E", \App\Models\Employee::class);
        $employee = Employee::create([
            "name" => $request->name,
            "username" => $request->username,
            "code" => $unique_code,
            "password" => Hash::make($request->password),
            "email" => $request->email,
            "id_office" => $request->id_office
        ]);

        return response()->json([
            "status" => true,
            "response" => $employee
        ])->setStatusCode(201,"Employee has been created");
    }

    public function login(Request $request) {
        $employee = Employee::where('username',$request->username)->first();

        if (!$employee) {
            return response()->json([
                "status" => false,
                "error" => "Incorrect username or password"
            ])->setStatusCode(401,"Incorrect username or password");
        }

        if (Hash::check($request->password,$employee->password)) {
            $api_token = Str::random(150);
            $employee->api_token = $api_token;
            $employee->save();

            return response()->json([
                "status" => true,
                "response" => [
                    "token" => $api_token,
                    "user" => [
                      "name" => $employee->name,
                      "username" => $employee->username,
                      "email" => $employee->email,
                      "is_english" => $employee->is_english
                    ]
                ],
            ],200);
        } else {
            return response()->json([
                "status" => false,
                "error" => "Incorrect username or password",
            ])->setStatusCode(401, "Incorrect username or password");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Employee $employee)
    {
        if (!$employee) {
            return response()->json([
                "status" => false,
                "error" => "Employee not found"
            ],404,"Employee not found");
        }
        return response()->json([
            "status" => true,
            "response" => new EmployeeResource($employee),
        ]);
    }

    /**
     * Display the specified resource by code
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */

    public function show_code($code) {
        // with('subscriptions');
        $employee = new EmployeeResource(Employee::where('code', $code)->with('subscriptions')->first());
        if (!$employee->resource) {
            return response()->json([
                "status" => false,
                "error" => "Employee not found",
            ])->setStatusCode(404,'Employee not found');
        }
        if ($employee->id_office !== AppHelper::check_employee()->id_office) {
            return response()->json([
                "status" => false,
                "error" => "Access denied",
            ])->setStatusCode(403,"Access denied");
        }
        return response()->json([
            "status" => true,
            "response" => $employee,
        ]);
    }


    public function update_profile(Request $request) {
      $employee = Employee::where('api_token',request()->bearerToken())->first();
      $request_data = $request->only(['username','password','email','is_english']);

      if (count($request_data) == 0) {
        return response()->json([
          "status" => false,
          "error" => "All fields are empty"
        ])->setStatusCode(422, "All fields are empty");
      }

      $rules_const = [
        "username" => "required",
        "password" => "required",
        "email" => "required",
        "count" => "required|numeric",
        "is_english" => "required|numeric",
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

      if (!$employee) {
        return response()->json([
          "status" => false,
          "error" => "Employee not found"
        ])->setStatusCode(404, "Employee not found");
      }

      foreach ($request_data as $key => $data) {
        if ($key === 'password') {
          $employee->$key = Hash::make($data);
        } else {
          $employee->$key = $data;
        }
      }

      $employee->save();
      dd($employee);

      return response()->json([
        "status" => true,
        "error" => "Employee has been updated"
      ])->setStatusCode(200, "Employee has been updated");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Employee $employee)
    {
        $request_data = $request->only(['name','username','password','email','id_office']);

        $validator = Validator::make($request_data, [
            "name" => "required",
            "username" => "required",
            "password" => "required",
            "email" => "required",
            "id_office" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->messages()
            ], 422);
        }

        if (!$employee) {
            return response()->json([
                "status" => false,
                "error" => "Employee not found"
            ], 404,"Employee not found");
        }

        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->password = Hash::make('password');
        $employee->email = $request->email;
        $employee->id_office = $request->id_office;
        $employee->save();

        return response()->json([
            "status" => true,
            "response" => "Employee has been updated"
        ], 200, "Employee has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Employee $employee)
    {
        if (!$employee) {
            return response()->json([
                "status" => true,
                "error" => "Employee not found",
            ])->setStatusCode(404, "Employee not found");
        }
        $employee->delete();
        return response()->json([
            "status" => true,
            "response" => "Employee has been deleted"
        ])->setStatusCode( 200, "Employee has been deleted");
    }

    public function office($id_office) {
        $employees = Employee::where('id_office', $id_office)->get();
        if (!$employees) {
            return response()->json([
                "status" => false,
                "response" => "Employee/s not found",
            ])->setStatusCode( 404, "Employee/s not found");
        }
        return response()->json([
            "status" => true,
            "response" => new EmployeeCollection($employees),
        ], 200);
    }
}
