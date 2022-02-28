<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    // Show All Country
    public function index()
    {
        $country = Country::get();
        $response = [
            'message'=>'Data Founded',
            'data' => CountryResource::collection($country)
        ];

        return response()->json($response,Response::HTTP_ACCEPTED);
    }





    // Create Country
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [

            "name"=>["required"]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $country=Country::create($request->all());
            $response=[
                'message' =>'Data is Created',
                'data' => $country
            ];

            return response()->json($response,Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message'=>'Failed' . $e->errorInfo
            ]);
        }
    }





    // Update Country
    public function update(Request $request,$id)
    {
        $country = Country::findOrFail($id);

        $validator = Validator::make($request->all(),
        [
            "name"=>["required"]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $country->update($request->all());
            $response = [
                'message' => 'Data Updated',
                'data' => $country
            ];

            return response()->json($response,Response::HTTP_ACCEPTED);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed Updated' . $e->errorInfo
            ]);
        }
    }






    // Get One Country
    public function show($id)
    {
        $country = Country::findOrFail($id);
        $response = [
            'message'=>'Data Founded',
            'data' => $country
        ];

        return response()->json($response,Response::HTTP_ACCEPTED);
    }






    // Delete Country
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        
        try {
            $country ->destroy($id);
            $response=[
                'message' => 'Data Deleted'
            ];

            return response()->json($response,Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message'=>'Failed Deleted' . $e->errorInfo
            ]);
        }
    }
}
