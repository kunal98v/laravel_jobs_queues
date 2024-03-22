<?php

namespace App\Http\Controllers;
use App\Models\Books;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Jobs\Test\ConsumeApiServiceJob;

class BooksController extends Controller
{
    public function apitest(Request $request){
        $dataArray = [];
        $url = Http::get("https://openlibrary.org/authors/OL23919A/works.json")->json();
        // return $url['entries'];
        echo $url['entries']['title'];
        foreach ($url['entries'] as $key => $value) {
            $dataArray[] = [
                "name" => $value['title'],
                "bio" => isset($value['description']['value']) ? $value['description']['value'] : "key not found !",
                "title" => $value['title'],
            ];
        }
        Books::insert($dataArray);
        return true;
        // return $dataArray;
        $jobToDispatch = ConsumeApiServiceJob::dispatch($url)->onQueue('default');
        // Books::insert($data);
        return response()->json(
            ['status'=>"success",
            'message'=>"stored Successfully!",
            'data'=> $jobToDispatch
            ]
        );
    }
}
