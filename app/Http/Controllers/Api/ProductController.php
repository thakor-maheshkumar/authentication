<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderBy('id','DESC')->get();
        return response()->json(['Product List'=>$products]);
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
         $image=$request->file('image');
         $imageData=rand().'.'.$image->getClientOriginalExtension();
         $image->move(public_path('images'),$imageData);
         $data=$request->all();
        $validator=Validator::make($data,[
                'store_id'=>'required',
                'category_id'=>'required',
                'title'=>'required',
                'quantity'=>'required',
                'price'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error']);
        }
        $product=new Product;
        $product->store_id=$request->store_id;
        $product->category_id=$request->category_id;
        $product->title=$request->title;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->image=$imageData;
        $product->save();
        return response()->json(['success'=>'Product has been successfully saved']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $products=Product::where('store_id',$id)->get();
        return response()->json(['Product Detail'=>$products]);
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
                'store_id'=>'required',
                'category_id'=>'required',
                'title'=>'required',
                'quantity'=>'required',
                'price'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'error']);
        }
        $product=Product::findOrFail($request->id);
        if($request->hasFile('image'))
        {
            $image=$request->file('image');
            $imageData=rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$imageData);
            $product->image=$imageData;
        }
        $product->category_id=$request->category_id;
        $product->store_id=$request->store_id;
        $product->title=$request->title;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->description=$request->description;
        $isset=$product->update();
        if(isset($isset)){
            return response()->json(['success'=>'Product has been successfully updated']);    
        }else{
            return response()->json(['fail'=>'Something has wrong']);
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return response()->json(['product has been successfully deleted']);
    }
}
