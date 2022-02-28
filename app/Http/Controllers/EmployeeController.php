<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    // Show All Employee
    public function index()
    {
        $employee = Employee::get();
        $response = [
            'message' => 'Data Founded',
            'data' => EmployeeResource::collection($employee)
        ];
       

        return response()->json($response, Response::HTTP_ACCEPTED);
    }


    // Create Employee
    public function store(Request $request)
    {
        $validator = Validator::make($request ->all(),
        [
            "username" => ['required','max:20'],
            "last_name" => ['required','max:20'],
            "first_name" => ['required','max:20'],
            "middle_name" => ['nullable','max:20'],
            "birthdate" => ["required"],
            "address" => ['required','max : 255'],
            "department_id"=>['required'],
            "city_id"=>['required', ],
            "country_id"=>['required', ],
            "zip_code" => ['required','integer'],
            "date_hired" => ["nullable"],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        try {
            
            $employee = Employee::create($request ->all());
            $response = [
                'message' => 'Data is Created',
                'data' => $employee
            ];

            return response()->json($response,Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed' . $e->errorInfo
            ]);
        }
    }

    // Update Employee -> api/updateEmployee/{$id}
    public function update(Request $request,$id)
    {
        $employee = Employee::findOrFail($id);


        $validator = Validator::make($request ->all(),
        [
            "username" => ['nullable','max:20'],
            "last_name" => ['nullable','max:20'],
            "first_name" => ['nullable','max:20'],
            "middle_name" => ['nullable','max:20'],
            "birthdate" => ["nullable"],
            "address" => ['nullable','max : 255'],
            "department_id"=>['nullable',  ],
            "city_id"=>['nullable', ],
            "country_id"=>['nullable', ],
            "zip_code" => ['nullable','integer'],
            "date_hired" => ["nullable"],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $employee->update($request->all());
            $response = [
                'message' => 'Data Updated',
                'data' => $employee
            ];

            return response()->json($response,Response::HTTP_ACCEPTED);


        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed Updated' . $e->errorInfo
            ]);
        }
    }

    // Get One Employee -> api/getOne/{$id}
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $response = [
            'message' => 'Data Founded',
            'data' => $employee,
        ];

        return response()->json($response,Response::HTTP_FOUND);
    }

    // Delete Employee -> api/deleteEmployee/{id}
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        

        try {
        $employee->destroy($id);
        $response = 
        [
            'message' => 'Data Deleted'
        ];

        return response()->json($response,Response::HTTP_OK);


        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed Deleted' . $e->errorInfo
            ]);
        }
    }
}
