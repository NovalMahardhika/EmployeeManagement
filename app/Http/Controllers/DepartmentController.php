<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends Controller
{
    // Get All  Department
    public function index()
    {
        $employee = Department::get();
        $response = [
            'message' => 'Data Founded',
            'data' => DepartmentResource::collection($employee)
        ];

        return response()->json($response,Response::HTTP_FOUND);
    }

    // Create Department

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
    [
        'name' => ['required'],
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(),HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    try {
        $department = Department::create($request->all());
        $response = [
            'message' => 'Department Created',
            'data' => $department
        ];
        return response()->json($response,Response::HTTP_CREATED);


    } catch (QueryException $e) {
        return response()->json([
            'message' => 'Failed Created' . $e->errorInfo
        ]);
    }
    }

    // Update Department

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        {
            $validator = Validator::make($request->all(),
        [
            'name' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(),HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    
        try {
            $department ->update($request->all());
            $response = [
                'message' => 'Department updated',
                'data' => $department
            ];
            return response()->json($response,Response::HTTP_ACCEPTED);
    
    
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed updated' . $e->errorInfo
            ]);
        }
        }
    }

    // Get One Department
    
    public function show($id)
    {
        $department = Department::findOrFail($id);
        $response = [
            'message' => 'Data is Founded',
            'data' => $department,
        ]; 

        return response()->json($response,Response::HTTP_FOUND);
    }

    // Delete Department
    public function destroy($id)
    {
        $department =Department::findOrFail($id);

        try {
            $department->destroy();
            $response = [
                'message'=>'Data Deleted'
            ];

            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message'=>'Failed Deleted' . $e->errorInfo
            ]);
        }
    } 
}
