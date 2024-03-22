<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProductController extends Controller
{
     public function list(){
        $record = Product::all();
        return response()->json([$record]);
     }


     
     public function create(Request $request){

        try {
            $rules = [
                'sku'=> 'required|numeric',
                'name' => 'required|string',
                'dimension_id'=>'required|numeric',
                'category_id' => 'required|numeric',
                'sub_category_id'=>'required|numeric',
                'description'=>'required|string',
                'product_image'=>'required|string',
                'stock' =>'required|numeric',
                'brand_name'=>'required|string',
                'model_number'=>'required|numeric',
                'price' => 'required|numeric'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails() ) {
                return response()->json(['status' => false, 'errors' => $validator->errors()]);
            }

    
            $obj = new Product();
            $obj->sku = $request->sku;
            $obj->name = $request->name;
            $obj->dimension_id = $request->dimension_id;
            $obj->category_id = $request->category_id;
            $obj->sub_category_id = $request->sub_category_id;
            $obj->description = $request->description;
            $obj->product_image = $request->product_image;
            $obj->stock = $request->stock;
            $obj->brand_name = $request->brand_name;
            $obj->model_number = $request->model_number;
            $obj->price = $request->price;

            try {
                $obj->save();
            } catch (Exception $e) {
                $obj->price = 1;
                $obj->save();
            }

            return response()->json(['status' =>true, 'data' => $obj]);
    
        } catch (Throwable $e) {
            Log::error($e->getMessage(), [$e->getTraceAsString()]);
            throw new HttpResponseException(response()->json(['status' => false , 'message' => 'Something Went Wrong', 'errors' => $e->getTraceAsString()]));
        }
     }

      
     public function update(Request $request){

        try {
            $rules = [
                'sku'=> 'numeric',
                'name' => 'string',
                'dimension_id'=>'numeric',
                'category_id' => 'numeric',
                'sub_category_id'=>'numeric',
                'description'=>'string',
                'product_image'=>'string',
                'stock' =>'numeric',
                'brand_name'=>'string',
                'model_number'=>'numeric',
                'price' => 'numeric'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails() ) {
                return response()->json(['status' => false, 'errors' => $validator->errors()]);
            }

        $record = Product::find($request->id);

        if($record){
            $record->name = $request->name;
            $record->update(); 
            return response()->json(['status' =>true, 'data' => $record]);

        }else{
            return response()->json(['status' =>false, 'message' => "No Data Found"]);
        }
    }
        catch(Throwable $e) {
            Log::error($e->getMessage(), [$e->getTraceAsString()]);
            throw new HttpResponseException(response()->json(['status' => false , 'message' => 'Something Went Wrong', 'errors' => $e->getTraceAsString()]));
        }
     }




     public function delete(Request $request){
        try{
     
        $validator = Validator::make($request->all(), [
            'sku'=> 'numeric',
            'name' => 'string',
            'dimension_id'=>'numeric',
            'category_id' => 'numeric',
            'sub_category_id'=>'numeric',
            'description'=>'string',
            'product_image'=>'string',
            'stock' =>'numeric',
            'brand_name'=>'string',
            'model_number'=>'numeric',
            'price' => 'numeric'
    ]);
        if ($validator->fails() ) {
            return response()->json(['status' => false, 'errors' => $validator->errors()]);
        }

        $record = Product::find($request->id );
        if($record){
        $record->delete(); 
        
        return response()->json(['status' =>true, 'data' => $record]);
        }
        else{
            return response()->json(['status' =>false, 'message' => "No Data Found"]);
        }
    }catch(Throwable $e) {
        Log::error($e->getMessage(), [$e->getTraceAsString()]);
        throw new HttpResponseException(response()->json(['status' => false , 'message' => 'Something Went Wrong', 'errors' => $e->getTraceAsString()]));
    }

     }


     public function show(Request $request){
        $result= Product::with('Category')->get();
        return $result;
     }
     
}