<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    // Show All City
    public function index()
    {
        $city=City::get();
        $response =[
            'message'=>'Data Founded',
            'data'=> CityResource::collection($city)
        ];  

        return response()->json($response,Response::HTTP_ACCEPTED);
    }

    // Create City
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),
        [
            'name'=>['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $city=City::create($request->all());
            $response=[
                'message'=> 'Data Created',
                'data' => $city
            ];

            return response()->json($response,Response::HTTP_CREATED);
        
        } catch (QueryException $e) {
            return response()->json([
                'message'=>'Failed' . $e->errorInfo
            ]);
        } 
    }

        // Get One City
        public function show($id)
        {
            $city = City::findOrFail($id);
            $response = [
                'message'=>'Data Founded',
                'data' => $city
            ];
    
            return response()->json($response,Response::HTTP_ACCEPTED);
        }

        // Update City
    public function update(Request $request,$id)
    {
        $city = City::findOrFail($id);

        $validator = Validator::make($request->all(),
        [
            "name"=>["required"]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $city->update($request->all());
            $response = [
                'message' => 'Data Updated',
                'data' => $city
            ];

            return response()->json($response,Response::HTTP_ACCEPTED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed Updated' . $e->errorInfo
            ]);
        }
    }

    // Delete City
    public function destroy($id)
    {
        $city=City::findOrFail($id);

        try {
            $city->destroy($id);
            $response=[
                'message'=>'delete successful',
                'data' =>$city
            ];

            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message'=>'Failed' . $e->errorInfo
            ]);
        }
    }
}
