<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category=Category::orderBy('id','DESC')->get();
        return response()->json(['category list'=>$category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validator=Validator::make($data,[
                'title'=>'required',
                'description'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error']);
        }
            $category=Category::create($data);
            return response()->json(["success" => 'Category has been added successfully']);    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data=$request->all();
        $validator=Validator::make($data,[
                'title'=>'required',
                'description'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error']);
        }
        $category=Category::find($request->id);
        $category->title=$request->title;
        $category->description=$request->description;
        $category->update();
        return response()->json(['success'=>'Category has been successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return response()->json(['success'=>'Category has been successfully deleted']);
    }
}
