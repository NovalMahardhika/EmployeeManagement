<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    // Show All Employee-> api/allEmployee
    public function getAllEmployees()
    {
        $employee = Employee::get();
        $response = [
            'message' => 'Data Founded',
            'data' => $employee, 
        ];

        return response()->json($response,Response::HTTP_ACCEPTED);
    }


    // Create Employee->api/createEmployee
    public function createEmployee(Request $request)
    {
        $validator = Validator::make($request ->all(),
        [
            "username" => ['required','max:20'],
            "last_name" => ['required','max:20'],
            "first_name" => ['required','max:20'],
            "middle_name" => ['required','max:20'],
            "address" => ['required','max : 255'],
            // departmen_id
            // city_id
            // state_id
            // country_id
            "zip_code" => ['required','integer','max:10']
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
    public function updateEmployee(Request $request,$id)
    {
        $employee = Employee::findOrFail($id);


        $validator = Validator::make($request ->all(),
        [
            "username" => ['required','max:20'],
            "last_name" => ['required','max:20'],
            "first_name" => ['required','max:20'],
            "middle_name" => ['required','max:20'],
            "address" => ['required','max : 255'],
            // departmen_id
            // city_id
            // state_id
            // country_id
            "zip_code" => ['required','integer','max:10']
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
    public function getOneEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $response = [
            'message' => 'Data Founded',
            'data' => $employee,
        ];

        return response()->json($response,Response::HTTP_FOUND);
    }

    // Delete Employee -> api/deleteEmployee/{id}
    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);

        

        try {
        $employee->destroy();
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
