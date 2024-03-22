<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        $data= new Category();
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->image = $request->image;
        $data->role = $request->role;
        $data->tax = $request->tax;
        $data->save();
        return response()->json([$data]) ;
        

    }
    public function show(){
        $show=Category::all();
        return $show;
        
    }
}
