<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Review;
class ReviewController extends Controller
{
    public function index()
    {
        $review=Review::orderBy('id','DESC')->get();
        return response()->json(['Review List'=>$review]);
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $validated=Validator::make($data,[
            'user_id'=>'required',
            'store_id'=>'required',
            'rate'=>'required'
        ]);
        if($validated->fails()){
            return response()->json(['errors'=>$validated->errors()]);
        }
        $review=Review::create($data);
        return response()->json(['success'=>'Review generated successfully']);
    }
}
